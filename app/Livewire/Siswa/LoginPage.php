<?php

namespace App\Livewire\Siswa;

use App\Trait\LivewireAlertTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

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
        $this->validate();

        if (Auth::guard('siswa')->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('message', 'Login berhasil!');

            $this->alertSuccess("Login berhasil");
            return redirect()->intended('/home'); // Ganti dengan route tujuan setelah login
        }

        session()->flash('error', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.siswa.login-page');
    }
}
