<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use App\Models\DataOrangTua;
use App\Models\Imunisasi;
use App\Models\PerkembanganAnak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataAnakController extends Controller
{
    /**
     * Tampilkan semua data anak.
     */
    public function index(Request $request)
    {
        $dataAnak = DataAnak::all();
        $query = DataAnak::with('orangTua');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('nik_anak', 'like', "%{$search}%");
        }

        $perPage = $request->get('perPage', 10);
        $dataAnak = $query->paginate($perPage)->withQueryString();

        return view('data_anak.index', compact('dataAnak'));
    }

    /**
     * Form tambah data anak.
     */
    public function create()
    {
        $orangTua = DataOrangTua::all();
        return view('data_anak.create', compact('orangTua'));
    }

    /**
     * Simpan data anak baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik_anak' => 'required|unique:data_anak,nik_anak|max:16',
            'nama_ibu' => 'required',
            'nama_anak' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:1,2',
            // 'id_data_orang_tua' => 'required|exists:data_orang_tua,id_data_orang_tua',
        ]);

        // $umur = Carbon::parse($request->tanggal_lahir)->age;

        $data =[
            'nik_anak' => $request->nik_anak,
            'nama_ibu' => $request->nama_ibu,
            'nama_anak' => $request->nama_anak,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'umur' => $request->umur_formatted,
        ];

        DataAnak::create($data);

        return redirect()->route('data_anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    /**
     * Form edit data anak.
     */
    public function edit($id_data_anak)
    {
        $anak = DataAnak::findOrFail($id_data_anak);
        $orangTua = DataOrangTua::all();
        return view('data_anak.edit', compact('anak', 'orangTua'));
    }

    /**
     * Update data anak.
     */
    public function update(Request $request, $id_data_anak)
    {
        $anak = DataAnak::findOrFail($id_data_anak);

        $request->validate([
            'nik_anak' => 'required|max:16|unique:data_anak,nik_anak,' . $anak->id_data_anak . ',id_data_anak',
            'nama_ibu' => 'required',
            'nama_anak' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:1,2',
            // 'id_data_orang_tua' => 'required|exists:data_orang_tua,id_data_orang_tua',
        ]);

        // $umur = Carbon::parse($request->tanggal_lahir)->age;

        $data = [
            'nik_anak' => $request->nik_anak,
            'nama_ibu' => $request->nama_ibu,
            'nama_anak' => $request->nama_anak,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur_formatted,
        ];

        $anak->update($data);

        return redirect()->route('data_anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    /**
     * Hapus data anak (soft delete).
     */
    public function destroy($id_data_anak)
    {
        $anak = DataAnak::findOrFail($id_data_anak);
        $anak->delete();

        return redirect()->route('data_anak.index')->with('success', 'Data anak berhasil dihapus.');
    }

  public function show($id_data_anak)
{
    // Ambil data anak lengkap dengan relasi perkembangan dan imunisasi
    $anak = DataAnak::with(['perkembangan.imunisasi'])->findOrFail($id_data_anak);

    // Hitung usia saat ini
    $usiaSekarang = \Carbon\Carbon::parse($anak->tanggal_lahir)
        ->diff(\Carbon\Carbon::now())
        ->format('%y tahun %m bulan');

    // Ambil daftar imunisasi dari perkembangan anak
    $imunisasiList = $anak->perkembangan
        ->filter(fn($perk) => $perk->imunisasi !== null)
        ->map(function ($perk) use ($anak) {
            $usiaSaatItu = \Carbon\Carbon::parse($anak->tanggal_lahir)
                ->diff(\Carbon\Carbon::parse($perk->tanggal_posyandu))
                ->format('%y tahun %m bulan');
            return [
                'tanggal' => $perk->tanggal_posyandu,
                'nama' => $perk->imunisasi->name,
                'usia' => $usiaSaatItu,
            ];
        });

    $beratBadanChart = $anak->perkembangan->map(function ($item) use ($anak) {
    // Hitung umur dalam bulan saat posyandu
    $umurBulan = \Carbon\Carbon::parse($anak->tanggal_lahir)
        ->diffInMonths(\Carbon\Carbon::parse($item->tanggal_posyandu));

    return [
        'umur' => $umurBulan,
        'berat' => $item->berat_badan,
    ];
});

// dd($beratBadanChart);
    // Kirim semua data ke view
    return view('data_anak.show', compact(
        'anak',          // Data anak dan relasi
        'usiaSekarang',  // Usia saat ini
        'imunisasiList', // List imunisasi + usia saat itu
        'beratBadanChart'// Data untuk grafik
    ));
// public function show($id_data_anak)
// {
//     // Ambil data anak lengkap dengan relasi perkembangan dan imunisasi
//     $anak = DataAnak::with(['perkembangan.imunisasi'])->findOrFail($id_data_anak);

//     // Hitung usia saat ini
//     $usiaSekarang = \Carbon\Carbon::parse($anak->tanggal_lahir)
//         ->diff(\Carbon\Carbon::now())
//         ->format('%y tahun %m bulan');

//     // Ambil daftar imunisasi dari perkembangan anak
//     $imunisasiList = $anak->perkembangan
//         ->filter(fn($perk) => $perk->imunisasi !== null)
//         ->map(function ($perk) use ($anak) {
//             $usiaSaatItu = \Carbon\Carbon::parse($anak->tanggal_lahir)
//                 ->diff(\Carbon\Carbon::parse($perk->tanggal_posyandu))
//                 ->format('%y tahun %m bulan');
//             return [
//                 'tanggal' => $perk->tanggal_posyandu,
//                 'nama' => $perk->imunisasi->name,
//                 'usia' => $usiaSaatItu,
//             ];
//         });

//     // Data berat badan per umur (hanya titik saja);
// $beratBadanChart = $anak->perkembangan->map(function ($item) use ($anak) {
//     $umurBulan = \Carbon\Carbon::parse($anak->tanggal_lahir)
//         ->diffInMonths(\Carbon\Carbon::parse($item->tanggal_posyandu));

//     return [
//         'umur' => $umurBulan,
//         'berat' => $item->berat_badan,
//     ];
// })->values(); // tambahkan values() untuk reset indexnya ke 0,1,2,...

// // Buat array grafik untuk x: umur, y: berat badan (versi scatter chart)
// $grafikBerat = $beratBadanChart->map(function ($item) {
//     return [
//         'x' => $item['umur'],
//         'y' => $item['berat']
//     ];
// });

//     return view('data_anak.show', compact(
//         'anak',
//         'usiaSekarang',
//         'imunisasiList',
//         'beratBadanChart',
//         'grafikBerat'
//     ));
// }

}
public function showGrafik($id)
{
    $anak = DataAnak::findOrFail($id);

    $beratBadanChart = Imunisasi::where('anak_id', $id)
        ->select('usia', 'berat') // usia dalam bulan, berat dalam kg
        ->orderBy('usia')
        ->get();

    return view('grafik.berat', compact('anak', 'beratBadanChart'));
}

}


 
