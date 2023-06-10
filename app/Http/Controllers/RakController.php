<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RAK;
use App\Models\RAKDetail;
use Illuminate\Http\Request;

class RAKController extends Controller
{
    public function index()
    {
        $title = "Data RAK";
        $raks = RAK::orderBy('id', 'asc')->paginate(5);
        return view('raks.index', compact(['raks', 'title']));
    }

    public function create()
    {
        $title = "Tambah Data RAK";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        return view('raks.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $rak = [
            'nama_rak' => $request->nama_rak,
            'kapasitas' => $request->kapasitas,
        ];
        if ($result = RAK::create($rak)) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'id_barang' => $request->id_barang,
                    'nama_rak' => $request->nama_rak,
                    'stok' => $request['stok' . $i],
                    'sub_total' => $request['sub_total' . $i],
                ];
                RAKDetail::create($details);
            }
        }
        return redirect()->route('positions.index')->with('success', 'Position has been created successfully.');
    }

    public function show(RAK $rak)
    {
        return view('raks.show', compact('Departement'));
    }

    public function edit(RAK $rak)
    {
        $title = "Edit Data RAK";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        $detail = RAKDetail::where('nama_rak', $rak->nama_rak)->orderBy('id', 'asc')->get();
        return view('raks.edit', compact('rak', 'title', 'managers', 'detail'));
    }

    public function update(Request $request, RAK $rak)
    {
        $raks = [

            'nama_rak' => $request->nama_rak,
            'kapasitas' => $request->kapasitas,
        ];
        if ($rak->fill($raks)->save()) {
            RAKDetail::where('id', $rak->id)->delete();
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [

                    'id_barang' => $request->id_barang,
                    'nama_rak' => $request->nama_rak,
                    'stok' => $request['stok' . $i],
                    'sub_total' => $request['sub_total' . $i],
                ];
                RAKDetail::create($details);
            }
        }

        return redirect()->route('raks.index')->with('success', 'Departement Has Been updated successfully');
    }

    public function destroy(RAK $rak)
    {
        $rak->delete();
        return redirect()->route('raks.index')->with('success', 'Departement has been deleted successfully');
    }
}
