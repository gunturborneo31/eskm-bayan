<?php

namespace App\Http\Controllers;

use App\Exports\ExportJenisKelamin;
use App\Exports\ExportUsia;
use App\Exports\ExportPekerjaan;
use App\Exports\ExportPendidikan;
use App\Exports\ExportSaranMasukan;
use App\Exports\ExportResume;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ExportController extends Controller

{
    public function exportJenkel(){
        return Excel::download(new ExportJenisKelamin, 'Resume Jenis Kelamin e-skm.xlsx');
    }

     public function exportUsia(){
        return Excel::download(new ExportUsia, 'Resume Usia e-skm.xlsx');
    }

     public function exportPekerjaan(){
        return Excel::download(new ExportPekerjaan, 'Resume Pekerjaan e-skm.xlsx');
    }

     public function exportPendidikan(){
        return Excel::download(new ExportPendidikan, 'Resume Pendidikan e-skm.xlsx');
    }

     public function exportSaranMasukan(){
        return Excel::download(new ExportSaranMasukan, 'Resume Saran dan Masukan e-skm.xlsx');
    }

    public function exportResume(){
        return Excel::download(new ExportResume, 'Resume Resume e-skm.xlsx');
    }

}
