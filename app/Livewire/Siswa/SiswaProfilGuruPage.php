<?php

namespace App\Livewire\Siswa;

use App\Models\User;
use App\Trait\LivewireAlertTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;

#[Layout('layouts.siswa')]
class SiswaProfilGuruPage extends Component
{
    use LivewireAlertTrait;
    public $guru;

    public function mount($id_guru)
    {
        // Validasi bahwa $id_guru adalah integer
        if (!is_numeric($id_guru) || $id_guru <= 0) {
            $this->alertError('id_guru', 'ID guru tidak valid.');
            return;
        }

        // Gunakan scope 'guru' dan eager load relasi 'pelajarans'
        $this->guru = User::with('pelajarans')->guru()->find($id_guru);

        // Jika guru tidak ditemukan, log dan tampilkan error
        if (!$this->guru) {
            Log::warning("Guru dengan ID {$id_guru} tidak ditemukan atau bukan guru.");
            $this->alertError('guru', 'Guru tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.siswa.siswa-profil-guru-page');
    }
}
