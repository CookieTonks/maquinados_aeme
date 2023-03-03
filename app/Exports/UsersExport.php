<?php

namespace App\Exports;

use App\Models\facturacione;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;


class UsersExport implements  FromView
{
  use Exportable;

  public $mes;

  public function __construct($mes, $year)
  {
      $this->mes = $mes;
      $this->year = $year;
  }

  public function view(): View
  {
         ob_end_clean();
        ob_start();
  return view('sistema_facturacion.excel_vista_facturacion', [
        'Facturacion' => facturacione::where('fecha_mes','=', $this->mes)->where('fecha_year', '=', $this->year)->get()
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
        return facturacione::where('fecha_mes', '=', $this->mes)->get();
    }

}
