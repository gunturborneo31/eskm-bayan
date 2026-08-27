<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Session;
use App\Models\NilaiUnsur;
use App\Support\BagianOptions;


class RekapTotalController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = (int) $request->query('Tahun', date('Y'));
        $startDate = $selectedYear . '-01-01';
        $endDate = $selectedYear . '-12-31';

        $query = DB::table('survey_responses')
            ->whereBetween('survey_responses.created_at', [$startDate, $endDate])
            ->where('survey_responses.tahun', $selectedYear);

        $yearTotals = DB::table('survey_responses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('tahun', $selectedYear)
            ->selectRaw('COUNT(*) as total_responden, COALESCE(SUM(u1), 0) as u1, COALESCE(SUM(u2), 0) as u2, COALESCE(SUM(u3), 0) as u3, COALESCE(SUM(u4), 0) as u4, COALESCE(SUM(u5), 0) as u5, COALESCE(SUM(u6), 0) as u6, COALESCE(SUM(u7), 0) as u7, COALESCE(SUM(u8), 0) as u8, COALESCE(SUM(u9), 0) as u9')
            ->first();

        $search = trim((string) request('search', ''));
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100], true) ? $perPage : 10;
        if ($search !== '') {
            $query->where('survey_responses.nama', 'like', '%' . $search . '%');
        }

        if (Schema::hasTable('sub_jenis')) {
            $query->leftJoin('sub_jenis', 'survey_responses.id_sub_jenis', '=', 'sub_jenis.id')
                ->select('survey_responses.*', 'sub_jenis.jenis as sub_jenis_jenis');
        } else {
            $query->select('survey_responses.*', DB::raw('NULL as sub_jenis_jenis'));
        }

        $selects = $query->paginate($perPage);
        $selects->appends(request()->query());

        return view('RekapTotal.index', compact('selects', 'search', 'perPage', 'selectedYear', 'yearTotals'));
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
    public function destroy(String $id)
    {
        $NilaiUnsur = NilaiUnsur::findOrFail($id);
        $NilaiUnsur->delete();

        if ($NilaiUnsur) {
            //redirect dengan pesan sukses
            return redirect('/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1');
        } else {
            //redirect dengan pesan erro
            return redirect('/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1');
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



