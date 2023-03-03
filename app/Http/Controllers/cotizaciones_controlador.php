<?php

namespace App\Http\Controllers;

use App\Models;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class cotizaciones_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function home_cotizaciones()
  {
    $cliente = Models\cliente::all()->sortBy('nombre');
    $ultima_cotizacion = Models\chart::where('id', '=', '1')->first();
    $dato = Models\cliente::all()->sortBy('nombre')->first();
       $usuarios = Models\usuario::all()->sortBy('cliente')->groupBy('cliente', 'desc');

    $cotizaciones = Models\cotizacione::where('usuario_alta', '=', Auth::user()->name)->where('estatus', '<>', 'COTIZADA')->get();
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();
    return view('sistema_cotizaciones.home_cotizaciones', compact('notificaciones', 'contador_notificaciones', 'ultima_cotizacion', 'usuarios', 'cliente', 'dato', 'cotizaciones'));
  }
  public function buscador_cotizaciones()
  {
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $cotizaciones = Models\cotizacione::where('usuario_alta', '=', Auth::user()->name)->get();
    return view('sistema_cotizaciones.buscador_cotizaciones', compact('cotizaciones', 'notificaciones', 'contador_notificaciones'));
  }

  public function buscador_cotizaciones_liberacion($id)
  {
    $cotizacion = Models\cotizacione::where('id', '=', $id)->first();
    $cotizacion->estatus = "PENDIENTE";
    $cotizacion->save();
    return back()->with('mensaje', '¡La cotizacion: ' . $cotizacion->numero_cotizacion . ' ha sido liberada con exito!');
  }

  public function home_cotizaciones_registro(Request $request)
  {
    $alta_cotizacion = new Models\cotizacione;
    $alta_cotizacion->empresa = $request->empresa;
    $alta_cotizacion->cliente = $request->cliente;
    $alta_cotizacion->usuario = $request->usuario;
    $alta_cotizacion->condiciones = $request->condiciones;
    $alta_cotizacion->entrega = $request->entrega;
    $alta_cotizacion->estatus_iva = $request->estatus_iva;
    $alta_cotizacion->moneda = $request->moneda;
    $alta_cotizacion->observaciones = $request->observaciones;
    $alta_cotizacion->usuario_alta = Auth::user()->name;
    $alta_cotizacion->save();

    $modificacion_cotizacion = Models\cotizacione::where('id', '=', $alta_cotizacion->id)->first();
    $modificacion_cotizacion->numero_cotizacion = 'C-' . $alta_cotizacion->id;
    $modificacion_cotizacion->save();

    return back()->with('mensaje', '¡Alta de Cotizacion exitosa!');
  }

  public function home_cotizaciones_partidas($id)
  {
    $cotizacion = Models\cotizacione::where('id', '=', $id)->first();
    $cotizacion_partida = Models\cotizaciones_partida::where('numero_cotizacion', '=', $cotizacion->numero_cotizacion)->get();
    $contador = $cotizacion_partida->count();
    $nuevo_contador = $contador + 1;
    $nueva_cotizacion_partida = $cotizacion->numero_cotizacion . '/' . $nuevo_contador;
    return view('sistema_cotizaciones.home_cotizaciones_partidas', compact('cotizacion', 'cotizacion_partida', 'nueva_cotizacion_partida'));
  }

  public function home_cotizaciones_partidas_registro(Request $request, $id)
  {
    $alta_partida_cotizacion = new Models\cotizaciones_partida;
    $alta_partida_cotizacion->numero_cotizacion = $request->numero_cotizacion;
    $alta_partida_cotizacion->numero_cotizacion_partida   = $request->partida_cotizacion;
    $alta_partida_cotizacion->descripcion = $request->descripcion;
    $alta_partida_cotizacion->cantidad = $request->cantidad;
    $alta_partida_cotizacion->precio_unitario = $request->precio_unitario;
    if ($alta_partida_cotizacion->precio_unitario == 0) {
      $alta_partida_cotizacion->precio_asignado = 0;
    } else {
      $alta_partida_cotizacion->precio_asignado = 1;
    }
    $alta_partida_cotizacion->partida_total = $request->cantidad * $request->precio_unitario;
    $alta_partida_cotizacion->numero_parte = $request->numero_parte;
    $alta_partida_cotizacion->revision = $request->revision;
    $alta_partida_cotizacion->tipo_acero = $request->tipo_acero;
    $alta_partida_cotizacion->vigencia = $request->vigencia;
    $alta_partida_cotizacion->save();
    if ($request->file('comprobante')) {
      Storage::disk('public')->putFileAs('Cotizaciones/' . $request->numero_cotizacion, $request->file('comprobante'), $alta_partida_cotizacion->id . '.pdf');
    } else {
    }
    return back()->with('mensaje', '¡Partida agregada a la cotizacion!');
  }

  public function partida_precio_unitario(Request $request)
  {
    $partida_precio_cotizacion = Models\cotizaciones_partida::where('numero_cotizacion_partida', '=', $request->numero_partida)->first();
    $partida_precio_cotizacion->precio_unitario = $request->precio_unitario;
    $partida_precio_cotizacion->precio_asignado = 1;
    $partida_precio_cotizacion->vigencia = $request->vigencia;
    $partida_precio_cotizacion->partida_total = $partida_precio_cotizacion->cantidad * $partida_precio_cotizacion->precio_unitario;
    $partida_precio_cotizacion->save();

    $contador_partidas = Models\cotizaciones_partida::where('numero_cotizacion', '=', $request->numero_cotizacion)->count();
    $suma_partidas = Models\cotizaciones_partida::where('numero_cotizacion', '=', $request->numero_cotizacion)->sum('precio_asignado');
    if ($contador_partidas == $suma_partidas) {
      $alerta_cotizacion =  Models\cotizacione::where('numero_cotizacion', '=', $request->numero_cotizacion)->first();
      $alerta_cotizacion->estatus = 'ASIGNADA';
      $alerta_cotizacion->save();
    }

    return back()->with('mensaje', '¡Cambios realizados con exito!');
  }

  public function edicion_partida_cotizacion(Request $request)
  {
    $partida_edicion_cotizacion = Models\cotizaciones_partida::where('numero_cotizacion_partida', '=', $request->numero_partida)->first();
    $partida_edicion_cotizacion->descripcion = $request->descripcion;
    $partida_edicion_cotizacion->cantidad = $request->cantidad;
    $partida_edicion_cotizacion->precio_unitario = $request->precio_unitario;
    $partida_edicion_cotizacion->partida_total = $request->cantidad * $request->precio_unitario;
    $partida_edicion_cotizacion->save();

    return back()->with('mensaje', '¡Cambios realizados con exito!');
  }

  public function edicion_cotizacion($id)
  {
    $cliente = Models\cliente::all()->sortBy('nombre');
    $usuarios = Models\usuario::all()->groupBy('cliente');
    $cotizacion = Models\cotizacione::where('id', '=', $id)->first();
    return view('sistema_cotizaciones.edicion_cotizacion', compact('cotizacion', 'cliente', 'usuarios'));
  }

  public function edicion_cotizacion_registro(Request $request)
  {

    $cotizacion = Models\cotizacione::where('numero_cotizacion', '=', $request->numero_cotizacion)->first();
    $cotizacion->empresa = $request->empresa;
    $cotizacion->cliente = $request->cliente;
    $cotizacion->usuario = $request->usuario;
    $cotizacion->condiciones = $request->condiciones;
    $cotizacion->entrega = $request->entrega;
    $cotizacion->moneda = $request->moneda;
    $cotizacion->estatus = $request->estatus;
    $cotizacion->estatus_iva = $request->estatus_iva;
    $cotizacion->observaciones = $request->observaciones;
    $cotizacion->save();

    return back()->with('mensaje', '¡Cambios realizados con exito!');
  }

  public function delete_partida_cotizacion(Request $request)
  {
    $partida_edicion_cotizacion = Models\cotizaciones_partida::where('numero_cotizacion_partida', '=', $request->numero_partida)->delete();
    return back()->with('mensaje', 'Partida eliminada de la !');
  }
}
