<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ImunisasiController extends Controller
{
    public function index(Request $request)
    {
        // $data = Imunisasi::orderBy('created_at', 'desc')->get();
        $query = Imunisasi::query()->orderBy("created_at", "desc");
        if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%");
    }
        $perPage = $request->get('perPage', 10);
        $data = $query->paginate($perPage)->withQueryString();
        
        return view('imunisasi.index', compact('data'));

    }
    public function create()
    {
        return view('imunisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:imunisasi,name',
        ]);

        Imunisasi::create([
            'name' => $request->name,
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data imunisasi berhasil ditambahkan');
    }

    public function edit($id_imunisasi)
    {
        $item = Imunisasi::findOrFail($id_imunisasi);
        return view('imunisasi.edit', compact('item'));
    }

    public function update(Request $request, $id_imunisasi)
    {
        $request->validate([
                'name' => [
                'required',
                Rule::unique('imunisasi')->ignore($request->id_imunisasi, 'id')
            ],
        ]);

        $item = Imunisasi::findOrFail($id_imunisasi);
        $item->update([
            'name' => $request->name,
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data imunisasi berhasil diupdate');
    }

    public function destroy($id_imunisasi)
    {
        $item = Imunisasi::findOrFail($id_imunisasi);
        $item->delete();

        return redirect()->route('imunisasi.index')->with('success', 'Data imunisasi berhasil dihapus');
    }

    public function show($id_imunisasi)
    {
        $data = Imunisasi::findOrFail($id_imunisasi);
        return view('imunisasi.show', compact('data'));
    }

}