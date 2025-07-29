<?php

namespace App\Livewire\Admin;

use App\Models\KomponenBiaya;
use App\Trait\LivewireAlertTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class KomponenBiayaPage extends Component
{
    use LivewireAlertTrait;

    public $nama = '';
    public $editMode = false;
    public $komponenId = null;

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:255|unique:komponen_biayas,nama' . ($this->editMode ? ',' . $this->komponenId : ''),
        ];
    }

    public function render()
    {
        return view('livewire.admin.komponen-biaya-page', [
            'komponens' => KomponenBiaya::all(),
        ]);
    }

    public function store()
    {
        $this->validate();

        KomponenBiaya::create([
            'nama' => $this->nama,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Komponen biaya berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $komponen = KomponenBiaya::findOrFail($id);
        $this->komponenId = $id;
        $this->nama = $komponen->nama;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $komponen = KomponenBiaya::findOrFail($this->komponenId);
        $komponen->update([
            'nama' => $this->nama,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Komponen biaya berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function delete($id)
    {
        KomponenBiaya::findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Komponen biaya berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->editMode = false;
        $this->komponenId = null;
        $this->resetErrorBag();
    }
}
