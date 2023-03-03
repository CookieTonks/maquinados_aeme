<?php

namespace App\Http\Controllers;

use App\Models;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Dibujos;

class ingenieria_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function Index_ingenieria()
  {
    $mostrar = Models\dibujo::where('estatus', '<>', 'COMPLETADO')->get();
    return view('sistema_ingenieria.home_ingenieria', compact('mostrar'));
  }

  public function buscador_ingenieria()
  {
    $mostrar = Models\dibujo::all();
    return view('sistema_ingenieria.buscador_ingenieria', compact('mostrar'));
  }

  public function ingenieria_responsable(Request $request)
  {
    $mostrar = Models\dibujo::where('ot', '=', $request->data_ot)->first();
    $mostrar->responsable = $request->data_responsable;
    $mostrar->estatus = "ASIGNADA";
    $mostrar->save();
    return back()->with('mensaje', '¡El dibujo fue asignado a: ' . $mostrar->responsable . ' con exito!');
  }

  public function ingenieria_estatus(Request $request)
  {
    $mostrar = Models\dibujo::where('ot', '=', $request->data_ot)->first();
    $mostrar->estatus = $request->data_estatus;
    $mostrar->save();
    return back()->with('mensaje', '¡El dibujo con OT: ' . $request->data_ot . 'se encuentra en proceso');
  }

  public function ingenieria_completado(Request $request)
  {
    Storage::disk('public')->putFileAs('Dibujo_OT/' . $request->data_ot, $request->file('dibujo_archivo'), $request->data_ot . '.pdf');

    $mostrar = Models\dibujo::where('ot', '=', $request->data_ot)->first();
    $mostrar->estatus = "COMPLETADO";
    $mostrar->save();


    $dibujo = Models\aeme_ruta::where('ot', '=', $request->data_ot)->exists();
    if ($dibujo == True) {
      //REGISTRO DE AVANCE EN RUTA
      $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $request->data_ot)->first();
      $alta_proceso_ot->sistema_ingenieria = "DONE";
      $alta_proceso_ot->save();


      //REGISTRAR OT EN REGISTRO
      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $request->data_ot;
      $aeme_registro->area = 'INGENIERIA';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();
    }

    return back()->with('mensaje', '¡El dibujo con OT: ' . $request->data_ot . ' ha sido cargado con éxito');
  }


  public function home_ingenieria_cambio(Request $request)
  {

    $path = 'public/Dibujo_OT/' . $request->data_ot . '/' . $request->data_ot . '.pdf';
    Storage::delete($path);
    Storage::disk('public')->putFileAs('Dibujo_OT/' . $request->data_ot, $request->file('dibujo_archivo'), $request->data_ot . '.pdf');


    //REGISTRAR OT EN REGISTRO
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $request->data_ot;
    $aeme_registro->area = 'INGENIERIA - DIBUJO';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();


    return back()->with('mensaje', '¡El dibujo con OT: ' . $request->data_ot . ' ha sido cargado con éxito!');
  }

  public function exportar_ingenieria()
  {
    return Excel::download(new Dibujos, 'Ingenieria.xlsx');
  }
}
