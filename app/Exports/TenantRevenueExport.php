<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class TenantRevenueExport implements FromCollection, ShouldAutoSize, WithCustomStartCell, WithEvents, WithHeadings, WithStrictNullComparison
{
    public function __construct(
        private Collection $summary,
        private Collection $dateColumns,
    ) {
    }

    public function collection(): Collection
    {
        return $this->summary->map(function (array $merchant): array {
            $row = [$merchant['name']];

            foreach ($this->dateColumns as $date) {
                $amount = $merchant['amount_by_date'] instanceof Collection
                    ? $merchant['amount_by_date']->get($date, 0)
                    : ($merchant['amount_by_date'][$date] ?? 0);
                $row[] = (float) ($amount ?? 0);
            }

            $row[] = (float) $merchant['total'];

            return $row;
        });
    }

    public function headings(): array
    {
        return array_merge(
            ['NAMA MERCHANT'],
            $this->dateColumns->map(fn (string $date) => date('d/m/Y', strtotime($date)))->all(),
            ['TOTAL']
        );
    }

    public function startCell(): string
    {
        return 'B4';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event): void {
                $sheet = $event->sheet->getDelegate();
                $lastColumn = Coordinate::stringFromColumnIndex($this->dateColumns->count() + 3);
                $lastRow = max(4, $sheet->getHighestRow());

                $sheet->mergeCells("B2:{$lastColumn}2");
                $sheet->setCellValue('B2', 'REKAP PENJUALAN BAYAN CRAFT TANGGAL');
                $sheet->getStyle("B2:{$lastColumn}2")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => '0F172A'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $sheet->getRowDimension(2)->setRowHeight(26);

                $sheet->getStyle("B4:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
                $sheet->getStyle("B4:{$lastColumn}4")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '0F172A'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                if ($lastRow >= 5) {
                    $sheet->getStyle("C5:{$lastColumn}{$lastRow}")
                        ->getNumberFormat()
                        ->setFormatCode('#,##0');
                }
                $sheet->getRowDimension(4)->setRowHeight(24);
            },
        ];
    }
}
