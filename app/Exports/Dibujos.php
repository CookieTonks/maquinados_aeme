<?php

namespace App\Exports;

use App\Models\dibujo;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;


class Dibujos implements  FromView, ShouldAutoSize, WithTitle
{
  use Exportable;
    public function view(): View
    {
      return view('sistema_ingenieria.excel_vista_ingenieria', [
            'dibujos' => dibujo::where('estatus','<>', 'COMPLETADO')->get()
        ]);
    }

      public function title(): string
    {
        return 'Facturacion';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
      public function collection()
      {
          return dibujo::all();
      }
}
