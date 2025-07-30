<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Livewire\Admin\AdminLoginPage;
use App\Livewire\Admin\BiayaPendidikanPage;
use App\Livewire\Admin\DashboardPage;
use App\Livewire\Admin\GuruPage;
use App\Livewire\Admin\GuruPelajaranPage;
use App\Livewire\Admin\KelasPage;
use App\Livewire\Admin\KomponenBiayaPage;
use App\Livewire\Admin\PelajaranPage;
use App\Livewire\Admin\PelajaranSiswaPage;
use App\Livewire\Admin\PembayaranPage;
use App\Livewire\Admin\SiswaPage;
use App\Livewire\Siswa\HomePage;
use App\Livewire\Siswa\LoginPage;
use App\Livewire\Siswa\RegisterPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/home');
});


// route siswa
Route::get('login', LoginPage::class)->name('login');
Route::post('logout', [SiswaAuthController::class, 'logout'])->name('logout');
Route::get('register', RegisterPage::class)->name('register');
Route::get('home', HomePage::class)->name('home');


Route::prefix('admin')->name('admin.')->group(function () {
    // auth
    Route::get('login', AdminLoginPage::class)->name('login');

    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');
        // menu
        Route::get('dashboard', DashboardPage::class)->name('dashboard');
        // master
        Route::get('pelajaran', PelajaranPage::class)->name('pelajaran');
        Route::get('kelas', KelasPage::class)->name('kelas');
        Route::get('siswa', SiswaPage::class)->name('siswa');
        Route::get('guru', GuruPage::class)->name('guru');
        // pembayaran
        Route::get('komponen', KomponenBiayaPage::class)->name('komponen');
        Route::get('pembayaran', PembayaranPage::class)->name('pembayaran');
        Route::get('biaya-pendidikan', BiayaPendidikanPage::class)->name('biaya-pendidikan');
        // manajemen kelas & siswa
        Route::get('guru-pelajaran', GuruPelajaranPage::class)->name('guru-pelajaran');
        Route::get('pelajaran-siswa', PelajaranSiswaPage::class)->name('pelajaran-siswa');
    });
});
