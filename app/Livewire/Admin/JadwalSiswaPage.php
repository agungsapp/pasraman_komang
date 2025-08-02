<?php

namespace App\Livewire\Admin;

use App\Models\Jadwal;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Trait\LivewireAlertTrait;
use Livewire\Component;

class JadwalSiswaPage extends Component
{
    use LivewireAlertTrait;

    public $pelajaran_id;
    public $hari;
    public $jam_mulai;
    public $jam_selesai;
    public $kelas_id;
    public $guru_id;
    public $editMode = false;
    public $jadwal_id;
    public $filter_siswa_id; // Untuk filter tampilan
    public $filter_kelas_id; // Untuk filter tampilan

    protected $rules = [
        'pelajaran_id' => 'required|exists:pelajarans,id',
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required|after:jam_mulai',
        'kelas_id' => 'nullable|exists:kelas,id',
        'guru_id' => 'nullable|exists:users,id',
    ];

    public function store()
    {
        $this->validate();

        Jadwal::create([
            'pelajaran_id' => $this->pelajaran_id,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'kelas_id' => $this->kelas_id,
            'guru_id' => $this->guru_id,
        ]);

        $this->alertSuccess('Berhasil', 'Jadwal berhasil ditambahkan!');
        $this->resetForm();
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $this->jadwal_id = $id;
        $this->pelajaran_id = $jadwal->pelajaran_id;
        $this->hari = $jadwal->hari;
        $this->jam_mulai = $jadwal->jam_mulai;
        $this->jam_selesai = $jadwal->jam_selesai;
        $this->kelas_id = $jadwal->kelas_id;
        $this->guru_id = $jadwal->guru_id;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $jadwal = Jadwal::findOrFail($this->jadwal_id);
        $jadwal->update([
            'pelajaran_id' => $this->pelajaran_id,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'kelas_id' => $this->kelas_id,
            'guru_id' => $this->guru_id,
        ]);

        $this->alertSuccess('Berhasil', 'Jadwal berhasil diperbarui!');
        $this->resetForm();
        $this->dispatch('reload-table');
    }

    public function delete($id)
    {
        Jadwal::findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Jadwal berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->pelajaran_id = null;
        $this->hari = null;
        $this->jam_mulai = null;
        $this->jam_selesai = null;
        $this->kelas_id = null;
        $this->guru_id = null;
        $this->editMode = false;
        $this->jadwal_id = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Jadwal::with(['pelajaran', 'kelas', 'guru']);

        // Filter berdasarkan siswa (jika dipilih)
        if ($this->filter_siswa_id) {
            $query->join('pelajaran_siswas', 'jadwals.pelajaran_id', '=', 'pelajaran_siswas.pelajaran_id')
                ->where('pelajaran_siswas.siswa_id', $this->filter_siswa_id);
        }

        // Filter berdasarkan kelas (jika dipilih)
        if ($this->filter_kelas_id) {
            $query->where('jadwals.kelas_id', $this->filter_kelas_id);
        }

        $jadwals = $query->get();
        $pelajarans = Pelajaran::all();
        $kelas = Kelas::all();
        $gurus = User::whereIn('role', ['guru'])->get();
        $siswas = Siswa::all();

        return view('livewire.admin.jadwal-siswa-page', [
            'jadwals' => $jadwals,
            'pelajarans' => $pelajarans,
            'kelas' => $kelas,
            'gurus' => $gurus,
            'siswas' => $siswas,
        ]);
    }
}
