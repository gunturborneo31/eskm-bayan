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

class Export implements FromCollection, WithHeadings, WithCustomStartCell,  WithColumnFormatting, ShouldAutoSize, WithStyles

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
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }


    /**

    * @return \Illuminate\Support\Collection

    */

    public function collection()

    {

        return NilaiUnsur::select("nama",  "jenkel", "created_at")->get();

    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function headings(): array

    {
        return ["NAMA", "JENIS KELAMIN", "TANGGAL SURVEY"];

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

