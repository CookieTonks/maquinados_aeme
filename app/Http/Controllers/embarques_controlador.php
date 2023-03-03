<?php

namespace App\Http\Controllers;

use App\Models;
use Carbon\Carbon;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class embarques_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function home_embarques()
  {
    //Busqueda de ot enviadas por embarques
    $salidas = Models\calidadsalida::where('estatus', '=', 'LIBERADA')->get();


    return view('sistema_embarques.salidas_ot.options_embarques', compact('salidas'));
  }

  public function buscador_embarques()
  {
    //Busqueda de ot enviadas por embarques
    $salidas = Models\calidadsalida::where('estatus', '=', 'LIBERADA')->get();
    $clientes = Models\cliente::all()->sortBy('nombre');


    return view('sistema_embarques.salidas_ot.buscador_salidas', compact('salidas', 'clientes'));
  }

  public function factura_entrega_pdf(Request $request)
  {

    //Busqueda de datos
    $orden_trabajo = Models\datamain::where('orden_trabajo', '=', $request->numero_ot)->first();
    $fecha_salida = Carbon::now();

    //Actualizacion de salida
    $alta_salida = Models\calidadsalida::where('id', '=', $request->id)->first();
    $alta_salida->destino = $orden_trabajo->cliente;
    $alta_salida->fecha_salida = $fecha_salida;
    $alta_salida->cant_pieza = $orden_trabajo->cant_pieza;
    $alta_salida->remision = 'SC-' . $request->id;
    $alta_salida->chofer = $request->chofer;
    $alta_salida->observaciones = $request->observaciones;
    $alta_salida->estatus = "ENVIADA";
    $alta_salida->save();


    //Alta de registro en aeme
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $alta_salida->ot;
    $aeme_registro->area = 'EMBARQUES';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();

    //Actualizacion en la ruta aeme
    $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $alta_salida->ot)->first();
    $alta_proceso_ot->sistema_embarques = "DONE";
    $alta_proceso_ot->save();

    //Envio de piezas reflejado en produccion
    $orden_produccion = models\production::where('ot', '=', $alta_salida->ot)->first();
    $cantidad = $orden_produccion->cant_entregada;
    $orden_produccion->cant_entregada = $cantidad + $alta_salida->cant_pieza;
    $orden_produccion->save();

    //Visualizador de pdf
    $pdf = PDF::loadView('sistema_embarques.salidas_ot.factura_entrega_pdf', compact('orden_trabajo', 'alta_salida', 'fecha_salida'));
    return $pdf->stream();
  }

  public function entrega_remision_pdf(Request $request)
  {
    //Busqueda de datos
    $orden_trabajo = Models\datamain::where('orden_trabajo', '=', $request->numero_ot)->first();
    $cliente = Models\cliente::where('nombre', '=', $orden_trabajo->cliente)->first();
    $numero_remision = $cliente->ultima_remision + 1;
    $fecha_salida = Carbon::now();
    $datos_salida = $request;

    //Registro de la salida
    $alta_salida = Models\calidadsalida::where('id', '=', $request->id)->first();
    $alta_salida->descripcion = $orden_trabajo->descripcion;
    $alta_salida->ot = $orden_trabajo->orden_trabajo;
    $alta_salida->remision = $numero_remision;
    $alta_salida->destino = $orden_trabajo->cliente;
    $alta_salida->fecha_salida = $fecha_salida;
    $alta_salida->tipo_salida = $datos_salida->tipo_salida;
    $alta_salida->cant_pieza = $datos_salida->cant_pieza;
    $alta_salida->remision = $numero_remision;
    $alta_salida->chofer = $datos_salida->chofer;
    $alta_salida->observaciones = $datos_salida->observaciones;
    $alta_salida->estatus = "ENVIADA";
    $alta_salida->save();


    //Registro de aerea en rutas
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $alta_salida->ot;
    $aeme_registro->area = 'EMBARQUES';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();


    //Registro de cambios
    $cliente->ultima_remision = $numero_remision;
    $cliente->save();

    //Envio de piezas reflejado en produccion
    $orden_produccion = models\production::where('ot', '=', $alta_salida->ot)->first();
    $cantidad = $orden_produccion->cant_entregada;
    $orden_produccion->cant_entregada = $cantidad + $alta_salida->cant_pieza;
    $orden_produccion->save();

    //Visualizador de pdf
    $pdf = PDF::loadView('sistema_embarques.salidas_ot.remision_entrega_pdf', compact('numero_remision', 'alta_salida', 'orden_trabajo', 'fecha_salida', 'cliente', 'datos_salida'));
    return $pdf->stream();
  }

  public function salida_tratamiento_pdf(Request $request)
  {
    //Busqueda de datos
    $orden_trabajo = Models\datamain::where('orden_trabajo', '=', $request->numero_ot)->first();
    $cliente = Models\cliente::where('nombre', '=', $orden_trabajo->cliente)->first();
    $fecha_salida = Carbon::now();

    //Registro de la salida
    $alta_salida = Models\calidadsalida::where('id', '=', $request->id)->first();
    $alta_salida->destino = $request->proveedor;
    $alta_salida->fecha_salida = $fecha_salida;
    $alta_salida->cant_pieza = $request->cant_pieza;
    $alta_salida->chofer = $request->chofer;
    $alta_salida->observaciones = $request->observaciones;
    $alta_salida->estatus = "P/TRATAMIENTO";
    $alta_salida->save();

    //Alta de registro en aeme
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $alta_salida->ot;
    $aeme_registro->area = 'EMBARQUES';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();

    //Visualizador de pdf
    $pdf = PDF::loadView('sistema_embarques.salidas_ot.salida_tratamiento_pdf', compact('orden_trabajo', 'alta_salida', 'fecha_salida'));
    return $pdf->stream();
  }

  public function home_regreso_tratamiento()
  {
    //Trae salidas de tratamiento
    $salidas = Models\calidadsalida::where('estatus', '=', 'P/TRATAMIENTO')->get();
    return view('sistema_embarques.salidas_ot.home_regreso_tratamiento', compact('salidas'));
  }

  public function tratamiento_calidad(Request $request)
  {
    //Recepcion de tratamiento
    $salida_tratamiento = Models\calidadsalida::where('id', '=', $request->id)->first();
    $salida_tratamiento->estatus = 'R/TRATRAMIENTO';
    $salida_tratamiento->save();


    //Nuevo registro en calidad
    $salida_calidad = new Models\calidadsalida();
    $salida_calidad->ot = $salida_tratamiento->ot;
    $salida_calidad->descripcion = $salida_tratamiento->descripcion;
    $salida_calidad->cant_pieza = $request->cantidad;
    $salida_calidad->remision = '-';
    $salida_calidad->destino = '-';
    $salida_calidad->fecha_salida = '';
    $salida_calidad->tipo_salida = 'Retorno de tratamiento';
    $salida_calidad->produccion_salida = '-';
    $salida_calidad->chofer = '-';
    $salida_calidad->inspector = '-';
    $salida_calidad->estatus = 'PENDIENTE';
    $salida_calidad->observaciones = $request->observaciones;
    $salida_calidad->save();

    //Registro en aeme
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $salida_tratamiento->ot;
    $aeme_registro->area = 'EMBARQUES-CALIDAD';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();

    //Cambio de rutas
    $ruta_ot = models\aeme_ruta::where('ot', '=', $salida_tratamiento->ot)->first();
    $ruta_ot->sistema_calidad = '-';
    $ruta_ot->sistema_embarques = '-';
    $ruta_ot->save();

    return back()->with('mensaje', '¡orden de trabajo enviada a calidad!');
  }

  public function tratamiento_producccion(Request $request)
  {

    //Recepcion de tratamiento
    $salida_tratamiento = models\calidadsalida::where('id', '=', $request->id)->first();
    $salida_tratamiento->estatus = 'R/TRATAMIENTO';
    $salida_tratamiento->save();

    //Regreso a produccion
    $regreso_produccion = models\production::where('ot', '=', $salida_tratamiento->ot)->first();
    $regreso_produccion->estatus = 'P/FABRICACION';
    $regreso_produccion->save();

    //Registro en aeme
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $salida_tratamiento->ot;
    $aeme_registro->area = 'EMBARQUES-PRODUCCION';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();

    //Cambio de rutas
    $orden_trabajo = Models\aeme_ruta::where('ot', '=', $salida_tratamiento->ot)->first();
    $orden_trabajo->sistema_produccion = '-';
    $orden_trabajo->sistema_calidad = '-';
    $orden_trabajo->sistema_embarques = '-';
    $orden_trabajo->save();

    return back()->with('mensaje', '¡orden de trabajo enviada a produccion!');
  }


  public function home_remisiones_registro(Request $request)
  {

    $alta_primera = new Models\datamain;
    $alta_primera->save();
    $numero_orden_trabajo = $alta_primera->id;
    //Busqueda de datos

    $orden_trabajo = Models\datamain::where('id', '=', $alta_primera->id)->first();
    $orden_trabajo->cliente = $request->cliente;
    $orden_trabajo->orden_compra = $request->oc;
    $orden_trabajo->descripcion = $request->descripcion;
    $orden_trabajo->cant_pieza = $request->cant_pieza;
    $orden_trabajo->fecha_entrega = $request->fecha;
    $orden_trabajo->save();





    $cliente = Models\cliente::where('nombre', '=', $request->cliente)->first();
    $fecha_salida = Carbon::now();
    $datos_salida = $request;

    $numero_remision = $cliente->ultima_remision + 1;


    //Registro de la salida
    $alta_salida = new Models\calidadsalida();
    $alta_salida->descripcion = $orden_trabajo->descripcion;
    $alta_salida->ot = $orden_trabajo->id;
    $alta_salida->remision = $numero_remision;
    $alta_salida->destino = $orden_trabajo->cliente;
    $alta_salida->fecha_salida = $fecha_salida;
    $alta_salida->tipo_salida = $request->tipo_salida;
    $alta_salida->cant_pieza = $orden_trabajo->cant_pieza;
    $alta_salida->remision = $numero_remision;
    $alta_salida->chofer = $datos_salida->chofer;
    $alta_salida->observaciones = $datos_salida->observaciones;
    $alta_salida->estatus = "ENVIADA";
    $alta_salida->save();


    //Registro de aerea en rutas
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $alta_salida->ot;
    $aeme_registro->area = 'VENDEDOR';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();


    //Registro de cambios
    $cliente->ultima_remision = $numero_remision;
    $cliente->save();



    //Visualizador de pdf
    $pdf = PDF::loadView('sistema_embarques.salidas_ot.remision_entrega_pdf', compact('alta_salida', 'numero_remision', 'orden_trabajo', 'fecha_salida', 'cliente', 'datos_salida'));
    return $pdf->stream();
  }
}
