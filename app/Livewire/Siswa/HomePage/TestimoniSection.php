<?php

namespace App\Livewire\Siswa\HomePage;

use App\Models\User;
use Livewire\Component;

class TestimoniSection extends Component
{

    public $gurus;

    public function mount()
    {
        $this->gurus = User::where('role', 'guru')->get();
    }

    public function render()
    {
        return view('livewire.siswa.home-page.testimoni-section');
    }
}
