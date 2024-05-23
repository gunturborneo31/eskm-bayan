<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Models\NilaiUnsur;


class DashboardController extends Controller
{
    public function index()
    {
        // echo (""+Session::get('subbidang'));
        $selects = DB::table('2024')
            ->get();

        return view('dashboard', compact('selects'));
    }

     public function welcome()
    {
        if(date('m')<=3){
            $tw=1;
        } else if(date('m')<=6){
            $tw=3;
        } else if(date('m')<=9){
            $tw=5;
        } else if(date('m')<=12){
            $tw=7;
        }

        if (array_key_exists("tw", $_GET)){
            // echo "ada";
        } else {
            // echo "kosong";
            
            return redirect("?tw=".$tw."&Tahun=".date('Y'));
        }

        // $tahun = date("Y");
        // dd($tahun);
          // echo (""+Session::get('subbidang'));
        $responden = [];
        $singkatan = [];

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'];

        error_reporting(0);
        if ($_GET['Bulan'] == '') {
            for ($x = 0; $x <= date('m'); $x++) {
                $responden[$x] = DB::table("2024")
                    ->whereMonth('created_at', '=', $x + 1)
                    ->get()
                    ->count();
                $singkatan[$x] = $bulan[$x];
                $jml = date('m');
            }
        } else {
            for ($x = 0; $x <= $_GET['Bulan']; $x++) {
                $responden[$x] = DB::table("2024")
                    ->whereMonth('created_at', '=', $x + 1)
                    ->get()
                    ->count();
                $singkatan[$x] = $bulan[$x];
                $jml = $_GET['Bulan'];
            }
        }
        // dd($responden);

            $responden = json_encode($responden);
            $singkatan = json_encode($singkatan);

        $i = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // dd ($jml);

        if($i == '/remake'){

        } else {
            return view('welcome', compact('selects','responden','bln','jml', 'singkatan'));
        }
        // return view('welcome', compact('selects','responden','bln','jml', 'singkatan'));
    }


    public function cariDashboard(Request $request)
    {
        $keyword = $request->search;
        $datas = NilaiUnsur::where($tahun, 'like', "%" . 'like', "%" . $keyword . "%");
        return view('dashboard.index', compact('datas'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('dashboardAdmin');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        if(($request->username=="admin") && ($request->password=="admin")){
            return redirect("/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=".fmod(date('m'), 3)."&Tahun=".date('Y'));
        } else {
            return redirect("/login");
        }
    }

    /**
     * edit
     *
     * @param  mixed $Dashboard
     * @return void
     */
    public function edit(request $request)
    {
        // echo ($request->jenis);
        // $datas = Dashboard::latest()->when(request()->search, function ($data_dasars) {
        //     $data_dasars = $data_dasars->where('id', 'like', '%' . request()->id_dashboard . '%');
        // })
        //     ->where('id', $_GET['id_dashboard'])
        //     ->get();

        // return view('Dashboard.detail', compact('datas'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // $Dashboard = Dashboard::findOrFail($id);
        // $Dashboard->delete();

        // if ($Dashboard) {
        //     //redirect dengan pesan sukses
        //     return redirect()->route('Dashboard.index')->with(['pesan' => 'Data Berhasil Dihapus!']);
        // } else {
        //     //redirect dengan pesan error
        //     return redirect()->route('Dashboard.index')->with(['pesan' => 'Data Gagal Dihapus!']);
        // }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $Dashboard
     * @return void
     */
    // public function update(Request $request, Dashboard $Dashboard)
    // {
    //     // print_r($request->post());
    //     $Dashboard->update([
    //         'nm_dashboard' => $request->nm_dashboard,
    //         'ket' => $request->ket,
    //     ]);

    //     return redirect()->route('Dashboard.index');
    // }
}
