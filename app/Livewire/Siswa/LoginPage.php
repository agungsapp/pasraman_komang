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

    public function mount()
    {
        if (Auth::guard('siswa')->check()) {
            // dd("siswa");
            return redirect()->to(route('home'));
        }
    }

    public function login()
    {
        // dd($this->email, $this->password);
        $this->validate();
        // dd(" validasi lolos");
        // handle error validasi

        if (Auth::guard('siswa')->attempt(['email' => $this->email, 'password' => $this->password])) {

            // dd("lolos nih");

            $this->alertSuccess("Login berhasil");
            return redirect()->intended('/home');
        }

        // dd("ga lolos..");
        // session()->flash('error', 'Email atau password salah.');

        $this->alertError("error", 'Email atau password salah.');
        // return redirect()->to(route('login'));
    }

    public function render()
    {
        return view('livewire.siswa.login-page');
    }
}
