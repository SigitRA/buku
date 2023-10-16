<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Barang::select("nama_barang as value", "id")
            ->where('nama_barang', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }
    public function show(Barang $barang)
    {
        return response()->json($barang);
    }

    public function index()
    {
        $title = "Data Barang";
        $barangs = Barang::orderBy('id', 'asc')->paginate(5);
        return view('barangs.index', compact('barangs', 'title'));
    }

    public function create()
    {
        $title = "";
        return view('barangs.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'nullable',
            'kondisi_barang' => 'nullable',
        ]);

        Barang::create($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang has been created successfully.');
    }


    public function edit(Barang $barang)
    {
        $title = "Edit Data Barang";
        return view('barangs.edit', compact('barang', 'title'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'nullable',
            'kondisi_barang' => 'nullable',
        ]);

        $barang->update($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang has been updated successfully.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang has been deleted successfully.');
    }
}
