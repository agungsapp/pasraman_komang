<?php

namespace App\Livewire\Siswa;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.siswa')]
class SiswaPembayaranPage extends Component
{

    public $pembayaran;

    public function mount()
    {

        Auth::shouldUse('siswa');
        // dd(Auth::user()->id);
        $this->pembayaran = Pembayaran::where('siswa_id', Auth::user()->id)->get();


        // dd($this->pembayaran);
    }

    public function render()
    {
        return view('livewire.siswa.siswa-pembayaran-page');
    }
}
