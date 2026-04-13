<?php

namespace App\Http\Controllers;

use App\Exports\ExportJenisKelamin;
use App\Exports\ExportUsia;
use App\Exports\ExportPekerjaan;
use App\Exports\ExportPendidikan;
use App\Exports\ExportSaranMasukan;
use App\Exports\ExportResume;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller

{
    public function export(Request $request)
    {
        $type = strtolower((string) $request->query('type', 'resume'));

        $exports = [
            'jenkel' => [ExportJenisKelamin::class, 'Resume Jenis Kelamin e-skm.xlsx'],
            'usia' => [ExportUsia::class, 'Resume Usia e-skm.xlsx'],
            'pekerjaan' => [ExportPekerjaan::class, 'Resume Pekerjaan e-skm.xlsx'],
            'pendidikan' => [ExportPendidikan::class, 'Resume Pendidikan e-skm.xlsx'],
            'saranmasukan' => [ExportSaranMasukan::class, 'Resume Saran dan Masukan e-skm.xlsx'],
            'saran-masukan' => [ExportSaranMasukan::class, 'Resume Saran dan Masukan e-skm.xlsx'],
            'resume' => [ExportResume::class, 'Resume e-skm.xlsx'],
        ];

        [$exportClass, $filename] = $exports[$type] ?? $exports['resume'];

        return Excel::download(new $exportClass(), $filename);
    }

}
