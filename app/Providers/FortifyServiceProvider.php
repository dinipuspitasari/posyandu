<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;
use App\Models\DataAnak;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

//     Fortify::authenticateUsing(function (Request $request) {
//     // Coba login sebagai petugas/admin
//     $credentials = $request->only('email', 'password');

//        // Jika user mengisi email dan password, cek sebagai admin/kader
//     if (!empty($credentials['email']) && !empty($credentials['password'])) {
//         if (Auth::attempt($credentials)) {
//             return Auth::user(); // berhasil login sebagai admin/kader
//         }
//     }

//       // Jika user mengisi NIK anak, cek sebagai orang tua
//     if ($request->filled('nik_anak')) {
//         $anak = \App\Models\DataAnak::where('nik_anak', $request->nik_anak)->first();

//         if ($anak && $anak->orangTua) {
//             Auth::login($anak->orangTua);
//             return $anak->orangTua;
//         } else {
//             return null; // GAGAL LOGIN kalau nik_anak tidak ditemukan
//         }
//     }
//     return null;
// });

Fortify::authenticateUsing(function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');
    $nikAnak = $request->input('nik_anak');

    // LOGIN ADMIN/KADER: Hanya jika email & password diisi
    if (!empty($email) && !empty($password)) {
        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null; // Gagal login jika kombinasi salah
    }

    // LOGIN ORANG TUA: Hanya jika NIK anak valid
    if (!empty($nikAnak)) {
        $anak = \App\Models\DataAnak::where('nik_anak', $nikAnak)->first();

        if ($anak && $anak->orangTua) {
            Auth::login($anak->orangTua);
            return $anak->orangTua;
        }

        return null; // Gagal login jika nik_anak tidak cocok
    }

    // Jika semua kosong, tolak login
    return null;
});

    }
    
}
