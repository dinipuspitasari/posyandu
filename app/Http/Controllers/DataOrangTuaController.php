<?php

namespace App\Http\Controllers;

use App\Models\DataOrangTua;
use App\Models\DataAnak;
use Illuminate\Http\Request;

class DataOrangTuaController extends Controller
{
    // tampilkan semua data orang tua
    public function index(Request $request)
    {
        $orangTua = DataOrangTua::with('anak')->get();
        $query = DataOrangTua::query();

        if ($request->filled('search')) {
        $search = $request->search;
        $query->where('nama_ibu', 'like', "%{$search}%")
              ->orWhere('nik_ibu', 'like', "%{$search}%");
        }

        $perPage = $request->get('perPage', 10);
        $orangTua = $query->paginate($perPage)->withQueryString();

        return view('data_orang_tua.index', compact('orangTua'));
    }

    // form tambah data orang tua
    public function create()
    {
        return view('data_orang_tua.create');
    }

    // simpan data orang tua baru
    public function store(Request $request)
    {
        $request->validate([
            'nik_ibu' => 'required|unique:data_orang_tua,nik_ibu|max:16',
            'nama_ibu' => 'required',
            'no_telpon' => 'required|numeric',
            'alamat' => 'required',
        ]);

        DataOrangTua::create($request->all());
        return redirect()->route('data_orang_tua.index')->with('success', 'Data orang tua berhasil ditambahkan');
    }

    // form edit data orang tua
    public function edit($id_data_orang_tua)
    {
        $orangTua = DataOrangTua::with('anak')->findOrFail($id_data_orang_tua);
        return view('data_orang_tua.edit', compact('orangTua'));
    }

    // update data orang tua
    public function update(Request $request, $id_data_orang_tua)
    {
        $orangTua = DataOrangTua::findOrFail($id_data_orang_tua);

        $request->validate([
            'unique:data_orang_tua,nik_ibu,' . $orangTua->id_data_orang_tua . ',id_data_orang_tua',
            'nama_ibu' => 'required',
            'no_telpon' => 'required|numeric',
            'alamat' => 'required',
        ]);

        $orangTua->update($request->all());

        return redirect()->route('data_orang_tua.index')->with('success', 'Data orang tua berhasil diperbarui');

        // // simpan data orang tua
        // $orangTua->create($request->all());

        // return redirect()->route('data_orang_tua.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // hapus data orang tua
    public function destroy($id_data_orang_tua)
    {
        $orangTua = DataOrangTua::findOrFail($id_data_orang_tua);
        $orangTua->delete();

        return redirect()->route('data_orang_tua.index')->with('success', 'Data orang tua berhasil dihapus');
    }

    public function show($id_data_anak)
    {
        $anak = DataAnak::findOrFail($id_data_anak);
        return view('data_anak.show', compact('anak'));
    }

public function cariNamaIbu(Request $request)
{
    $search = $request->q;

    $ibu = DataOrangTua::where('nama_ibu', 'like', '%' . $search . '%')
        ->select('id_data_orang_tua as id', 'nama_ibu as text')
        ->get();

    return response()->json($ibu);
}

}
