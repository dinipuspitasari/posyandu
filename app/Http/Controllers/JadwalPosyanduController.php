<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Petugas;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    // Menampilkan semua data jadwal posyandu
    public function index(Request $request)
    {
        $jadwal = JadwalPosyandu::with('petugas')->latest()->get();
        $query = JadwalPosyandu::with('petugas')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_kegiatan', 'like', "%{$search}%");
        }

        $perPage = $request->get('perPage', 10);
        $jadwal = $query->paginate($perPage)->withQueryString();

        return view('jadwal.index', compact('jadwal'));
    }

    // Menampilkan form tambah jadwal posyandu
    public function create()
    {
        $petugas = Petugas::all();
        return view('jadwal.create', compact('petugas'));
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
            'id_petugas' => 'required|exists:petugas,id_petugas',
        ]);

        JadwalPosyandu::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id_jadwal_posyandu)
    {
        $jadwal = JadwalPosyandu::findOrFail($id_jadwal_posyandu);
        $petugas = Petugas::all();

        return view('jadwal.edit', compact('jadwal', 'petugas'));
    }

    // Menyimpan perubahan pada jadwal
    public function update(Request $request, $id_jadwal_posyandu)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
            'id_petugas' => 'required|exists:petugas,id_petugas',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($id_jadwal_posyandu);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Menghapus data jadwal
    public function destroy($id_jadwal_posyandu)
    {
        $jadwal = JadwalPosyandu::findOrFail($id_jadwal_posyandu);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
