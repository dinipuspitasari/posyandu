<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DataAnak;
use App\Models\PerkembanganAnak;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function cetakForm1(Request $request)
    {
        $bulan = (int) $request->bulan;
        $tahun = (int) $request->tahun;

        $bulan_nama = Carbon::create()->month($bulan)->translatedFormat('F');

        $data = DB::table('perkembangan_anak')
            ->join('data_anak', 'perkembangan_anak.nik_anak', '=', 'data_anak.nik_anak')
            ->select(
                'perkembangan_anak.*',
                'data_anak.jenis_kelamin',
                'data_anak.tanggal_lahir'
            )
            ->whereMonth('tanggal_posyandu', $bulan)
            ->whereYear('tanggal_posyandu', $tahun)
            ->get();

        $rekap = [];
        $rekap['hadir_posyandu'] = 0;

        foreach ($data as $row) {
            $umur_bulan = Carbon::parse($row->tanggal_lahir)->diffInMonths(Carbon::parse($row->tanggal_posyandu));
            $jk = $row->jenis_kelamin == 'Laki-laki' ? 'L' : 'P';

            $range = match (true) {
                $umur_bulan <= 6 => '0_6',
                $umur_bulan <= 12 => '6_12',
                $umur_bulan <= 24 => '12_24',
                $umur_bulan <= 60 => '24_60',
                default => 'lainnya'
            };

            // Kehadiran dan jumlah balita
            $rekap['hadir'][$range][$jk] = ($rekap['hadir'][$range][$jk] ?? 0) + 1;
            $rekap['balita'][$range][$jk] = ($rekap['balita'][$range][$jk] ?? 0) + 1;

            // Rambu
            $rambu = $row->keterangan_berat_badan;
            $rekap['rambu'][$rambu][$range][$jk] = ($rekap['rambu'][$rambu][$range][$jk] ?? 0) + 1;

            if (in_array($rambu, ['N', 'T', 'O'])) {
                $rekap['kms'][$range][$jk] = ($rekap['kms'][$range][$jk] ?? 0) + 1;
            }

            // Status Gizi Berdasarkan KMS
            $status_gizi = $row->status_gizi ?? null; // ganti sesuai kolom di DB
            if (in_array($status_gizi, ['GL', 'H', 'K', 'M'])) {
                $rekap['status_gizi'][$status_gizi][$range][$jk] = ($rekap['status_gizi'][$status_gizi][$range][$jk] ?? 0) + 1;
            }

            // ASI eksklusif
            if ($row->asi_eksklusif === 'Y') {
                $rekap['asi'][$range][$jk] = ($rekap['asi'][$range][$jk] ?? 0) + 1;
            } else {
                $rekap['non_asi'][$range][$jk] = ($rekap['non_asi'][$range][$jk] ?? 0) + 1;
            }

            // Vitamin A
            if ($row->pemberian === 'Vitamin A') {
                if ($umur_bulan >= 6 && $umur_bulan < 12) {
                    $rekap['vit_a']['6_12'][$jk] = ($rekap['vit_a']['6_12'][$jk] ?? 0) + 1;
                } elseif ($umur_bulan >= 12 && $umur_bulan <= 59) {
                    $subrange = $umur_bulan < 24 ? '12_24' : '24_60';
                    $rekap['vit_a'][$subrange][$jk] = ($rekap['vit_a'][$subrange][$jk] ?? 0) + 1;
                }
            }

            // Imunisasi
            if (!empty($row->id_imunisasi)) {
                $rekap['imunisasi'][$row->id_imunisasi][$jk] = ($rekap['imunisasi'][$row->id_imunisasi][$jk] ?? 0) + 1;
            }
        }

        $pdf = Pdf::loadView('laporan.form1_penimbangan_pdf', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulan_nama' => $bulan_nama,
            'rekap' => $rekap
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("form1_penimbangan_{$bulan}_{$tahun}.pdf");
    }
}
