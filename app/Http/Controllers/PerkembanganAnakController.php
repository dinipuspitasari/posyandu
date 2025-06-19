<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganAnak;
use App\Models\Imunisasi;
use App\Models\DataAnak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PerkembanganAnakController extends Controller
{
public function index(Request $request)
{
    $query = PerkembanganAnak::with(['imunisasi', 'anak'])->latest();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('anak', function ($q) use ($search) {
            $q->where('nama_anak', 'like', "%{$search}%")
              ->orWhere('nik_anak', 'like', "%{$search}%");
        });
    }

    $perPage = $request->get('perPage', 10);
    $perkembangan = $query->paginate($perPage)->withQueryString();

    // Tambahkan mapping untuk usia & jenis kelamin agar bisa digunakan di view/grafik
    // $perkembangan->getCollection()->transform(function ($item) {
    //     $item->usia_bulan = \Carbon\Carbon::parse($item->anak->tanggal_lahir)
    //                             ->diffInMonths($item->tanggal_posyandu);
    //     $item->jenis_kelamin = $item->anak->jenis_kelamin;
    //     return $item;
    // });
    
    $perkembangan->getCollection()->transform(function ($item) {
    $tanggal_lahir = \Carbon\Carbon::parse($item->anak->tanggal_lahir);
    $tanggal_posyandu = \Carbon\Carbon::parse($item->tanggal_posyandu);
    $selisih = $tanggal_lahir->diff($tanggal_posyandu);

    $item->umur_formatted = $selisih->y . ' tahun ' . $selisih->m . ' bulan';
    $item->jenis_kelamin = $item->anak->jenis_kelamin;

    return $item;
});


    return view('perkembangan_anak.index', compact('perkembangan'));
}

public function create()
{
    $dataAnak = DataAnak::all();
    $imunisasi = Imunisasi::all();
    return view('perkembangan_anak.create', compact('dataAnak', 'imunisasi'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'id_data_anak' => 'required|exists:data_anak,id_data_anak',
        'tanggal_posyandu' => 'required|date',
        'berat_badan' => 'required|numeric',
        'keterangan_berat_badan' => 'required|in:N,T,O,B',
        'tinggi_badan' => 'required|numeric',
        'lingkar_lengan_atas' => 'nullable|numeric',
        'lingkar_kepala' => 'nullable|numeric',
        'id_imunisasi' => 'nullable|exists:imunisasi,id_imunisasi',
        'pemberian' => 'nullable|in:Vitamin A,Obat Cacing',
        'mt_pangan_lokal' => 'required|in:Y,T',
        'asi_eksklusif' => 'nullable|in:Y,T',
        'edukasi' => 'nullable|string',
        'rujuk' => 'nullable|string',
    ]);

    // Cari data anak berdasarkan ID
    $anak = DataAnak::find($validated['id_data_anak']);

    if (!$anak) {
        return back()->withErrors(['id_data_anak' => 'Data anak tidak ditemukan.']);
    }

    // Tambahkan data nama & NIK ke array validated
    $validated['nama_anak'] = $anak->nama_anak;
    $validated['nik_anak'] = $anak->nik_anak;

    // Simpan ke tabel perkembangan_anak
    PerkembanganAnak::create($validated);

    return redirect()->route('perkembangan_anak.index')->with('success', 'Data berhasil ditambahkan.');
}



public function show($id_perkembangan_anak)
{
    $data = PerkembanganAnak::with(['id_imunisasi', 'anak'])->findOrFail($id_perkembangan_anak);
    return response()->json($data);
}

//edit data perkembangan anak
public function edit($id_perkembangan_anak)
{
    $perkembangan = PerkembanganAnak::with('anak')->findOrFail($id_perkembangan_anak);
    // $imunisasi = Imunisasi::all();
    // return view('perkembangan_anak.edit', compact('perkembangan', 'imunisasi'));
    return view('perkembangan_anak.edit', compact('perkembangan'));
}


//memperbarui data perkembangan anak
public function update(Request $request, $id_perkembangan_anak)
{
    $perkembangan = PerkembanganAnak::findOrFail($id_perkembangan_anak);

    $validated = $request->validate([
        'id_data_anak' => 'required|exists:data_anak,id_data_anak',
        'nik_anak' => 'required|exists:data_anak,nik_anak',
        'nama_anak' => 'required|string',
        'tanggal_posyandu' => 'required|date',
        'berat_badan' => 'required|numeric',
        'keterangan_berat_badan' => 'required|in:N,T,O,B',
        'tinggi_badan' => 'required|numeric',
        'lingkar_lengan_atas' => 'nullable|numeric',
        'keterangan_lingkar_lengan' => 'nullable|in:Hijau,Merah',
        'lingkar_kepala' => 'required|numeric',
        'id_imunisasi' => 'exists:imunisasi,id_imunisasi',
        'pemberian' => 'nullable|in:Vitamin A,Obat Cacing',
        'mt_pangan_lokal' => 'required|in:Y,T',
        'asi_eksklusif' => 'nullable|in:Y,T',
        'edukasi' => 'nullable|string',
        'rujuk' => 'nullable|string',
    ]);

    // Dapatkan data anak berdasarkan ID
    $anak = DataAnak::findOrFail($validated['id_data_anak']);

    // Tambahkan nama dan NIK dari data anak untuk disimpan sebagai redundansi (display cepat)
    $validated['nama_anak'] = $anak->nama_anak;
    $validated['nik_anak'] = $anak->nik_anak;

    // Jangan update nik_anak dan nama_anak supaya data anak tidak berubah dari sini
    $perkembangan->update($validated);

    return redirect()->route('perkembangan_anak.index')->with('success', 'Data berhasil diperbarui.');
}
// Menghapus data perkembangan anak
    public function destroy($id_perkembangan_anak)
    {
        $perkembangan = PerkembanganAnak::findOrFail($id_perkembangan_anak);
        $perkembangan->delete();

        return redirect()->route('perkembangan_anak.index')->with('success', 'Data berhasil dihapus.');
    }
}
