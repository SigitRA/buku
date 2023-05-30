<?php

namespace App\Http\Controllers;

use App\Models\Raks;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $title = "Data Rak";
        $raks = Raks::orderBy('id', 'asc')->paginate(5);
        return view('raks.index', compact('raks', 'title'));
    }

    public function create()
    {
        $title = "Tambah data rak";
        return view('raks.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required',
            'kapasitas' => 'required',
        ]);

        Raks::create($request->all());

        return redirect()->route('raks.index')->with('success', 'Rak has been created successfully.');
    }

    public function show(Raks $rak)
    {
        return view('raks.show', compact('rak'));
    }

    public function edit(Raks $rak)
    {
        $title = "Edit Data Rak";
        return view('raks.edit', compact('rak', 'title'));
    }

    public function update(Request $request, Raks $rak)
    {
        $request->validate([
            'nama_rak' => 'required',
            'kapasitas' => 'required',
        ]);

        $rak->update($request->all());

        return redirect()->route('raks.index')->with('success', 'Rak has been updated successfully.');
    }

    public function destroy(Raks $rak)
    {
        $rak->delete();
        return redirect()->route('raks.index')->with('success', 'Rak has been deleted successfully.');
    }
}
