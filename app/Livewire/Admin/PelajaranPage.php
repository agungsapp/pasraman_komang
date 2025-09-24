<?php

namespace App\Livewire\Admin;

use App\Models\Pelajaran;
use App\Trait\LivewireAlertTrait;
use Livewire\Component;

class PelajaranPage extends Component
{
    use LivewireAlertTrait;

    public $nama_pelajaran = '';
    public $tahun_ajaran = '';
    public $is_active = true;
    public $editMode = false;
    public $pelajaranId = null;

    protected function rules()
    {
        return [
            'nama_pelajaran' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
            'is_active' => 'boolean',
        ];
    }

    public function render()
    {
        return view('livewire.admin.pelajaran-page', [
            'pelajarans' => Pelajaran::all(),
        ]);
    }

    public function store()
    {
        $this->validate();

        Pelajaran::create([
            'nama_pelajaran' => $this->nama_pelajaran,
            'tahun_ajaran' => $this->tahun_ajaran,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Pelajaran berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function update()
    {
        $this->validate();

        $pelajaran = Pelajaran::findOrFail($this->pelajaranId);
        $pelajaran->update([
            'nama_pelajaran' => $this->nama_pelajaran,
            'tahun_ajaran' => $this->tahun_ajaran,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Pelajaran berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $this->pelajaranId = $id;
        $this->nama_pelajaran = $pelajaran->nama_pelajaran;
        $this->tahun_ajaran = $pelajaran->tahun_ajaran;
        $this->is_active = $pelajaran->is_active;
        $this->editMode = true;
    }

    public function delete($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->delete();
        $this->alertSuccess('Berhasil', 'Pelajaran berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama_pelajaran = '';
        $this->tahun_ajaran = '';
        $this->is_active = true;
        $this->editMode = false;
        $this->pelajaranId = null;
        $this->resetErrorBag();
    }
}
