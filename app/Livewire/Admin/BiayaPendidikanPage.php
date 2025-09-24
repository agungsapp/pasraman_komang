<?php

namespace App\Livewire\Admin;

use App\Models\BiayaPendidikan;
use App\Models\Jenjang;
use App\Models\KomponenBiaya;
use App\Trait\LivewireAlertTrait;
use Livewire\Component;

class BiayaPendidikanPage extends Component
{
    use LivewireAlertTrait;

    public $jenjang_id = '';
    public $komponen_biaya_id = '';
    public $nominal = '';
    public $editMode = false;
    public $biayaId = null;

    protected function rules()
    {
        return [
            'jenjang_id' => 'required|exists:jenjangs,id',
            'komponen_biaya_id' => 'required|exists:komponen_biayas,id',
            'nominal' => 'required|numeric|min:0',
        ];
    }

    public function render()
    {
        return view('livewire.admin.biaya-pendidikan-page', [
            'biayas' => BiayaPendidikan::with(['jenjang', 'komponenBiaya'])->get(),
            'jenjangs' => Jenjang::all(),
            'komponenBiayas' => KomponenBiaya::all(),
        ]);
    }

    public function store()
    {
        $this->validate();

        // Cek apakah kombinasi jenjang_id dan komponen_biaya_id sudah ada
        $existingBiaya = BiayaPendidikan::where('jenjang_id', $this->jenjang_id)
            ->where('komponen_biaya_id', $this->komponen_biaya_id)
            ->first();

        if ($existingBiaya) {
            $this->alertError('Gagal', 'Data sudah ada, silakan diedit.');
            return;
        }

        BiayaPendidikan::create([
            'jenjang_id' => $this->jenjang_id,
            'komponen_biaya_id' => $this->komponen_biaya_id,
            'nominal' => $this->nominal,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Biaya pendidikan berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function update()
    {
        $this->validate();

        // Cek apakah kombinasi jenjang_id dan komponen_biaya_id sudah ada, kecuali untuk entri yang sedang diedit
        $existingBiaya = BiayaPendidikan::where('jenjang_id', $this->jenjang_id)
            ->where('komponen_biaya_id', $this->komponen_biaya_id)
            ->where('id', '!=', $this->biayaId)
            ->first();

        if ($existingBiaya) {
            $this->alertError('Gagal', 'Data sudah ada, silakan diedit.');
            return;
        }

        $biaya = BiayaPendidikan::findOrFail($this->biayaId);
        $biaya->update([
            'jenjang_id' => $this->jenjang_id,
            'komponen_biaya_id' => $this->komponen_biaya_id,
            'nominal' => $this->nominal,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Biaya pendidikan berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $biaya = BiayaPendidikan::findOrFail($id);
        $this->biayaId = $id;
        $this->jenjang_id = $biaya->jenjang_id;
        $this->komponen_biaya_id = $biaya->komponen_biaya_id;
        $this->nominal = $biaya->nominal;
        $this->editMode = true;
    }

    public function delete($id)
    {
        $biaya = BiayaPendidikan::findOrFail($id);
        if ($biaya->pembayaranDetails()->count() > 0) {
            $this->alertError('Gagal', 'Biaya tidak dapat dihapus karena terkait dengan pembayaran.');
            return;
        }
        $biaya->delete();
        $this->alertSuccess('Berhasil', 'Biaya pendidikan berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->jenjang_id = '';
        $this->komponen_biaya_id = '';
        $this->nominal = '';
        $this->editMode = false;
        $this->biayaId = null;
        $this->resetErrorBag();
    }
}
