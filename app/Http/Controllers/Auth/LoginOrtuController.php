<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAnak;

class LoginOrtuController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-ortu');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik_anak' => 'required|exists:data_anak,nik_anak',
        ]);

        $anak = DataAnak::where('nik_anak', $request->nik_anak)->first();

        // Simpan nik_anak ke session agar bisa digunakan di halaman lain
        session(['nik_anak' => $anak->nik_anak]);

        return redirect()->route('dashboard-ortu')->with('success', 'Login berhasil sebagai orang tua.');
    }

    public function logout()
    {
        session()->forget('nik_anak');
        return redirect()->route('login-ortu')->with('success', 'Logout berhasil.');
    }
}
