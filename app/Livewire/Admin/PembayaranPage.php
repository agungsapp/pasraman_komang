<?php

namespace App\Livewire\Admin;

use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Models\Siswa;
use App\Models\BiayaPendidikan;
use App\Trait\LivewireAlertTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PembayaranPage extends Component
{
    use LivewireAlertTrait, WithPagination;

    public $siswa_id = '';
    public $tahun = '';
    public $status = 'tagihan';
    public $details = [];
    public $editMode = false;
    public $pembayaranId = null;
    public $jenjang_id = '';
    public $modalDetails = null;
    public $statusFilter = 'all';

    protected function rules()
    {
        return [
            'siswa_id' => 'required|exists:siswas,id',
            'tahun' => [
                'required',
                'string',
                'size:9',
                'regex:/^[0-9]{4}\/[0-9]{4}$/',
                $this->editMode
                    ? 'unique:pembayarans,tahun,' . $this->pembayaranId . ',id,siswa_id,' . $this->siswa_id
                    : 'unique:pembayarans,tahun,NULL,id,siswa_id,' . $this->siswa_id,
            ],
            'status' => 'required|in:tagihan,lunas',
            'details.*.biaya_pendidikan_id' => 'required|exists:biaya_pendidikans,id',
            'details.*.checked' => 'boolean',
            'details' => [
                function ($attribute, $value, $fail) {
                    $hasChecked = false;
                    foreach ($value as $detail) {
                        if ($detail['checked']) {
                            $hasChecked = true;
                            break;
                        }
                    }
                    if (!$hasChecked) {
                        $fail('Setidaknya satu komponen biaya harus dipilih.');
                    }
                },
            ],
        ];
    }

    public function mount()
    {
        $this->resetDetails();
    }

    public function render()
    {
        $siswas = Siswa::with('jenjang')->get();
        $biayaPendidikans = $this->jenjang_id
            ? BiayaPendidikan::where('jenjang_id', $this->jenjang_id)->with('komponenBiaya')->get()
            : collect([]);

        $query = Pembayaran::with(['siswa', 'details.biayaPendidikan.komponenBiaya']);
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }
        $pembayarans = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.pembayaran-page', [
            'pembayarans' => $pembayarans,
            'siswas' => $siswas,
            'biayaPendidikans' => $biayaPendidikans,
            'totalJumlah' => array_sum(array_column(
                array_filter($this->details, fn($detail) => $detail['checked']),
                'jumlah'
            )),
        ]);
    }

    public function setStatusFilter($filter)
    {
        $this->statusFilter = $filter;
        $this->resetPage(); // Reset pagination to page 1
    }

    public function updatedSiswaId($value)
    {
        $siswa = Siswa::find($value);
        $this->jenjang_id = $siswa ? $siswa->jenjang_id : '';
        $this->resetDetails();
    }

    public function store()
    {
        $this->validate();

        $pembayaran = Pembayaran::create([
            'siswa_id' => $this->siswa_id,
            'tahun' => $this->tahun,
            'status' => $this->status,
        ]);

        foreach ($this->details as $detail) {
            if ($detail['checked']) {
                PembayaranDetail::create([
                    'pembayaran_id' => $pembayaran->id,
                    'biaya_pendidikan_id' => $detail['biaya_pendidikan_id'],
                    'jumlah' => $detail['jumlah'],
                ]);
            }
        }

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Pembayaran berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::with(['details', 'siswa'])->findOrFail($id);
        $this->pembayaranId = $id;
        $this->siswa_id = $pembayaran->siswa_id;
        $this->tahun = $pembayaran->tahun;
        $this->status = $pembayaran->status;
        $this->jenjang_id = $pembayaran->siswa->jenjang_id;

        $this->resetDetails();
        $existingDetails = $pembayaran->details->keyBy('biaya_pendidikan_id')->toArray();
        foreach ($this->details as $index => $detail) {
            if (isset($existingDetails[$detail['biaya_pendidikan_id']])) {
                $this->details[$index]['checked'] = true;
                $this->details[$index]['jumlah'] = $existingDetails[$detail['biaya_pendidikan_id']]['jumlah'];
            }
        }

        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $pembayaran = Pembayaran::findOrFail($this->pembayaranId);
        $pembayaran->update([
            'siswa_id' => $this->siswa_id,
            'tahun' => $this->tahun,
            'status' => $this->status,
        ]);

        $pembayaran->details()->delete();
        foreach ($this->details as $detail) {
            if ($detail['checked']) {
                PembayaranDetail::create([
                    'pembayaran_id' => $pembayaran->id,
                    'biaya_pendidikan_id' => $detail['biaya_pendidikan_id'],
                    'jumlah' => $detail['jumlah'],
                ]);
            }
        }

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Pembayaran berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function delete($id)
    {
        Pembayaran::findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Pembayaran berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function detail($id)
    {

        // dd("oke");
        $this->pembayaranId = $id;
        $this->modalDetails = Pembayaran::with(['details.biayaPendidikan.komponenBiaya', 'siswa'])->findOrFail($id);
        // dd($this->modalDetails);
        $this->dispatch('open-modal', id: 'modalDetail');
    }

    private function resetForm()
    {
        $this->siswa_id = '';
        $this->tahun = '';
        $this->status = 'tagihan';
        $this->jenjang_id = '';
        $this->resetDetails();
        $this->editMode = false;
        $this->pembayaranId = null;
        $this->modalDetails = null;
        $this->resetErrorBag();
        $this->dispatch('close-modal', id: 'modalDetail');
    }

    private function resetDetails()
    {
        $this->details = [];
        if ($this->jenjang_id) {
            $biayaPendidikans = BiayaPendidikan::where('jenjang_id', $this->jenjang_id)->get();
            foreach ($biayaPendidikans as $biaya) {
                $this->details[] = [
                    'biaya_pendidikan_id' => $biaya->id,
                    'jumlah' => $biaya->nominal,
                    'checked' => false,
                ];
            }
        }
    }
}
