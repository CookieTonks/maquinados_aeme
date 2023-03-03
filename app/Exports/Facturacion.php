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


class Facturacion implements FromView, ShouldAutoSize, WithTitle

{
    use Exportable;

    public function view(): View
    {
        ob_end_clean();
        ob_start();
        return view('sistema_facturacion.excel_vista_facturacion', [
            'Facturacion' => facturacione::whereMonth('fecha_registro', '=', date('m'))
                ->where('estatus', '<>', 'CANCELADA')
                ->where('estatus', '<>', 'P/REFACTURA')
                ->get()

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
        return facturacione::all();
    }
}
