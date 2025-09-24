<?php

namespace App\Livewire\Siswa;

use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.siswa')]
class SiswaNilaiPage extends Component
{
    public $nilai;
    public $modalDetails;
    public $nilaiId;

    public function mount()
    {
        Auth::shouldUse('siswa');
        $this->nilai = Nilai::with(['pelajaran', 'guru', 'siswa'])
            ->where('siswa_id', Auth::user()->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.siswa.siswa-nilai-page');
    }

    public function detail($id)
    {
        $this->nilaiId = $id;
        $this->modalDetails = Nilai::with(['pelajaran', 'guru', 'siswa'])
            ->findOrFail($id);
        $this->dispatch('open-modal', id: 'modalDetail');
    }
}
