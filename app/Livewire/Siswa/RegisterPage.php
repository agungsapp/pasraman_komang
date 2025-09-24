<?php

namespace App\Livewire\Siswa;

use App\Models\Jenjang;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.siswa')]
class RegisterPage extends Component
{

    public $nama;
    public $email;
    public $password;
    public $jenjang_id;
    public $no_orang_tua;
    public $alamat;
    public $tanggal_lahir;
    public $jenjangs;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:siswas,email',
        'password' => 'required|min:8',
        'jenjang_id' => 'required|exists:jenjangs,id',
        'no_orang_tua' => 'required|string|max:15',
        'alamat' => 'required|string',
        'tanggal_lahir' => 'required|date',
    ];

    public function mount()
    {
        $this->jenjangs = Jenjang::all();
        // dd($this->jenjangs);
    }

    public function register()
    {
        // $this->validate();


        try {
            Log::info('Oke jalan mau create');
            $siswa =  Siswa::create([
                'nama' => $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'jenjang_id' => $this->jenjang_id,
                'no_orang_tua' => $this->no_orang_tua,
                'alamat' => $this->alamat,
                'tanggal_lahir' => $this->tanggal_lahir,
                'is_active' => true, // Default true
            ]);
            Log::info('Oke jalan sudha di create');

            // dd($siswa);

            session()->flash('message', 'Registrasi berhasil! Silakan login.');
            // dd("oke");
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error($e);
            session()->flash('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.siswa.register-page');
    }
}
