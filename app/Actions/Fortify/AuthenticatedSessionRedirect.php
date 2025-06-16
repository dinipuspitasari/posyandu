<?php

namespace App\Actions\Fortify;

use App\Models\DataAnak;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticatedSessionRedirect implements LoginResponseContract
{
  public function toResponse($request)
    {
        $loginMode = $request->input('login_mode');

        if ($loginMode === 'orangtua') {
            // Validasi nik_anak
            $request->validate([
                'nik_anak' => 'required|exists:data_anak,nik_anak',
            ]);

            // Cek apakah nik_anak ditemukan
            $anak = DataAnak::where('nik_anak', $request->nik_anak)->first();

            if ($anak) {
                // Simpan nik_anak ke session
                session(['nik_anak' => $anak->nik_anak]);

                // Redirect ke dashboard khusus orang tua
                return redirect()->route('dashboard-ortu');
            }

            return redirect()->back()->withErrors(['nik_anak' => 'NIK anak tidak ditemukan.']);
        }

        // Jika admin/kader
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if (in_array($user->level_id, [1, 2])) {
                return redirect()->route('dashboard');
            } elseif ($user->level_id == 3) {
                return redirect()->route('dashboard-ortu');
            }

            return redirect('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
