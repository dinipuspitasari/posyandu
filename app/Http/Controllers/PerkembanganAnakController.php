<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganAnak;
use App\Models\Imunisasi;
use App\Models\DataAnak;
use Illuminate\Http\Request;

class PerkembanganAnakController extends Controller
{
    // Menampilkan semua data perkembangan anak
    // public function index()
    // {
    //     $perkembangan = PerkembanganAnak::with(['imunisasi', 'anak'])->latest()->get();
    //     return view('perkembangan_anak.index', compact('perkembangan'));
    // }
// public function index(Request $request)
// {
//     $perkembangan = PerkembanganAnak::with(['imunisasi', 'anak'])->latest()->get();
//     // $query = PerkembanganAnak::with(['imunisasi', 'anak'])->latest();
//     $query = PerkembanganAnak::query();

//     if ($request->filled('search')) {
//         $search = $request->search;
//         $query->where('nama_anak', 'like', "%{$search}%")
//               ->orWhere('nik_anak', 'like', "%{$search}%");
//     }

//     $perPage = $request->get('perPage', 10);

//     $perkembangan = $query->paginate($perPage)->withQueryString();

//     return view('perkembangan_anak.index', compact('perkembangan'));
// }

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
    $perkembangan->getCollection()->transform(function ($item) {
        $item->usia_bulan = \Carbon\Carbon::parse($item->anak->tanggal_lahir)
                                ->diffInMonths($item->tanggal_posyandu);
        $item->jenis_kelamin = $item->anak->jenis_kelamin;
        return $item;
    });

    return view('perkembangan_anak.index', compact('perkembangan'));
}

public function create()
    {
        $dataAnak = DataAnak::all();
        $imunisasi = Imunisasi::all();
        return view('perkembangan_anak.create', compact('dataAnak', 'imunisasi' ));
    }

//menyimpan data baru perkembangan anak
public function store(Request $request)
{
    $validated = $request->validate([
        'nik_anak' => 'required|exists:data_anak,nik_anak',
        'nama_anak'=> 'required|exists:data_anak,nama_anak',
        'tanggal_posyandu' => 'required|date',
        'berat_badan' => 'required|numeric',
        'keterangan_berat_badan' => 'required|in:N,T,O,B',
        'tinggi_badan' => 'required|numeric',
        'lingkar_lengan_atas' => 'required|numeric',
        'keterangan_lingkar_lengan' => 'required|in:Hijau,Merah',
        'lingkar_kepala' => 'required|numeric',
        'id_imunisasi' => 'exists:imunisasi,id_imunisasi',
        'pemberian' => 'nullable|in:Vitamin A,Obat Cacing',
        'mt_pangan_lokal' => 'required|in:Y,T',
        'asi_eksklusif' => 'required|in:Y,T',
        'edukasi' => 'nullable|string',
        'rujuk' => 'nullable|string',
    ]);

    $perkembangan = PerkembanganAnak::create($validated);

    // PerkembanganAnak::create($validated);

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
        'nik_anak' => 'required|exists:data_anak,nik_anak',
        'nama_anak' => 'required|string',
        'tanggal_posyandu' => 'required|date',
        'berat_badan' => 'required|numeric',
        'keterangan_berat_badan' => 'required|in:N,T,O,B',
        'tinggi_badan' => 'required|numeric',
        'lingkar_lengan_atas' => 'required|numeric',
        'keterangan_lingkar_lengan' => 'required|in:Hijau,Merah',
        'lingkar_kepala' => 'required|numeric',
        'id_imunisasi' => 'exists:imunisasi,id_imunisasi',
        'pemberian' => 'nullable|in:Vitamin A,Obat Cacing',
        'mt_pangan_lokal' => 'required|in:Y,T',
        'asi_eksklusif' => 'required|in:Y,T',
        'edukasi' => 'nullable|string',
        'rujuk' => 'nullable|string',
    ]);

    unset($validated['nik_anak']);
    unset($validated['nama_anak']);

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
