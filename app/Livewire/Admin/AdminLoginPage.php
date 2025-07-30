<?php

namespace App\Livewire\Admin;

use App\Trait\LivewireAlertTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLoginPage extends Component
{
    use LivewireAlertTrait;

    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        // Attempt login with role restriction
        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'staff', 'guru'])) {
                $this->alertSuccess('Berhasil', 'Login berhasil!');
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                $this->alertError('error', 'Anda tidak memiliki izin untuk mengakses halaman admin.');
            }
        } else {
            $this->alertError('error', 'Email atau password salah.');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-login-page')
            ->layout('layouts.auth');
    }
}
