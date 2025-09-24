<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProfilePage extends Component
{
    public $user;

    // Properti untuk form ganti password
    #[Rule('required|string')]
    public $current_password;

    #[Rule('required|string|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    public function mount()
    {
        // Ambil data user yang sedang login
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.admin.profile-page');
    }

    public function updatePassword()
    {
        $this->validate();

        // Verifikasi password lama
        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password lama salah.');
            return;
        }

        // Update password
        $this->user->update([
            'password' => Hash::make($this->password),
        ]);

        // Reset form
        $this->reset(['current_password', 'password', 'password_confirmation']);

        // Tampilkan notifikasi sukses
        session()->flash('message', 'Password berhasil diperbarui.');

        // Dispatch event untuk menutup modal
        $this->dispatch('close-modal', id: 'modalPassword');
    }
}
