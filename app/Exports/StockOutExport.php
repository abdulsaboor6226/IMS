<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use App\Models\StockOut;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockOutExport implements FromView,ShouldAutoSize,WithStyles
{
    private $stockOuts;

    public function __construct($stockOuts)
    {
        $this->stockOuts = $stockOuts;
    }
    public function view(): View
    {
        return view('stockOut.export.stock-out-export', ['stockOut' => $this->stockOuts]);
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'borders' => ['bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK ],],
                'alignment'=>['']
            ],
        ];
    }
}
