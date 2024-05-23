<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiUnsur;
use App\Models\tahun_2023;
use App\Models\tahun_2024;

class SkmController extends Controller
{
    public function viewPostData()
    {
        return view('request.post-data');
    }

    public function upload_skm(Request $request)
    {
        // echo ("request");
        // return $request;

        $data = new NilaiUnsur();
        $currentDate = new DateTime();
         $year = $currentDate->format("Y");
        dd();
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
            return redirect('/skm');
        } else {
        //     //redirect dengan pesan error
            return redirect('/skm');
        }
    }
}
