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
        $nikAnak = session('nik_anak');

        if (!$nikAnak) {
            return redirect()->route('login-ortu')->with('error', 'Silakan login terlebih dahulu.');
        }

        $anak = DataAnak::with(['perkembangan.imunisasi'])
            ->where('nik_anak', $nikAnak)
            ->first();

        if (!$anak) {
            return back()->with('error', 'Data anak tidak ditemukan.');
        }

        $usiaSekarang = Carbon::parse($anak->tanggal_lahir)
            ->diff(Carbon::now())
            ->format('%y tahun %m bulan');

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

        // ✅ Ambil jadwal posyandu terdekat dari sekarang
        $jadwalBerikutnya = JadwalPosyandu::whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->first();

        // ✅ Tambahkan grafik berat badan berdasarkan umur (dalam bulan)
        $beratBadanChart = [];
        if ($anak->perkembangan->count() > 0) {
            $beratBadanChart = $anak->perkembangan->map(function ($perk) use ($anak) {
                $umurBulan = Carbon::parse($anak->tanggal_lahir)
                    ->diffInMonths(Carbon::parse($perk->tanggal_posyandu));
                return [
                    'umur' => $umurBulan,
                    'berat' => $perk->berat_badan,
                ];
            });
        }

        return view('dashboard-ortu', compact(
            'anak',
            'imunisasiList',
            'usiaSekarang',
            'jadwalBerikutnya',
            'beratBadanChart' // ditambahkan ke view
        ));
    }
}
