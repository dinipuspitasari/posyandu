<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnak;
use App\Models\DataOrangTua;
use App\Models\JadwalPosyandu;
use App\Models\PerkembanganAnak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class DashboardController extends Controller
{
    // public function index()
    // {
    //      return view('dashboard');
    // }
    public function index()
    {
        $totalBalita = DataAnak::count();
        $totalOrangTua = DataOrangTua::count();
        $jadwalTerdekat = JadwalPosyandu::whereDate('tanggal', '>=', now())->orderBy('tanggal')->first();
        $kehadiranHariIni = PerkembanganAnak::whereDate('tanggal_posyandu', now())->count();

        $kehadiranPerTanggal = DB::table('perkembangan_anak')
            ->selectRaw('DATE(tanggal_posyandu) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $imunisasiData = DB::table('perkembangan_anak')
            ->select('id_imunisasi', DB::raw('count(*) as total'))
            ->whereNotNull('id_imunisasi')
            ->groupBy('id_imunisasi')
            ->get();

        return view('dashboard', compact(
            'totalBalita',
            'totalOrangTua',
            'jadwalTerdekat',
            'kehadiranHariIni',
            'kehadiranPerTanggal',
            'imunisasiData'
        ));
        {
    $user = Auth::user(); // atau Auth::guard('petugas')->user(); tergantung guard

    $isKader = $user->id_level == 2;

    // Data yang ditampilkan untuk keduanya
    $totalBalita = DataAnak::count();
    $totalOrangtua = DataOrangTua::count();
    $jadwalTerdekat = JadwalPosyandu::orderBy('tanggal', 'asc')->where('tanggal', '>=', now())->first();

    return view('dashboard.kader', compact('totalBalita', 'totalOrangtua', 'jadwalTerdekat', 'isKader'));
}
    }
}


