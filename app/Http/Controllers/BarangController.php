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
}
