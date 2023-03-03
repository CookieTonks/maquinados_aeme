<?php

namespace App\Exports;

use App\Models\material_clientes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;


class Material implements FromView, ShouldAutoSize, WithTitle

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
        return view('sistema_oc.almacen.cliente.excel_material', [
            'material_cliente' => material_clientes::where('cliente', '=', $this->cliente)->get()
        ]);
    }

    public function title(): string
    {
        return 'MATERIAL CLIENTE';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return material_clientes::all();
    }
}
