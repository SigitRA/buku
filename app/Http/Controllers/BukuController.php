<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Buku::select("nama_buku as value", "id")
            ->where('nama_buku', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }
    public function show(Buku $buku)
    {
        return response()->json($buku);
    }

    public function index()
    {
        $title = "Data Buku";
        $bukus = Buku::orderBy('id', 'asc')->paginate(5);
        return view('bukus.index', compact('bukus', 'title'));
    }

    public function create()
    {
        $title = "";
        return view('bukus.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required',
            'penerbit' => 'nullable',
            'tahun_terbit' => 'nullable',
        ]);

        Buku::create($request->all());

        return redirect()->route('bukus.index')->with('success', 'Buku has been created successfully.');
    }


    public function edit(Buku $buku)
    {
        $title = "Edit Data Buku";
        return view('bukus.edit', compact('buku', 'title'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'nama_buku' => 'required',
            'penerbit' => 'nullable',
            'tahun_terbit' => 'nullable',
        ]);

        $buku->update($request->all());

        return redirect()->route('bukus.index')->with('success', 'Buku has been updated successfully.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku has been deleted successfully.');
    }
}
