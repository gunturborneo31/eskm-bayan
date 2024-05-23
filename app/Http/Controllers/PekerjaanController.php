<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Models\NilaiUnsur;


class PekerjaanController extends Controller
{
    public function index()
    {
                error_reporting(0);

        $startDate = '2024-01-01';
        $endDate = '2024-10-03';

        if($_GET['Bulan']==null){
            $today = date('Y-m-d',strtotime("+1 days"));
            $endDate=$today;
        }else if($_GET['Bulan']==1){
            $endDate = '2024-01-31';
        }else if($_GET['Bulan']==2){
            $endDate = '2024-02-30';
        }else if($_GET['Bulan']==3){
            $endDate = '2024-03-31';
        }else if($_GET['Bulan']==4){
            $endDate = '2024-04-30';
        }else if($_GET['Bulan']==5){
            $endDate = '2024-05-31';
        }else if($_GET['Bulan']==6){
            $endDate = '2024-06-30';
        }else if($_GET['Bulan']==7){
            $endDate = '2024-07-31';
        }else if($_GET['Bulan']==8){
            $endDate = '2024-08-30';
        }else if($_GET['Bulan']==9){
            $endDate = '2024-09-31';
        }else if($_GET['Bulan']==10){
            $endDate = '2024-10-30';
        }else if($_GET['Bulan']==11){
            $endDate = '2024-11-31';
        }else if($_GET['Bulan']==12){
            $endDate = '2024-12-30';
        }

         if($_GET['filter']==null or $_GET['filter']==1){
            $selects = DB::table('2024')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);
        } else if($_GET['filter']==2) {
            $selects = DB::table('2024')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('pekerjaan', 'pns')
            ->paginate(10);
        }  else if($_GET['filter']==3) {
            $selects = DB::table('2024')
            ->where('pekerjaan', 'nonasn')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);
        } else if($_GET['filter']==4) {
            $selects = DB::table('2024')
            ->where('pekerjaan', 'mahasiswa')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);
        } else if($_GET['filter']==5) {
            $selects = DB::table('2024')
            ->where('pekerjaan', 'swasta')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);
        } else if($_GET['filter']==6) {
            $selects = DB::table('2024')
            ->where('pekerjaan', 'lainnya')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);
        }

        if($_GET['Tahun']==2023 or $_GET['Tahun']==2025){
            $selects = DB::table('2023')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);}

        return view('Pekerjaan.index', compact('selects'));

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
     * @return void
     */
    public function create()
    {
        return view('Pekerjaan.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
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
            'Pekerjaan' => $request->Pekerjaan,
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
     * @param  mixed $NilaiUnsur
     * @return void
     */
    public function edit(request $request)
    {
        // echo ($request->jenis);
        $datas = NilaiUnsur::latest()->when(request()->search, function ($data_dasars) {
            $data_dasars = $data_dasars->where('id', 'like', '%' . request()->id_nilaiUnsur . '%');
        })
            ->where('id', $_GET['id_nilaiUnsur'])
            ->get();

        return view('Pekerjaan.detail', compact('datas'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
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
     * @param  mixed $request
     * @param  mixed $NilaiUnsur
     * @return void
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
