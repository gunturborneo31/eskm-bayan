<?php



namespace App\Exports;



use App\Models\NilaiUnsur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ExportUsia implements FromCollection, WithHeadings, WithCustomStartCell,  WithColumnFormatting, ShouldAutoSize, WithStyles

{
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B2')->getFont()->setBold(true);
        $sheet->getStyle('C2')->getFont()->setBold(true);
        $sheet->getStyle('D2')->getFont()->setBold(true);
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }


    /**

    * @return \Illuminate\Support\Collection

    */

    public function collection()

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

        $baseQuery = DB::table('survey_responses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('tahun', $_GET['Tahun'] ?? date('Y'));

        if($_GET['filter']==null or $_GET['filter']==1){
            $selects = $baseQuery->get(['nik','nama','usia','created_at']);
        } else if($_GET['filter']==2) {
            $selects = (clone $baseQuery)->where('usia', 'laki')->get(['nik','nama','usia','created_at']);
        } else if($_GET['filter']==3) {
            $selects = (clone $baseQuery)->where('usia', 'perempuan')->get(['nik','nama','usia','created_at']);
        } else {
            $selects = $baseQuery->get(['nik','nama','usia','created_at']);
        }

        // return dd($_GET['filter']);

        return $selects;

    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function headings(): array

    {
        return ["NIK","NAMA", "USIA (TAHUN)", "TANGGAL SURVEY"];

    }

    public function startCell(): string
    {
        return 'B2';
    }

    	 public function registerEvents()
    {

		//border style
		$styleArray = [
				'borders' => [
					'outline' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					//'color' => ['argb' => 'FFFF0000'],
						],
					],
				];
            }

}

