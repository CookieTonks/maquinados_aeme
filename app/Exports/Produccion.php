<?php

namespace App\Exports;

use App\Models\production;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;


class Produccion implements FromView, ShouldAutoSize, WithTitle

{
    use Exportable;
    public $programador;

    public function __construct($programador)
    {
        $this->programador = $programador;
    }
    

    public function view(): View
    {
        ob_end_clean();
        ob_start();
        return view('sistema_produccion.excel_vista', [
            'Produccion' => production::where('estatus', '=', "P/FABRICACION")
                ->where('encargado', '=', $this->programador)->get()
        ]);
    }

    public function title(): string
    {
        return 'PRODUCCION';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return production::all();
    }
}
