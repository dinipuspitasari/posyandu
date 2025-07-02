<?php

use App\Http\Middleware\checklevel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\DataOrangTuaController;
use App\Http\Controllers\PerkembanganAnakController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\LoginOrtuController;
use App\Http\Controllers\DashboardOrtuController;
use App\Models\Imunisasi;
use App\Models\Petugas;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
});

// Route::post('/custom-login', [CustomLoginController::class, 'login'])->name('custom.login');
// Route::get('/dashboard', function () {
//     $user = auth()->user();

//     // Kalau yang login adalah petugas (admin/kader)
//     if (auth()->guard('petugas')->check()) {
//         return view('admin.dashboard'); // satu view saja
//     }

//     // Kalau yang login adalah orang tua
//     return view('user.dashboard'); // view untuk orang tua
// })->middleware(['auth:web,petugas']); // pastikan middleware sudah sesuai


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });



// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');
// });

Route::get('/dashboard', action: [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-ortu', action: [DashboardOrtuController::class, 'index'])->name('dashboard-ortu');

Route::get('/login-ortu', [LoginOrtuController::class, 'showLoginForm'])->name('login-ortu');
Route::post('/login-ortu', [LoginOrtuController::class, 'login'])->name('login.ortu.submit');
Route::post('/logout-ortu', [LoginOrtuController::class, 'logout'])->name('logout-ortu');

Route::get('/dashboard-ortu', [DashboardOrtuController::class, 'index'])->name('dashboard-ortu');


// ROUTE UNTUK ADMIN
Route::middleware(checklevel::class.':1')->group(function () {

});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//     Route::middleware('role:admin')->get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
//     Route::middleware('role:kader')->get('/kader/dashboard', [DashboardController::class, 'kader'])->name('kader.dashboard');
//     Route::middleware('role:ortu')->get('/ortu/dashboard', [DashboardController::class, 'ortu'])->name('ortu.dashboard');
// });



//data anak
Route::resource('data_anak', DataAnakController::class);
Route::get('/data_anak/{id}', [DataAnakController::class, 'show'])->name('data_anak.show');
Route::get('/anak/search', [DataAnakController::class, 'search'])->name('anak.search');
// Route::get('/data_anak/create', [DataAnakController::class, 'create'])->name('data_anak.create');
// Route::get('/data_anak/{id}/edit', [DataAnakController::class, 'edit'])->name('data_anak.edit');
// Route::put('data_anak/{id}', [DataAnakController::class, 'update'])->name('data_anak.update');
// Route::post('/data_anak', [DataAnakController::class, 'store'])->name('data_anak.store');
// Route::get('/data-anak/create/{id}', [DataAnakController::class, 'create'])->name('data-anak.create');
// Route::resource('data_anak', DataAnakController::class)->except(['show']);



//imunisasi
Route::resource('imunisasi', ImunisasiController::class);
// Route::get('/imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi.index');
// Route::get('/imunisasi/create', [ImunisasiController::class, 'create'])->name('imunisasi.create');
// Route::get('/imunisasi/{id}/edit', [ImunisasiController::class, 'edit'])->name('imunisasi.edit');
// Route::put('imunisasi/{id}', [ImunisasiController::class, 'update'])->name('imunisasi.update');
// Route::delete('/imunisasi/{id}', [ImunisasiController::class, 'destroy'])->name('imunisasi.destroy');


//data orang tua
Route::resource('data_orang_tua', DataOrangTuaController::class);
Route::get('/cari-nama-ibu', [App\Http\Controllers\DataOrangTuaController::class, 'cariNamaIbu'])->name('cari-nama-ibu');
// Route::get('/data_orang_tua', [DataOrangTuaController::class, 'index'])->name('data_orang_tua.index');
// Route::get('/data_orang_tua/create', [DataOrangTuaController::class, 'create'])->name('data_orang_tua.create');
// Route::get('/data_orang_tua/{id}/edit', [DataOrangTuaController::class, 'edit'])->name('data_orang_tua.edit');
// Route::post('/data_orang_tua', [DataOrangTuaController::class, 'store'])->name('data_orang_tua.store');
// Route::resource('data_orang_tua', DataOrangTuaController::class)->except(['show']);



//perkembangan anak
Route::resource('perkembangan_anak', PerkembanganAnakController::class);
// Route::get('/perkembangan_anak', [PerkembanganAnakController::class, 'index'])->name('perkembangan_anak.index');
// Route::get('/perkembangan_anak/create', [PerkembanganAnakController::class, 'create'])->name('perkembangan_anak.create');
// Route::get('/perkembangan_anak/{id}/edit', [PerkembanganAnakController::class, 'edit'])->name('perkembangan_anak.edit');
// Route::put('/perkembangan_anak/{id}', [PerkembanganAnakController::class, 'update'])->name('perkembangan_anak.update');
// Route::delete('/perkembangan_anak/{id}', [PerkembanganAnakController::class, 'destroy'])->name('perkembangan_anak.destroy');

//petugas

Route::resource('petugas', PetugasController::class);
// Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
// Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
// Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
// Route::put('petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');
// Route::resource('petugas', PetugasController::class)->except(['show']);

//jadwal posyandu
Route::resource('jadwal', JadwalPosyanduController::class);
Route::resource('jadwal', JadwalPosyanduController::class)->parameters([
    'jadwal' => 'jadwal_posyandu_id'
]);

//laporan
Route::get('/laporan/form1', [LaporanController::class, 'cetakForm1'])->name('laporan.form1');
Route::resource('laporan', LaporanController::class);
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/download/{bulan}/{tahun}', [LaporanController::class, 'download'])->name('laporan.download');
Route::get('/laporan/print/{bulan}/{tahun}', [LaporanController::class, 'print'])->name('laporan.print');


Route::get('/cek-locale', function () {
    return app()->getLocale();
});