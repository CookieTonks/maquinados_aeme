<?php

namespace App\Exports;

use App\Models\ocompra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ocompras implements FromView, ShouldAutoSize, WithTitle
{

  public function view(): View
    {
        return view('sistema_oc.ordenes_compras.vista_excel_compras', [
            'ocompra' => ocompra::all()
        ]);
    }

    public function title(): string
   {
       return 'OCOMPRAS';
   }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return ocompra::all();
    }
}
