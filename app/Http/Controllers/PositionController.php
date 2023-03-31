<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Positions;

class PositionController extends Controller
{
    //
    public function index()
    {
        $title = "Position";
        $positions = Positions::orderBy('id', 'asc')->paginate(5);
        return view('positions.index', compact(['positions', 'title']));
    }

    public function create()
    {
        $title = "Position";
        return view('positions.create', compact('title'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'keterangan',
            'alias'
        ]);

        Positions::create($request->post());

        return redirect()->route('positions.index')->with('success', 'Positions has been created successfully.');
    }


    public function show(Positions $positions)
    {
        return view('positions.show', compact('positions'));
    }


    public function edit(Positions $positions)
    {
        return view('positions.edit', compact('positions'));
    }


    public function update(Request $request, Positions $positions)
    {
        $request->validate([
            'name' => 'required',
            'keterangan',
            'alias'
        ]);

        $positions->fill($request->post())->save();

        return redirect()->route('positions.index')->with('success', 'Positions Has Been updated successfully');
    }


    public function destroy(Positions $positions)
    {
        $positions->delete();
        return redirect()->route('positions.index')->with('success', 'Positions has been deleted successfully');
    }
}
