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

class DashboardOrtuController extends Controller
{
public function index()
    {
        // Ambil nik_anak dari session (hasil login)
        $nikAnak = session('nik_anak');

        // Jika nik tidak tersedia di session, redirect ke halaman login
        if (!$nikAnak) {
            return redirect()->route('login-ortu')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data anak berdasarkan nik yang login
        $anak = DataAnak::with(['perkembangan.imunisasi'])
            ->where('nik_anak', $nikAnak)
            ->first();

        if (!$anak) {
            return back()->with('error', 'Data anak tidak ditemukan.');
        }

        // Hitung usia sekarang dari tanggal lahir anak
        $usiaSekarang = Carbon::parse($anak->tanggal_lahir)
            ->diff(Carbon::now())
            ->format('%y tahun %m bulan');

        // Ambil data imunisasi dari relasi perkembangan
        $imunisasiList = $anak->perkembangan
            ->filter(fn($perk) => $perk->imunisasi !== null)
            ->map(function ($perk) use ($anak) {
                $usiaSaatItu = Carbon::parse($anak->tanggal_lahir)
                    ->diff(Carbon::parse($perk->tanggal_posyandu))
                    ->format('%y tahun %m bulan');

                return [
                    'tanggal' => $perk->tanggal_posyandu,
                    'nama' => $perk->imunisasi?->name ?? '-',
                    'usia' => $usiaSaatItu,
                ];
            });

        return view('dashboard-ortu', compact('anak', 'imunisasiList', 'usiaSekarang'));
    }
}


