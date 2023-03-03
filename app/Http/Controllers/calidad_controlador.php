<?php

namespace App\Http\Controllers;

use App\Models;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Route;


class calidad_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index_calidad()
  {
    $mostrar = DB::table('datamains')
      ->join('calidadsalidas', 'datamains.orden_trabajo', '=', 'calidadsalidas.ot')
      ->where('calidadsalidas.estatus', '=', 'PENDIENTE')
      ->select('datamains.cliente', 'datamains.codigo_pieza', 'calidadsalidas.*')
      ->get();

    return view('sistema_calidad.home_sistema_calidad', compact('mostrar'));
  }
  public function calidad_embarques(Request $request)
  {
    $alta_salida =  Models\calidadsalida::where('id', '=', $request->folio)->first();
    $alta_salida->tipo_salida = $request->tipo_liberacion;
    $alta_salida->tratamiento = $request->tratamiento;
    $alta_salida->cant_pieza = $request->cantidad;
    $alta_salida->estatus = "LIBERADA";
    $alta_salida->inspector = $request->inspeccion;
    $alta_salida->observaciones = $request->observaciones;
    $alta_salida->save();


    $date = Carbon::now();
    $date = $date->format('Y-m-d');


    //Produccion
    $liberacion_ot = Models\production::where('ot', '=', $request->numero_ot)->first();
    $liberacion_ot->estatus = "Liberacion por calidad";
    $liberacion_ot->user_liberacion = Auth::user()->name;
    $liberacion_ot->save();


    //ALTA DE REGISTRO
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $liberacion_ot->ot;
    $aeme_registro->area = 'CALIDAD';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();

    $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $liberacion_ot->ot)->first();
    $alta_proceso_ot->sistema_calidad = "DONE";
    $alta_proceso_ot->save();

    return back()->with('mensaje', '¡OT liberada!');
  }


  public function calidad_produccion($id)
  {
    $date = Carbon::now();
    $date = $date->format('Y-m-d');

    $buscador = Models\calidadsalida::where('id', '=', $id)->first();
    $buscador->estatus = 'R/PRODUCCION';
    $buscador->save();

    $liberacion_ot = Models\production::where('ot', '=', $buscador->ot)->first();
    $liberacion_ot->estatus = "P/FABRICACION";
    $liberacion_ot->user_liberacion = Auth::user()->name;
    $liberacion_ot->save();

    $dibujo = Models\aeme_ruta::where('ot', '=', $liberacion_ot->ot)->exists();
    if ($dibujo == True) {
      $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $liberacion_ot->ot)->first();
      $alta_proceso_ot->sistema_calidad = "-";
      $alta_proceso_ot->sistema_produccion = "-";
      $alta_proceso_ot->save();

      //ALTA DE REGISTRO
      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $liberacion_ot->ot;
      $aeme_registro->area = 'CALIDAD-PRODUCCION';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();
    }
    return back()->with('mensaje', '¡OT en produccion!');
  }
}
