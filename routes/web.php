<?php

use App\Livewire\Admin\DashboardPage;
use App\Livewire\Admin\KelasPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', DashboardPage::class)->name('dashboard');
Route::get('kelas', KelasPage::class)->name('kelas');
