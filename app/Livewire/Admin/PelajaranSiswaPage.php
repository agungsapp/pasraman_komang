<?php

namespace App\Livewire\Admin;

use App\Models\Pelajaran;
use App\Models\PelajaranSiswa;
use App\Models\Siswa;
use App\Trait\LivewireAlertTrait;
use Livewire\Component;

class PelajaranSiswaPage extends Component
{
    use LivewireAlertTrait;

    public $siswa_id = '';
    public $pelajaran_id = '';
    public $editMode = false;
    public $pelajaranSiswaId = null;

    protected function rules()
    {
        return [
            'siswa_id' => 'required|exists:siswas,id',
            'pelajaran_id' => 'required|exists:pelajarans,id|unique:pelajaran_siswas,pelajaran_id,NULL,id,siswa_id,' . ($this->editMode ? $this->siswa_id : $this->siswa_id),
        ];
    }

    public function render()
    {
        $data = [
            'pelajaranSiswas' => PelajaranSiswa::with(['siswa', 'pelajaran'])->get(),
            'siswas' => Siswa::all(),
            'pelajarans' => Pelajaran::all(),
        ];
        // dd($data);
        return view('livewire.admin.pelajaran-siswa-page', $data);
    }

    public function store()
    {
        $this->validate();

        PelajaranSiswa::create([
            'siswa_id' => $this->siswa_id,
            'pelajaran_id' => $this->pelajaran_id,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Data pelajaran siswa berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $pelajaranSiswa = PelajaranSiswa::findOrFail($id);
        $this->pelajaranSiswaId = $id;
        $this->siswa_id = $pelajaranSiswa->siswa_id;
        $this->pelajaran_id = $pelajaranSiswa->pelajaran_id;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $pelajaranSiswa = PelajaranSiswa::findOrFail($this->pelajaranSiswaId);
        $pelajaranSiswa->update([
            'siswa_id' => $this->siswa_id,
            'pelajaran_id' => $this->pelajaran_id,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Data pelajaran siswa berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function delete($id)
    {
        PelajaranSiswa::findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Data pelajaran siswa berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->siswa_id = '';
        $this->pelajaran_id = '';
        $this->editMode = false;
        $this->pelajaranSiswaId = null;
        $this->resetErrorBag();
    }
}
