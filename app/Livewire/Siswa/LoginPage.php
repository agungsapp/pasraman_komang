<?php

namespace App\Livewire\Siswa;

use App\Trait\LivewireAlertTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.siswa')]
class LoginPage extends Component
{
    use LivewireAlertTrait;


    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        // dd($this->email, $this->password);
        $this->validate();
        // dd(" validasi lolos");

        if (Auth::guard('siswa')->attempt(['email' => $this->email, 'password' => $this->password])) {

            // dd("lolos nih");

            $this->alertSuccess("Login berhasil");
            return redirect()->intended('/home'); // Ganti dengan route tujuan setelah login
        }

        // dd("ga lolos..");
        // session()->flash('error', 'Email atau password salah.');

        $this->alertError("error", 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.siswa.login-page');
    }
}
