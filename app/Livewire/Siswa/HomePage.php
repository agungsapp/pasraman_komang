<?php

namespace App\Livewire\Siswa;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.siswa')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.siswa.home-page');
    }
}
