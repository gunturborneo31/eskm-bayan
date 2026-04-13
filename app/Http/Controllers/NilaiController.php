<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Models\NilaiUnsur;


class NilaiController extends Controller
{
    public function index()
    {
               error_reporting(0);

$startDate = '2024-01-01';

$endDate = '2024-10-03';

if ($_GET['tw'] == null) {
    $today = date('Y-m-d', strtotime('+1 days'));
    $endDate = $today;
} elseif ($_GET['tw'] == 1) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-03-31';
} elseif ($_GET['tw'] == 2) {
    $startDate = $_GET['Tahun'] . '-04-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 3) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 4) {
    $startDate = $_GET['Tahun'] . '-07-01';
    $endDate = $_GET['Tahun'] . '-09-31';
} elseif ($_GET['tw'] == 5) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-09-31';
} elseif ($_GET['tw'] == 6) {
    $startDate = $_GET['Tahun'] . '-10-01';
    $endDate = $_GET['Tahun'] . '-12-31';
} elseif ($_GET['tw'] == 7) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-12-31';
}

$terms = array_values(array_unique(array_filter(array_map('trim', explode(',', $_GET['bagian'])))));

        $selects = DB::table('survey_responses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('jenisPelayanan', $terms)
            ->where('tahun', $_GET['Tahun'] ?? date('Y'))
            ->paginate(20);

        return view('Nilai.index', compact('selects'));
    }


    public function cariNilaiUnsur(Request $request)
    {
        $keyword = $request->search;
        $datas = NilaiUnsur::where('nilaiUnsur', 'like', "%" . 'like', "%" . $keyword . "%");
        return view('nilaiUnsur.index', compact('datas'));
    }

    /**
     * create
     *
     * @return mixed
     */
    public function create()
    {
        return view('Nilai.create');
    }

    /**
     * store
     *
     * @return mixed
     */
    public function store(Request $request)
     {
        // echo ("request");
        // return $request;

        $data = new NilaiUnsur();
        // $data->nm_kelas = $request->nm_kelas;
        // $data->ket = $request->ket;
        // $data->save();
        // return redirect()->back();

        $store = NilaiUnsur::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'jenkel' => $request->jenkel,
            'usia' => $request->usia,
            'nohp' => $request->nohp,
            'pendidikan' => $request->pendidikan,
            'nik' => $request->nik,
            'u1' => $request->persyaratan,
            'u2' => $request->kompetensi,
            'u3' => $request->prosedur,
            'u4' => $request->perilaku,
            'u5' => $request->kecepatan,
            'u6' => $request->sarana,
            'u7' => $request->biaya,
            'u8' => $request->penanganan,
            'u9' => $request->kesesuaian,
            'saran' => $request->saran,
        ]);

        if ($store) {
            //redirect dengan pesan sukses
            return redirect('/');
        } else {
        //     //redirect dengan pesan error
            return redirect('/');
        }
    }

    /**
     * edit
     *
     * @return mixed
     */
    public function edit(request $request)
    {
        // echo ($request->jenis);
        $datas = NilaiUnsur::latest()->when(request()->search, function ($data_dasars) {
            $data_dasars = $data_dasars->where('id', 'like', '%' . request()->id_nilaiUnsur . '%');
        })
            ->where('id', $_GET['id_nilaiUnsur'])
            ->get();

        return view('Nilai.detail', compact('datas'));
    }

    /**
     * destroy
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $NilaiUnsur = NilaiUnsur::findOrFail($id);
        $NilaiUnsur->delete();

        if ($NilaiUnsur) {
            //redirect dengan pesan sukses
            return redirect()->route('NilaiUnsur.index')->with(['pesan' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('NilaiUnsur.index')->with(['pesan' => 'Data Gagal Dihapus!']);
        }
    }

    /**
     * update
     *
     * @return mixed
     */
    public function update(Request $request, NilaiUnsur $NilaiUnsur)
    {
        // print_r($request->post());
        $NilaiUnsur->update([
            'nm_nilaiUnsur' => $request->nm_nilaiUnsur,
            'ket' => $request->ket,
        ]);

        return redirect()->route('NilaiUnsur.index');
    }
}



