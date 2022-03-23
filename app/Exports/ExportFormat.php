<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class ExportFormat implements WithColumnFormatting,FromView, ShouldAutoSize
{
     // use Exportable;

     public function columnFormats(): array
     {
         return [
             'B' => NumberFormat::FORMAT_TEXT,
         ];
     }
 
 
     public function view(): View
     {
         return view('pages.exports.format_excel');
     }
}
