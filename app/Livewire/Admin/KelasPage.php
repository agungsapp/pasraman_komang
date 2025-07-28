<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use Livewire\Component;

class KelasPage extends Component
{
    public $nama = '';
    public $editMode = false;
    public $kelasId = null;

    protected $rules = [
        'nama' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.admin.kelas-page', [
            'kelas' => Kelas::all()
        ]);
    }

    public function store()
    {
        $this->validate();

        Kelas::create([
            'nama' => $this->nama
        ]);

        $this->resetForm();
        session()->flash('message', 'Kelas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $this->kelasId = $id;
        $this->nama = $kelas->nama;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $kelas = Kelas::findOrFail($this->kelasId);
        $kelas->update([
            'nama' => $this->nama
        ]);

        $this->resetForm();
        session()->flash('message', 'Kelas berhasil diperbarui!');
    }

    public function delete($id)
    {
        Kelas::findOrFail($id)->delete();
        session()->flash('message', 'Kelas berhasil dihapus!');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->editMode = false;
        $this->kelasId = null;
        $this->resetErrorBag();
    }
}
