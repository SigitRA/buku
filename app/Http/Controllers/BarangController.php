<?php

namespace App\Http\Controllers;

use App\Models\Barangs;
use Illuminate\Http\Request;
use App\Exports\ExportBarangs;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index()
    {
        $title = "Data Barang";
        $barangs = Barangs::orderBy('id', 'asc')->paginate(5);
        return view('barangs.index', compact('barangs', 'title'));
    }

    public function create()
    {
        $title = "Tambah data barang";
        return view('barangs.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'nullable',
            'stok' => 'nullable',
            'rak' => 'nullable',
        ]);

        Barangs::create($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang has been created successfully.');
    }

    public function show(Barangs $barang)
    {
        return view('barangs.show', compact('barang'));
    }

    public function edit(Barangs $barang)
    {
        $title = "Edit Data Barang";
        return view('barangs.edit', compact('barang', 'title'));
    }

    public function update(Request $request, Barangs $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'nullable',
            'stok' => 'nullable',
            'rak' => 'nullable',
        ]);

        $barang->update($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang has been updated successfully.');
    }

    public function destroy(Barangs $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang has been deleted successfully.');
    }
}
