<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penyimpanan;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Charts\PenyimpananLineChart;

class PenyimpananController extends Controller
{
    public function index()
    {
        $title = "Data Penyimpanan";
        $penyimpanans = Penyimpanan::orderBy('id', 'asc')->paginate(5);
        return view('penyimpanans.index', compact(['penyimpanans', 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Penyimpanan";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        return view('penyimpanans.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_simpan' => 'required'
        ]);

        $penyimpanan = [
            'no_simpan' => $request->no_simpan,
            'lorong' => $request->lorong,
            'tanggal' => $request->tanggal,
            'genre' => $request->genre,
        ];
        if ($result = Penyimpanan::create($penyimpanan)) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'no_simpan' => $request->no_simpan,
                    'id_buku' => $request['id_buku' . $i],
                    'stok' => $request['stok' . $i],
                    'sub_total' => $request['sub_total' . $i],
                ];
                Detail::create($details);
            }
        }
        return redirect()->route('penyimpanans.index')->with('success', 'Position has been created successfully.');
    }

    public function show(Penyimpanan $penyimpanan)
    {
        return view('penyimpanans.show', compact('Departement'));
    }

    public function edit(Penyimpanan $penyimpanan)
    {
        $title = "Edit Data Penyimpanan";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        $detail = Detail::where('no_simpan', $penyimpanan->no_simpan)->orderBy('id', 'asc')->get();
        return view('penyimpanans.edit', compact('penyimpanan', 'title', 'managers', 'detail'));
    }

    public function update(Request $request, $no_simpan)
{
    // Temukan data Penyimpanan berdasarkan no_simpan
    $penyimpanan = Penyimpanan::where('no_simpan', $no_simpan)->first();

    if (!$penyimpanan) {
        return back()->with('error', 'Data Penyimpanan tidak ditemukan.');
    }

    // Lakukan pembaruan data
    $penyimpanan->no_simpan = $request->input('no_simpan');
    $penyimpanan->lorong = $request->input('lorong');
    // Tambahkan pembaruan data lainnya sesuai kebutuhan

    // Simpan perubahan
    $penyimpanan->save();

    return redirect()->route('penyimpanans.index')->with('success', 'Data Penyimpanan berhasil diperbarui.');
}


    public function destroy(Penyimpanan $penyimpanan)
    {
        $penyimpanan->delete();
        return redirect()->route('penyimpanans.index')->with('success', 'Departement has been deleted successfully');
    }





    public function chartLine()
    {
        $api = url(route('penyimpanans.chartLineAjax'));

        $chart = new PenyimpananLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Chart Ajax";
        return view('chart', compact('chart', 'title'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $penyimpanans = Penyimpanan::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('tanggal', $year)
            ->groupBy(\DB::raw("Month(tanggal)"))
            ->pluck('count');

        $chart = new PenyimpananLineChart;

        $chart->dataset('New Penyimpanan Register Chart', 'bar', $penyimpanans)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return $chart->api();
    }
}
