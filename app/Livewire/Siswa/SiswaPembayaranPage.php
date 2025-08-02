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
    public $modalDetails;
    public $pembayaranId;

    public function mount()
    {
        Auth::shouldUse('siswa');
        $this->pembayaran = Pembayaran::with(['details', 'siswa'])
            ->where('siswa_id', Auth::user()->id)
            ->get();

        // Tambahkan field total_jumlah ke setiap Pembayaran
        $this->pembayaran = $this->pembayaran->map(function ($pembayaran) {
            $pembayaran->total_jumlah = $pembayaran->details->sum('jumlah');
            return $pembayaran;
        });
    }

    public function render()
    {
        return view('livewire.siswa.siswa-pembayaran-page');
    }

    public function detail($id)
    {
        // dd($id);
        $this->pembayaranId = $id;
        $this->modalDetails = Pembayaran::with(['details.biayaPendidikan.komponenBiaya', 'siswa'])
            ->findOrFail($id);
        $this->dispatch('open-modal', id: 'modalDetail');
    }
}
