<?php

namespace App\Exports;

use App\Models\calidadsalida;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;


class Salida implements FromView, ShouldAutoSize, WithTitle

{
    use Exportable;
    public $cliente;

    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }


    public function view(): View
    {
        ob_end_clean();
        ob_start();

        $salidas = calidadsalida::where('destino', '=', $this->cliente)->get();
        return view('sistema_oc.almacen.cliente.excel_salida_cliente', compact('salidas'));
       
    }

    public function title(): string
    {
        return 'SALIDAS CLIENTE';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return calidadsalida::all();
    }
}
