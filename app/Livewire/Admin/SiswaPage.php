<?php

namespace App\Livewire\Admin;

use App\Models\Siswa;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\User;
use App\Trait\LivewireAlertTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SiswaPage extends Component
{
    use LivewireAlertTrait;

    public $jenjang_id = '';
    public $kelas_id = '';
    public $nama = '';
    public $email = '';
    public $no_orang_tua = '';
    public $alamat = '';
    public $tanggal_lahir = '';
    public $password = '';
    public $is_active = false;
    public $editMode = false;
    public $siswaId = null;

    protected function rules()
    {
        return [
            'jenjang_id' => 'required|exists:jenjangs,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:siswas,email' . ($this->editMode ? ',' . $this->siswaId : ''),
            'no_orang_tua' => 'required|string|max:15',
            'alamat' => 'required|string|max:500',
            'tanggal_lahir' => 'required|date',
            'password' => $this->editMode ? 'nullable|string|min:8' : 'required|string|min:8',
            'is_active' => 'boolean',
        ];
    }

    public function render()
    {
        return view('livewire.admin.siswa-page', [
            'siswas' => Siswa::with(['jenjang', 'kelas'])->get(),
            'jenjangs' => Jenjang::all(),
            'kelas' => Kelas::all(),
            'gurus' => User::where('role', '!=', 'admin')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();

        Siswa::create([
            'jenjang_id' => $this->jenjang_id,
            'kelas_id' => $this->kelas_id,
            'nama' => $this->nama,
            'email' => $this->email,
            'no_orang_tua' => $this->no_orang_tua,
            'alamat' => $this->alamat,
            'tanggal_lahir' => $this->tanggal_lahir,
            'password' => bcrypt($this->password),
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Siswa berhasil ditambahkan!');
        $this->dispatch('reload-table'); // Dispatch event
    }

    public function update()
    {
        $this->validate();

        $siswa = Siswa::findOrFail($this->siswaId);
        $siswa->update([
            'jenjang_id' => $this->jenjang_id,
            'kelas_id' => $this->kelas_id,
            'nama' => $this->nama,
            'email' => $this->email,
            'no_orang_tua' => $this->no_orang_tua,
            'alamat' => $this->alamat,
            'tanggal_lahir' => $this->tanggal_lahir,
            'is_active' => $this->is_active,
            'password' => $this->password ? bcrypt($this->password) : $siswa->password,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Siswa berhasil diperbarui!');
        $this->dispatch('reload-table'); // Dispatch event
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $this->siswaId = $id;
        $this->jenjang_id = $siswa->jenjang_id;
        $this->kelas_id = $siswa->kelas_id;
        $this->nama = $siswa->nama;
        $this->email = $siswa->email;
        $this->no_orang_tua = $siswa->no_orang_tua;
        $this->alamat = $siswa->alamat;
        $this->tanggal_lahir = $siswa->tanggal_lahir->format('Y-m-d');
        $this->is_active = $siswa->is_active;
        $this->editMode = true;
    }

    public function delete($id)
    {
        Siswa::findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Siswa berhasil dihapus!');
        $this->dispatch('reload-table'); // Dispatch event
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->jenjang_id = '';
        $this->kelas_id = '';
        $this->nama = '';
        $this->email = '';
        $this->no_orang_tua = '';
        $this->alamat = '';
        $this->tanggal_lahir = '';
        $this->password = '';
        $this->is_active = false;
        $this->editMode = false;
        $this->siswaId = null;
        $this->resetErrorBag();
    }
}
