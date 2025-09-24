<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Trait\LivewireAlertTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    use LivewireAlertTrait;

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // $this->alertSuccess("Berhasil logout");
        return redirect()->route('login')->with('message', 'Logout berhasil.');
    }
}
