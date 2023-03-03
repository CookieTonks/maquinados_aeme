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
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Produccion;

use App\Models;
use \Illuminate\Filesystem\FilesystemManager;

class produccion_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    // NOTE: Carga de produccion con dibujo y compra
    $mostrar = DB::table('productions')
      ->join('aeme_rutas', 'productions.ot', '=', 'aeme_rutas.ot')
      ->where('aeme_rutas.sistema_ot', '=', 'DONE')
      ->where('aeme_rutas.sistema_ingenieria', '=', 'DONE')
      ->where('aeme_rutas.sistema_compras', '=', 'DONE')
      ->where('aeme_rutas.sistema_produccion', '<>', 'DONE')
      ->get();

    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_produccion.home_produccion', compact('notificaciones', 'contador_notificaciones', 'mostrar'));
  }

  public function home_produccion_programacion()
  {

    $mostrar = Models\production::where('estatus', '=', 'P/FABRICACION')->get();
    $fecha_hoy = Carbon::now();
    $fecha_hoy = $fecha_hoy->format('Y-m-d');

    foreach ($mostrar as $ot) {
      $origin = new DateTime($fecha_hoy);
      $target = new DateTime($ot->fecha_entrega);
      $interval = $origin->diff($target);
      $dias = $interval->format('%r%a');
      $ot->dias = $dias;
      $ot->save();
    }

    $fecha_reporte = $fecha_hoy;
    $traer_fecha = Models\chart::where('id', '=', '1')->first();
    $fecha_notificaciones = $traer_fecha->fecha_produccion;

    if ($fecha_notificaciones < $fecha_reporte) {
      $datos = Models\production::where('dias', '<=', 5)->where('estatus', '=', 'P/FABRICACION')->get();
      Mail::to('msanmiguel@cncaeme.com')->send(new liberacion($datos));
      $traer_fecha->fecha_produccion = $fecha_hoy;
      $traer_fecha->save();
    }

    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_produccion.home_produccion_programacion', compact('notificaciones', 'mostrar', 'contador_notificaciones'));
  }

  public function produccion_entrada_piso(Request $request)
  {
    $busqueda_ot = Models\production::where('ot', '=', $request->orden_trabajo)->exists();
    $usuario_entrega = Models\user::where('id', '=',  Auth::user()->id)->first();
    $conversion_usuario = $usuario_entrega->name;
    $conversion_usuario = strtoupper($conversion_usuario);
    if ($busqueda_ot == "true") {
      $registro_aeme = new models\aeme_registro;
      $registro_aeme->ot = $request->orden_trabajo;
      $registro_aeme->area = "ENTRADA A PRODUCCION";
      $registro_aeme->personal = $conversion_usuario . '-' . $request->usuario_recibe;
      $registro_aeme->save();

      $carga_produccion = Models\production::where('ot', '=', $request->orden_trabajo)->first();
      $carga_produccion->estatus = "P/FABRICACION";
      $carga_produccion->encargado = $request->usuario_recibe;
      $carga_produccion->save();
      return back()->with('mensaje-success', '¡Orden de trabajo entregada a produccion!');
    } else {
      return back()->with('mensaje-error', '¡Verifica la información y vuelve a intentarlo!');
    }
  }




  public function produccion_salida_piso(Request $request)
  {

    $date = Carbon::now();
    $busqueda_ot = Models\production::where('ot', '=', $request->orden_trabajo)->where('estatus', '=', 'P/FABRICACION')->exists();

    $usuario_produccion = Models\user::where('id', '=', $request->usuario)->first();
    if ($busqueda_ot == "true") {
      $registro_aeme = new models\aeme_registro;
      $registro_aeme->ot = $request->orden_trabajo;
      $registro_aeme->area = "SALIDA DE PRODUCCION";
      $registro_aeme->hora = $date;
      $registro_aeme->personal = $usuario_produccion->name . '-' . $request->usuario_recibe;
      $registro_aeme->save();


      $carga_datamain = Models\datamain::where('orden_trabajo', '=', $request->orden_trabajo)->first();
      $alta_salida = new Models\calidadsalida;
      $alta_salida->ot = $carga_datamain->orden_trabajo;
      $alta_salida->destino = "-";
      $alta_salida->fecha_salida = "-";
      $alta_salida->descripcion = $carga_datamain->descripcion;
      $alta_salida->tipo_salida = '-';
      $alta_salida->produccion_salida = 'FINAL';
      $alta_salida->tratamiento =  '-';
      $alta_salida->cant_pieza = $request->cantidad;
      $alta_salida->chofer = "-";
      $alta_salida->inspector = "-";
      $alta_salida->estatus = "PENDIENTE";
      $alta_salida->observaciones = '-';
      $alta_salida->save();

      $busqueda_ot = Models\aeme_ruta::where('ot', '=', $request->orden_trabajo)->first();
      $busqueda_ot->sistema_produccion = "DONE";
      $busqueda_ot->sistema_calidad = "-";
      $busqueda_ot->sistema_embarques = "-";
      $busqueda_ot->save();


      $carga_produccion = Models\production::where('ot', '=', $request->orden_trabajo)->first();
      $carga_produccion->estatus = "FABRICADA";
      $carga_produccion->save();


      return back()->with('mensaje-success', '¡Salida de orden de trabajo registrada!');
    } else {
      return back()->with('mensaje-error', '¡Verifica la información y vuelve a intentarlo!');
    }
  }

  public function produccion_salida_parcial(Request $request)
  {


    $date = Carbon::now();

    $busqueda_ot = Models\production::where('ot', '=', $request->orden_trabajo)->where('estatus', '=', 'P/FABRICACION')->exists();

    $usuario_produccion = Models\user::where('id', '=', $request->usuario)->first();

    if ($busqueda_ot == "true") {


      //Registros aeme
      $registro_aeme = new models\aeme_registro;
      $registro_aeme->ot = $request->orden_trabajo;
      $registro_aeme->area = "SALIDA DE PRODUCCION PARCIAL: {{$request->cantidad}}";
      $registro_aeme->hora = $date;
      $registro_aeme->personal = $usuario_produccion->name . '-' . $request->usuario_recibe;
      $registro_aeme->save();



      //Alta salida para calidad.
      $carga_datamain = Models\datamain::where('orden_trabajo', '=', $request->orden_trabajo)->first();
      $alta_salida = new Models\calidadsalida;
      $alta_salida->ot = $carga_datamain->orden_trabajo;
      $alta_salida->destino = "-";
      $alta_salida->fecha_salida = "-";
      $alta_salida->descripcion = $carga_datamain->descripcion;
      $alta_salida->tipo_salida = '-';
      $alta_salida->produccion_salida = 'PARCIAL';
      $alta_salida->tratamiento =  '-';
      $alta_salida->cant_pieza = $request->cantidad;
      $alta_salida->chofer = "-";
      $alta_salida->inspector = "-";
      $alta_salida->estatus = "PENDIENTE";
      $alta_salida->observaciones = '-';
      $alta_salida->save();

      return back()->with('mensaje', '¡Salida de orden de trabajo registrada!');
    } else {
      return back()->with('mensaje', '¡Verifica la información y vuelve a intentarlo!');
    }
  }

  public function produccion_liberacion()
  {
    return view('sistema_produccion.home_produccion_modulo');
  }

  public function liberacion_ot($id)
  {


    $date = Carbon::now();
    $date = $date->format('Y-m-d');

    $liberacion_ot = Models\production::where('id', '=', $id)->first();
    $liberacion_ot->estatus = "Liberado por produccion";
    $liberacion_ot->user_liberacion = Auth::user()->name;
    $liberacion_ot->save();


    $liberacion_sistema_ot = Models\datamain::where('orden_trabajo', '=', $liberacion_ot->ot)->first();
    $liberacion_sistema_ot->estatus = "Liberado por produccion";
    $liberacion_sistema_ot->fecha_entrega_real = $date;
    $liberacion_sistema_ot->save();


    $var1 = Models\aeme_ruta::where('ot', '=', $liberacion_ot->ot)->exists();
    if ($var1 == True) {
      $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $liberacion_ot->ot)->first();
      $alta_proceso_ot->sistema_produccion = "DONE";
      $alta_proceso_ot->save();

      //ALTA DE REGISTRO
      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $liberacion_ot->ot;
      $aeme_registro->area = 'PRODUCCION';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();
    }

    return back()->with('mensaje', '¡La OT ha sido liberado con exito!');
  }

  public function entrada_material_cliente($id)
  {
    $liberacion_ot = Models\production::where('id', '=', $id)->first();
    $liberacion_ot->entrada_material = "RECIBIDA";
    $liberacion_ot->save();
    return back()->with('mensaje', '¡Entrada de material registrada con exito!');
  }

  public function edit_produccion($id)
  {
    $mostrar =  Models\production::findOrFail($id);
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();
    return view('sistema_produccion.edit_produccion', compact('mostrar', 'notificaciones', 'contador_notificaciones'));
  }

  public function update_produccion($id, Request $request)
  {
    //update para la tabla produccion y envio de correos
    $update = Models\production::where('id', '=', $id)->first();
    $datetime1 = new \DateTime();
    $datetime2 = $update->updated_at;
    $interval = date_diff($datetime1, $datetime2);
    $update->proceso = $request->proceso;
    $update->area = $request->area;
    $update->comentario = $request->comentario;
    $update->estatus = $request->estatus;
    $update->dias = $interval->d;
    $update->save();

    return back()->with('mensaje', 'El registro ha sido modificado exitosamente!');
  }

  public function ver_produccion_ot($id)
  {
    $mostrar = DB::table('productions')
      ->join('datamains', 'productions.ot', '=', 'datamains.orden_trabajo')
      ->where('productions.id', '=', $id)
      ->select('datamains.*')
      ->get();
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();
    return view('sistema_produccion.ver_produccion', compact('notificaciones', 'contador_notificaciones', 'mostrar'));
  }



   public function exportar_produccion(Request $request)
  {
    $p = $request->programador;
    return Excel::download(new Produccion($request->programador), 'PISO('.$p.').xlsx');
  }
}
