<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checklevel
{
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // Cek apakah user memiliki level yang diizinkan
        if (!in_array(Auth::user()->level_id, $levels)) {
            // Arahkan ke halaman forbidden kustom
            return redirect()->route('forbidden'); // Ganti dengan nama rute yang sesuai
        }

        return $next($request);
    }
}
