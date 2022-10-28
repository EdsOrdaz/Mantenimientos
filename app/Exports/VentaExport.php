<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;

class VentaExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithBackgroundColor
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        global $request;
        return collect($request->session()->get("equipos")[0]);
    }

    
    public function headings(): array
    {
        $headers = Array(
            "Economico",
            "Tipo",
            "Marca",
            "Modelo",
            "Núm Serie",
            "Memora RAM",
            "Disco Duro",
            "Procesador",
            "Sistema Operativo",
            "Precio",
            "Observaciones"
        );
        return $headers;
    }

    public function backgroundColor()
    {
        return 'FFFFFF';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        global $request;
        $num = count($request->session()->get("equipos")[0])+1;
        return [
            AfterSheet::class => function (AfterSheet $event) use ($num){
                $event->sheet->getStyle('A1:K'.$num)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A1:K1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('8a8a8a');
                $event->sheet->getStyle('A1:K1')->getFont()
                ->getColor()
                ->setARGB('FFFFFF');
            }
        ];
    }
}
