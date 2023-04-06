<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $title = "Data Departements";
        $departements = Departements::orderBy('id', 'asc')->paginate(5);
        return view('departements.index', compact(['departements', 'title']));
    }

    public function create()
    {
        $title = "Tambah data departement";
        return view('departements.create', compact(['title']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location',
            'manager_id',
        ]);

        Departements::create($request->post());

        return redirect()->route('departements.index')->with('success', 'Departements has been created successfully.');
    }


    public function show(Departements $departement)
    {
        return view('departements.show', compact('departements'));
    }


    public function edit(Departements $departement)
    {
        $title = "Edit Data departement";
        return view('departements.edit', compact('departement', 'title'));
    }


    public function update(Request $request, Departements $departement)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);

        $departement->fill($request->post())->save();

        return redirect()->route('departements.index')->with('success', 'Departemnt Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departements  $departements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departements $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'departements has been deleted successfully');
    }
}
