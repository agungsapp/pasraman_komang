<?php

namespace App\Livewire\Admin;

use App\Models\GuruPelajaran;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\User;
use App\Trait\LivewireAlertTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class GuruPelajaranPage extends Component
{
    use LivewireAlertTrait, WithPagination;

    public $guru_id = '';
    public $details = [];
    public $editMode = false;
    public $guruPelajaranId = null;
    public $modalDetails = null;

    protected function rules()
    {
        return [
            'guru_id' => 'required|exists:users,id,role,guru',
            'details.*.pelajaran_id' => 'required|exists:pelajarans,id',
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
                        $fail('Setidaknya satu pelajaran harus dipilih.');
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
        $gurus = User::where('role', 'guru')->get();
        $pelajarans = Pelajaran::where('is_active', true)->get();

        $guruPelajarans = GuruPelajaran::with(['guru', 'pelajaran'])
            ->groupBy('guru_id')
            ->selectRaw('guru_id, GROUP_CONCAT(pelajaran_id) as pelajaran_ids, MAX(id) as max_id')
            ->orderBy('max_id', 'desc')
            ->paginate(10);

        return view('livewire.admin.guru-pelajaran-page', [
            'guruPelajarans' => $guruPelajarans,
            'gurus' => $gurus,
            'pelajarans' => $pelajarans,
        ]);
    }

    public function updatedGuruId($value)
    {
        $this->resetDetails();
    }

    public function store()
    {
        $this->validate();

        foreach ($this->details as $detail) {
            if ($detail['checked']) {
                GuruPelajaran::create([
                    'guru_id' => $this->guru_id,
                    'pelajaran_id' => $detail['pelajaran_id'],
                ]);
            }
        }

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Data Guru Pelajaran berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function edit($guru_id)
    {
        $guruPelajarans = GuruPelajaran::where('guru_id', $guru_id)->with('pelajaran')->get();
        $pelajaranIds = $guruPelajarans->pluck('pelajaran_id')->toArray();

        // Check if any pelajaran is linked to a kelas with siswa
        $conflictingKelas = [];
        foreach ($pelajaranIds as $pelajaran_id) {
            $pelajaran = Pelajaran::find($pelajaran_id);
            $kelasWithSiswa = $pelajaran->kelas()->whereHas('siswa')->with(['siswa'])->get();
            if ($kelasWithSiswa->isNotEmpty()) {
                foreach ($kelasWithSiswa as $kelas) {
                    $siswaNames = $kelas->siswa->pluck('nama')->implode(', ');
                    $conflictingKelas[] = "Kelas {$kelas->nama} (Siswa: {$siswaNames})";
                }
            }
        }

        if (!empty($conflictingKelas)) {
            $this->alert('error', 'Tidak bisa mengedit!', [
                'text' => 'Pelajaran terhubung dengan kelas yang memiliki siswa: ' . implode('; ', $conflictingKelas),
            ]);
            return;
        }

        $this->guru_id = $guru_id;
        $this->guruPelajaranId = $guru_id;
        $this->resetDetails();
        $existingDetails = $guruPelajarans->keyBy('pelajaran_id')->toArray();
        foreach ($this->details as $index => $detail) {
            if (isset($existingDetails[$detail['pelajaran_id']])) {
                $this->details[$index]['checked'] = true;
            }
        }

        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        // Check for conflicts again during update
        $guruPelajarans = GuruPelajaran::where('guru_id', $this->guruPelajaranId)->with('pelajaran')->get();
        $pelajaranIds = $guruPelajarans->pluck('pelajaran_id')->toArray();
        $conflictingKelas = [];
        foreach ($pelajaranIds as $pelajaran_id) {
            $pelajaran = Pelajaran::find($pelajaran_id);
            $kelasWithSiswa = $pelajaran->kelas()->whereHas('siswa')->with(['siswa'])->get();
            if ($kelasWithSiswa->isNotEmpty()) {
                foreach ($kelasWithSiswa as $kelas) {
                    $siswaNames = $kelas->siswa->pluck('nama')->implode(', ');
                    $conflictingKelas[] = "Kelas {$kelas->nama} (Siswa: {$siswaNames})";
                }
            }
        }

        if (!empty($conflictingKelas)) {
            $this->alert('error', 'Tidak bisa mengedit!', [
                'text' => 'Pelajaran terhubung dengan kelas yang memiliki siswa: ' . implode('; ', $conflictingKelas),
            ]);
            return;
        }

        GuruPelajaran::where('guru_id', $this->guruPelajaranId)->delete();
        foreach ($this->details as $detail) {
            if ($detail['checked']) {
                GuruPelajaran::create([
                    'guru_id' => $this->guru_id,
                    'pelajaran_id' => $detail['pelajaran_id'],
                ]);
            }
        }

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Data Guru Pelajaran berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function delete($guru_id)
    {
        $guruPelajarans = GuruPelajaran::where('guru_id', $guru_id)->with('pelajaran')->get();
        $pelajaranIds = $guruPelajarans->pluck('pelajaran_id')->toArray();
        $conflictingKelas = [];
        foreach ($pelajaranIds as $pelajaran_id) {
            $pelajaran = Pelajaran::find($pelajaran_id);
            $kelasWithSiswa = $pelajaran->kelas()->whereHas('siswa')->with(['siswa'])->get();
            if ($kelasWithSiswa->isNotEmpty()) {
                foreach ($kelasWithSiswa as $kelas) {
                    $siswaNames = $kelas->siswa->pluck('nama')->implode(', ');
                    $conflictingKelas[] = "Kelas {$kelas->nama} (Siswa: {$siswaNames})";
                }
            }
        }

        if (!empty($conflictingKelas)) {
            $this->alert('error', 'Tidak bisa menghapus!', [
                'text' => 'Pelajaran terhubung dengan kelas yang memiliki siswa: ' . implode('; ', $conflictingKelas),
            ]);
            return;
        }

        GuruPelajaran::where('guru_id', $guru_id)->delete();
        $this->alertSuccess('Berhasil', 'Data Guru Pelajaran berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function detail($guru_id)
    {
        $this->guruPelajaranId = $guru_id;
        $this->modalDetails = GuruPelajaran::where('guru_id', $guru_id)->with(['guru', 'pelajaran'])->get();
        $this->dispatch('open-modal', id: 'modalDetail');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->guru_id = '';
        $this->resetDetails();
        $this->editMode = false;
        $this->guruPelajaranId = null;
        $this->modalDetails = null;
        $this->resetErrorBag();
        $this->dispatch('close-modal', id: 'modalDetail');
    }

    private function resetDetails()
    {
        $this->details = [];
        $pelajarans = Pelajaran::where('is_active', true)->get();
        foreach ($pelajarans as $pelajaran) {
            $this->details[] = [
                'pelajaran_id' => $pelajaran->id,
                'checked' => false,
            ];
        }
    }
}
