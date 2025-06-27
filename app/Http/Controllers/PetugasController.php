<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Tampilkan daftar petugas dengan fitur pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $petugas = Petugas::all();
        $query = Petugas::query()->orderBy("created_at", "desc");

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%");
        }

        $perPage = $request->get('perPage', 10);
        $petugas = $query->paginate($perPage)->withQueryString();

        return view('petugas.index', compact('petugas'));
    }

    /**
     * Tampilkan form untuk tambah data petugas.
     * Ambil data level dari database supaya bisa tampil di dropdown.
     */
    public function create()
    {
        $levels = Level::all(); // Ambil semua level
        return view('petugas.create', compact('levels'));
    }

    /**
     * Simpan data petugas baru ke database.
     * Validasi input dan hash password default.
     */
    public function store(Request $request)
    {
        // Ambil semua id level untuk validasi dinamis
        $levelIds = Level::pluck('id_level')->toArray();

        $request->validate([
            'nama' => 'required|string|max:255',
            'id_level' => 'required|in:' . implode(',', $levelIds),
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'id_level' => $request->id_level,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit data petugas berdasarkan id.
     * Kirim juga data level untuk dropdown.
     */
    public function edit($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);
        $levels = Level::all();
        return view('petugas.edit', compact('petugas', 'levels'));
    }

    /**
     * Update data petugas.
     * Validasi dengan pengecualian email unik untuk petugas tersebut.
     * Jika password diisi, hash dan update.
     */
    public function update(Request $request, $id_petugas)
    {
        $levelIds = Level::pluck('id_level')->toArray();

        $request->validate([
            'nama' => 'required|string|max:255',
            'id_level' => 'required|in:' . implode(',', $levelIds),
        ]);

        $petugas = Petugas::findOrFail($id_petugas);
        $petugas->id_level = $request->id_level;

        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password);
        }

        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
    }

    /**
     * Soft delete data petugas.
     */
    public function destroy($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
