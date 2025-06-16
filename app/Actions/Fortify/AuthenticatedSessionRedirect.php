<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionRedirect implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

         // Redirect berdasarkan level user
            if ($user->level_id == 1) {
                return redirect()->route('dashboard');
            } elseif ($user->level_id == 2) {
                return redirect()->route('dashboard');
            } elseif ($user->level_id == 3) {
                return redirect()->route('dashboard');
            }

        return redirect('/'); // fallback
    }
}
}