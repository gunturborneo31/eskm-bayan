<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\SurveyResponse;

class OfflineSkmController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,xlsm',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getSheetByName('Data') ?? $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $imported = 0;
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            if (empty($row[0])) continue; // skip baris kosong

            SurveyResponse::create([
                'jenisPelayanan' => $row[0],
                'nama' => $row[1],
                'nohp' => $row[2],
                'alamat' => $row[3],
                'jenkel' => $row[4],
                'usia' => $row[5],
                'pendidikan' => $row[6],
                'pekerjaan' => $row[7],
                'u1' => $row[8],
                'u2' => $row[9],
                'u3' => $row[10],
                'u4' => $row[11],
                'u5' => $row[12],
                'u6' => $row[13],
                'u7' => $row[14],
                'u8' => $row[15],
                'u9' => $row[16],
                'saran' => $row[17],
                'tahun' => $row[18],
            ]);
            $imported++;
        }

        return redirect()->route('admin.offline-skm')->with('success', "Berhasil import $imported data SKM offline.");
    }
}
