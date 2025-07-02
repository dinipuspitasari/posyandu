<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DataAnak;
use App\Models\Laporan;
use App\Models\PerkembanganAnak;
use App\Models\Imunisasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
     public function index(Request $request)
{
    Carbon::setLocale('id');
    $perPage = $request->get('perPage', 10);
    $search = $request->get('search');

    $query = DB::table('perkembangan_anak')
        ->selectRaw('MIN(tanggal_posyandu) as tanggal_posyandu, MONTH(tanggal_posyandu) as bulan, YEAR(tanggal_posyandu) as tahun')
        ->groupBy(DB::raw('MONTH(tanggal_posyandu), YEAR(tanggal_posyandu)'))
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc');

    // Filtering by tanggal jika search ada
    if ($search) {
        $query->havingRaw('DATE(tanggal_posyandu) LIKE ?', ["%$search%"]);
    }

    $laporan = $query->paginate($perPage);

    return view('laporan.index', compact('laporan'));
}

    public function cetakForm1(Request $request)
{
    Carbon::setLocale('id');
    $bulan = (int) $request->bulan;
    $tahun = (int) $request->tahun;
    $bulan_nama = Carbon::create()->month($bulan)->translatedFormat('F');

    // Ambil data perkembangan anak yang hadir bulan itu
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

    // Rekap data anak yang hadir di posyandu
    foreach ($data as $row) {
        $umur_bulan = Carbon::parse($row->tanggal_lahir)->diffInMonths(Carbon::parse($row->tanggal_posyandu));
        $jk = strtolower(trim($row->jenis_kelamin)) === 'laki-laki' ? 'L' : 'P';

        $range = match (true) {
            $umur_bulan <= 6 => '0_6',
            $umur_bulan <= 12 => '6_12',
            $umur_bulan <= 24 => '12_24',
            $umur_bulan <= 60 => '24_60',
            default => 'lainnya'
        };

        $rekap['hadir'][$range][$jk] = ($rekap['hadir'][$range][$jk] ?? 0) + 1;

        // Rambu
        $rambu = $row->keterangan_berat_badan;
        $rekap['rambu'][$rambu][$range][$jk] = ($rekap['rambu'][$rambu][$range][$jk] ?? 0) + 1;

        if (in_array($rambu, ['N', 'T', 'O'])) {
            $rekap['kms'][$range][$jk] = ($rekap['kms'][$range][$jk] ?? 0) + 1;
        }

        // Status Gizi Berdasarkan KMS
        $status_gizi = $row->status_gizi ?? null;
        if (in_array($status_gizi, ['GL', 'H', 'K', 'M'])) {
            $rekap['status_gizi'][$status_gizi][$range][$jk] = ($rekap['status_gizi'][$status_gizi][$range][$jk] ?? 0) + 1;
        }

        // ASI Eksklusif
        $asi = strtoupper(trim($row->asi_eksklusif));
        if ($asi === 'Y') {
            $rekap['asi_eksklusif'][$range][$jk] = ($rekap['asi_eksklusif'][$range][$jk] ?? 0) + 1;
        } elseif ($asi === 'T') {
            $rekap['non_asi_eksklusif'][$range][$jk] = ($rekap['non_asi_eksklusif'][$range][$jk] ?? 0) + 1;
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
                $rekap['imunisasi'][$range][$row->id_imunisasi][$jk] = ($rekap['imunisasi'][$range][$row->id_imunisasi][$jk] ?? 0) + 1;
            }
    }

    // Ambil semua data balita dari tabel data_anak untuk rekap total balita
    $data_balita = DB::table('data_anak')->get();
    foreach ($data_balita as $anak) {
        $umur_bulan = Carbon::parse($anak->tanggal_lahir)->diffInMonths(Carbon::now());
        $jk = strtolower(trim($anak->jenis_kelamin)) === 'laki-laki' ? 'L' : 'P';

        $range = match (true) {
            $umur_bulan <= 6 => '0_6',
            $umur_bulan <= 12 => '6_12',
            $umur_bulan <= 24 => '12_24',
            $umur_bulan <= 60 => '24_60',
            default => 'lainnya'
        };

        $rekap['balita'][$range][$jk] = ($rekap['balita'][$range][$jk] ?? 0) + 1;
    }

    // Daftar imunisasi untuk tampilan nama
    $daftar_imunisasi = DB::table('imunisasi')->orderBy('id_imunisasi')->get();
    $nama_imunisasi = Imunisasi::pluck('name', 'id_imunisasi')->toArray();

    $pdf = Pdf::loadView('laporan.form1_penimbangan_pdf', [
        'bulan' => $bulan,
        'tahun' => $tahun,
        'bulan_nama' => $bulan_nama,
        'rekap' => $rekap,
        'daftar_imunisasi' => $daftar_imunisasi,
        'nama_imunisasi' => $nama_imunisasi
    ])->setPaper('A4', 'portrait');

    return $pdf->stream("form1_penimbangan_{$bulan}_{$tahun}.pdf");
}
}
