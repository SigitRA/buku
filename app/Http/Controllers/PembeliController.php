<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Charts\PembeliLineChart;

class PembeliController extends Controller
{
    public function index()
    {
        $title = "Data Pembeli";
        $pembelis = Pembeli::orderBy('id', 'asc')->paginate(5);
        return view('pembelis.index', compact(['pembelis', 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Pembeli";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        return view('pembelis.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_trx' => 'required'
        ]);

        $pembeli = [
            'no_trx' => $request->no_trx,
            'nama_pembeli' => $request->nama_pembeli,
            'tanggal' => $request->tanggal,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];
        if ($result = Pembeli::create($pembeli)) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'no_trx' => $request->no_trx,
                    'id_barang' => $request['id_barang' . $i],
                    'qty' => $request['qty' . $i],
                    'sub_total' => $request['sub_total' . $i],
                ];
                Detail::create($details);
            }
        }
        return redirect()->route('pembelis.index')->with('success', 'Position has been created successfully.');
    }

    public function show(Pembeli $pembeli)
    {
        return view('pembelis.show', compact('Departement'));
    }

    public function edit(Pembeli $pembeli)
    {
        $title = "Edit Data Pembeli";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        $detail = Detail::where('no_trx', $pembeli->no_trx)->orderBy('id', 'asc')->get();
        return view('pembelis.edit', compact('pembeli', 'title', 'managers', 'detail'));
    }

    public function update(Request $request, $no_trx)
{
    // Temukan data Pembeli berdasarkan no_trx
    $pembeli = Pembeli::where('no_trx', $no_trx)->first();

    if (!$pembeli) {
        return back()->with('error', 'Data Pembeli tidak ditemukan.');
    }

    // Lakukan pembaruan data
    $pembeli->no_trx = $request->input('no_trx');
    $pembeli->nama_pembeli = $request->input('nama_pembeli');
    // Tambahkan pembaruan data lainnya sesuai kebutuhan

    // Simpan perubahan
    $pembeli->save();

    return redirect()->route('pembelis.index')->with('success', 'Data Pembeli berhasil diperbarui.');
}


    public function destroy(Pembeli $pembeli)
    {
        $pembeli->delete();
        return redirect()->route('pembelis.index')->with('success', 'Departement has been deleted successfully');
    }





    public function chartLine()
    {
        $api = url(route('pembelis.chartLineAjax'));

        $chart = new PembeliLineChart;
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
        $pembelis = Pembeli::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('tanggal', $year)
            ->groupBy(\DB::raw("Month(tanggal)"))
            ->pluck('count');

        $chart = new PembeliLineChart;

        $chart->dataset('New Pembeli Register Chart', 'bar', $pembelis)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return $chart->api();
    }
}
