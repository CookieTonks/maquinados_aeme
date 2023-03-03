<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correo_seguimiento_modificacion;
use App\Mail\liberacion;
use App\Mail\material_en_almacen;
use App\Http\Controllers\Season;
use Illuminate\Support\Arr;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Produccion;
use App\Models;
use \Illuminate\Filesystem\FilesystemManager;

class direccion_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if ($request->ajax()) {

      $data = models\Events::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start', 'end']);

      return response()->json($data);
    }

    return view('sistema_direccion.fullcalender');
  }
  public function ajax(Request $request)
  {
    switch ($request->type) {
      case 'add':
        $event = models\Events::create([
          'title' => $request->title,
          'start' => $request->start,
          'end' => $request->end,
        ]);

        return response()->json($event);
        break;

      case 'update':
        $event = models\Events::find($request->id)->update([
          'title' => $request->title,
          'start' => $request->start,
          'end' => $request->end,
        ]);

        return response()->json($event);
        break;

      case 'delete':
        $event = models\Events::find($request->id)->delete();

        return response()->json($event);
        break;

      default:
        # code...
        break;
    }
  }

  public function home_direccion_proceso()
  {
    $ot_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_compras', '<>', 'DONE')
      ->where('sistema_ingenieria', '<>', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $ot_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_ot', '=', 'DONE')
      ->where('sistema_compras', '<>', 'DONE')
      ->where('sistema_ingenieria', '<>', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();

    $compras_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_compras', '<>', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $compras_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_compras', '<>', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();

    $ingenieria_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_ingenieria', '<>', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $ingenieria_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_ingenieria', '<>', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();

    $produccion_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $produccion_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '<>', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();



    $calidad_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '=', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $calidad_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '=', 'DONE')
      ->where('sistema_calidad', '<>', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();

    $embarques_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '=', 'DONE')
      ->where('sistema_calidad', '=', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $embarques_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '=', 'DONE')
      ->where('sistema_calidad', '=', 'DONE')
      ->where('sistema_embarques', '<>', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();

    $facturacion_total = Models\aeme_ruta::where('sistema_ot', '=', 'DONE')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '=', 'DONE')
      ->where('sistema_calidad', '=', 'DONE')
      ->where('sistema_embarques', '=)', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->count();

    $facturacion_data = DB::table('datamains')
      ->join('aeme_rutas', 'datamains.orden_trabajo', '=', 'aeme_rutas.ot')
      ->where('sistema_ingenieria', '=', 'DONE')
      ->where('sistema_compras', '=', 'DONE')
      ->where('sistema_produccion', '=', 'DONE')
      ->where('sistema_calidad', '=', 'DONE')
      ->where('sistema_embarques', '=', 'DONE')
      ->where('sistema_facturacion', '<>', 'DONE')
      ->get();
    return view('sistema_direccion.home_direccion_proceso', compact('ot_total', 'ot_data', 'compras_total', 'compras_data', 'ingenieria_total', 'ingenieria_data',  'produccion_total', 'produccion_data', 'calidad_total', 'calidad_data', 'embarques_total', 'embarques_data', 'facturacion_total', 'facturacion_data'));
  }
}
