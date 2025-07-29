<?php

use App\Livewire\Admin\DashboardPage;
use App\Livewire\Admin\GuruPage;
use App\Livewire\Admin\KelasPage;
use App\Livewire\Admin\KomponenBiayaPage;
use App\Livewire\Admin\PembayaranPage;
use App\Livewire\Admin\SiswaPage;
use App\Models\KomponenBiaya;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');
    Route::get('kelas', KelasPage::class)->name('kelas');
    Route::get('siswa', SiswaPage::class)->name('siswa');
    Route::get('guru', GuruPage::class)->name('guru');
    Route::get('komponen', KomponenBiayaPage::class)->name('komponen');
    Route::get('pembayaran', PembayaranPage::class)->name('pembayaran');
});
