<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\User;
use PDF;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correo_ot_alta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ot_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $date = Carbon::now();
    $date = $date->format('ym');
    $date_ot = Carbon::now();
    $date_ot = $date_ot->format('Y-m-d');
    $numero_ot = Models\chart::where('id', '=', '1')->first();
    $altaot = $numero_ot->inicio + 1;
    $altaot = $date . '-' . $altaot;

    // $usuarios = Models\usuario::orderBy('usuario')->groupBy('cliente')->get();

    $usuarios = Models\usuario::all()->sortBy('cliente')->groupBy('cliente', 'desc');

    $mostrar = Models\datamain::where('created_at', '>=', Carbon::now()->subMonths(2))->get();
    $ultima = Models\datamain::max('orden_trabajo');
    $cliente = Models\cliente::all()->sortBy('nombre');
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_ot.home_sistema_ot', compact('usuarios', 'contador_notificaciones', 'notificaciones', 'date_ot', 'mostrar', 'ultima', 'cliente', 'altaot'));
  }

  public function home_buscador_sistema_ot()
  {
    $mostrar = Models\datamain::where('orden_trabajo', 'NOT LIKE', '%20')->get();
    return view('sistema_ot.buscador_sistema_ot', compact('mostrar'));
  }

  public function alta_ot(Request $request)
  {
       $numero_ot = Models\chart::where('id', '=', '1')->first();


     $alta_primera = new Models\datamain;
    

    $alta_primera->save();
        $numero_orden_trabajo = $alta_primera->id;


    //ALTA EN AEME GLOBAL
    $alta_proceso_ot = new Models\aeme_ruta;
    $alta_proceso_ot->ot = $numero_orden_trabajo;
    $alta_proceso_ot->sistema_ot = "DONE";
    $alta_proceso_ot->sistema_compras = "-";
    $alta_proceso_ot->sistema_ingenieria = "-";
    $alta_proceso_ot->sistema_produccion = "-";
    $alta_proceso_ot->sistema_calidad = "-";
    $alta_proceso_ot->sistema_embarques = "-";
    $alta_proceso_ot->sistema_facturacion = "-";
    $alta_proceso_ot->save();


  



    //ALTA PRODUCCION
    $alta_produccion = new Models\production;
    $alta_produccion->ot = $numero_orden_trabajo;
    $alta_produccion->descrip = $request->comentario;
    $alta_produccion->cant = $request->cantidad;
    $alta_produccion->cliente = $request->cliente;
    $alta_produccion->fecha_entrega = $request->f_entrega;
    $alta_produccion->estatus = 0;
    $alta_produccion->material = $request->material;
    $array_proceso = $request->proceso;
    $string_proceso = implode(",", $array_proceso);
    $final = "Recepcion de material," . $string_proceso . ",Inspeccion final,Embarque";
    $alta_produccion->proceso = $final;
    $alta_produccion->vendedor = $request->vendedor;
    $alta_produccion->tt = $request->tt;
    $alta_produccion->disponibilidad = "ACTIVA";
    $alta_produccion->area = $request->supervisor;
    $alta_produccion->save();
    
    
            $alta_evento = new models\Events();
        $alta_evento->title = "EC: " . $numero_orden_trabajo . "( $alta_produccion->cliente)";
        $alta_evento->start =  $alta_produccion->fecha_entrega;
        $alta_evento->end =  $alta_produccion->fecha_entrega;
        $alta_evento->save();


    //ALTA DE REGISTRO
    $date = Carbon::now();
    $aeme_registro = new Models\aeme_registro;
    $aeme_registro->ot = $numero_orden_trabajo;
    $aeme_registro->area = 'VENTAS';
    $aeme_registro->personal = Auth::user()->name;
    $aeme_registro->hora = $date;
    $aeme_registro->save();


    $alta = Models\datamain::where('id', '=', $alta_primera->id)->first();
    $alta->orden_trabajo = $alta->id;
    $alta->cliente = $request->cliente;

    $alta->fecha_inicio = $request->f_inicio;
    $alta->fecha_entrega = $request->f_entrega;
    $alta->cant_pieza = $request->cantidad;
    $alta->descripcion = $request->comentario;
    $alta->numero_serie = '-';
    if ($alta->cliente == "FORJA DE MONTERREY, S.A DE C.V") {
      switch ($alta->descripcion) {
        case "FABRICACIÓN DE MATRIZ DE 5A 1018":
          $registro_numero_serie =  $numero_ot->M1018;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->M1018 = $rango_serie;
          break;
        case "FABRICACIÓN DE MATRIZ de 5A 1034":
          $registro_numero_serie =  $numero_ot->M1034;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->M1034 = $rango_serie;
          break;
        case "FABRICACIÓN DE MATRIZ DE 5A 1048":
          $registro_numero_serie =  $numero_ot->M1048;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->M1048 = $rango_serie;
          break;
        case "FABRICACIÓN DE MATRIZ DE 5A 1049":
          $registro_numero_serie =  $numero_ot->M1049;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->M1049 = $rango_serie;
          break;
        case "FABRICACIÓN DE PUNZON DE 5A 1018":
          $registro_numero_serie =  $numero_ot->P1018;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->P1018 = $rango_serie;
          break;
        case "FABRICACIÓN DE PUNZON DE 5A 1034":
          $registro_numero_serie =  $numero_ot->P1034;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->P1034 = $rango_serie;
          break;
        case "FABRICACIÓN DE PUNZON DE 5A 1048":
          $registro_numero_serie =  $numero_ot->P1048;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->P1048 = $rango_serie;
          break;
        case "FABRICACIÓN DE PUNZON DE 5A 1049":
          $registro_numero_serie =  $numero_ot->P1049;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->P1049 = $rango_serie;
          break;

        case "FABRICACIÓN DE PUNZON DE 5A 1037":
          $registro_numero_serie =  $numero_ot->P1037;
          $rango_serie = $registro_numero_serie + $alta->cant_pieza;
          $rango_numero_serie = $registro_numero_serie . '-' . $rango_serie;
          $alta->numero_serie = $rango_numero_serie;
          $numero_ot->P1037 = $rango_serie;
          break;
      }
      $numero_ot->save();
    }
    $alta->orden_compra = $request->oc;
    $alta->moneda = $request->moneda;
    $alta->monto = $request->monto;
    $alta->fuente = $request->fuente;
    if ($request->fuente <> 'Dibujo del cliente') {
      $alta_ingenieria = new Models\dibujo;
      $alta_ingenieria->ot = $numero_orden_trabajo;
      $alta_ingenieria->numero_parte = $request->codigo_pieza;
      $alta_ingenieria->cliente = $request->cliente;
      $alta_ingenieria->vendedor = $request->vendedor;
      $alta_ingenieria->material = $request->tipo_material;
      $alta_ingenieria->cantidad = $request->cantidad;
      $alta_ingenieria->fecha_diseno = $request->fecha_diseno;
      $alta_ingenieria->estatus = "PENDIENTE";
      $alta_ingenieria->comentario_diseno = $request->comentario_diseno;
      $alta_ingenieria->save();
    } else {
      Storage::disk('public')->putFileAs('Dibujo_OT/' . $alta->orden_trabajo, $request->file('dibujo_archivo'), $alta->orden_trabajo . '.pdf');

      $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $numero_orden_trabajo)->first();
      $alta_proceso_ot->sistema_ingenieria = "DONE";
      $alta_proceso_ot->save();

      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $numero_orden_trabajo;
      $aeme_registro->area = 'VENTAS-DIBUJO';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();
    }
    $array_proceso = $request->proceso;
    $string_proceso = implode(",", $array_proceso);
    $final = "Recepcion de material," . $string_proceso . ",Inspeccion final,Embarque";
    $alta->proceso = $final;
    $alta->dibujo = $request->dibujo;
    $alta->fecha_diseno = $request->fecha_diseno;
    $alta->comentario_diseno = $request->comentario_diseno;
    $alta->codigo_pieza = $request->cod_pieza;
    $alta->usuario = $request->usuario;
    $alta->material = $request->material;
    if ($request->material == 'AEME') {
      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $alta_proceso_ot->ot;
      $aeme_registro->area = 'VENTAS-COMPRAS';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();

      $compras_ruta =  new Models\compras_ruta;
      $compras_ruta->ot = $numero_orden_trabajo;
      $compras_ruta->cliente = $request->cliente;
      $compras_ruta->compras_ot = "DONE";
      $compras_ruta->compras_requisicion = "-";
      $compras_ruta->compras_oc = "-";
      $compras_ruta->compras_entrada = "-";
      $compras_ruta->compras_salida = "-";
      $compras_ruta->save();

      $compras_registro = new Models\compras_registro;
      $compras_registro->ot = $numero_orden_trabajo;
      $compras_registro->area = "VENTAS";
      $compras_registro->personal = Auth::user()->name;
      $compras_registro->hora = $date;
      $compras_registro->save();
    } else {
      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $numero_orden_trabajo;
      $aeme_registro->area = 'VENTAS-CLIENTE';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();

      $alta_partida =  new Models\requisicion_partida;
      $alta_partida->cliente = $request->cliente;
      $alta_partida->partida = $numero_orden_trabajo;
      $alta_partida->material = '-';
      $alta_partida->unidad = '-';
      $alta_partida->precio_unitario = 0;
      $alta_partida->orden_compra = '-';
      $alta_partida->proveedor = $request->cliente;
      $alta_partida->ot = $numero_orden_trabajo;
      $alta_partida->tipo_requisicion = 'MATERIAL';
      $alta_partida->certificado_cargado = '0';
      $alta_partida->save();


      $compras_ruta =  new Models\compras_ruta;
      $compras_ruta->ot = $numero_orden_trabajo;
      $compras_ruta->cliente = $request->cliente;
      $compras_ruta->compras_ot = 'DONE';
      $compras_ruta->compras_requisicion = "DONE";
      $compras_ruta->compras_oc = "DONE";
      $compras_ruta->compras_entrada = "-";
      $compras_ruta->compras_salida = "-";
      $compras_ruta->save();


      $compras_registro = new Models\compras_registro;
      $compras_registro->ot = $numero_orden_trabajo;
      $compras_registro->area = "VENTAS-CLIENTE";
      $compras_registro->personal = Auth::user()->name;
      $compras_registro->hora = $date;
      $compras_registro->save();
    }

    $alta->tipo_material = $request->tipo_material;
    $alta->estatus = 0;
    $alta->disponibilidad = "ACTIVA";
    $alta->supervisor = $request->supervisor;

    $alta->tt = $request->tt;
    $alta->user =$request->vendedor;
    $alta->save();
    





    return back()->with('mensaje-success', '¡Nueva orden de trabajo: ' . $numero_orden_trabajo . ' registrada con éxito!');
  }



  public function info_ot($id)
  {
    $mostrar =  Models\datamain::findOrFail($id);
    return view('sistema_ot.info_ot', compact('mostrar'));
  }

  public function edit_ot($id)
  {
    $mostrar = Models\datamain::findOrFail($id);
    $cliente = Models\cliente::all()->sortBy('nombre');
    return view('sistema_ot.edit_ot', compact('mostrar', 'cliente'));
  }

  public function edit_ot_update(Request $request, $id)
  {

    $update = $request->ot;
    $update3 = Models\production::where('ot', '=', $update)->first();
    $update3->cliente = $request->cliente;
    $update3->fecha_entrega = $request->f_entrega;
    $update3->save();


    $infose = Models\datamain::findOrFail($id);
    $infose->orden_trabajo = $request->ot;
    $infose->cliente = $request->cliente;
    $infose->fecha_inicio = $request->f_inicio;
    $infose->fecha_entrega = $request->f_entrega;
    $infose->cant_pieza = $request->cantidad;
    $infose->orden_compra = $request->oc;
    $infose->fuente = $request->fuente;
    $infose->dibujo = $request->dibujo;
    $infose->codigo_pieza = $request->cod_pieza;
    $infose->usuario = $request->usuario;
    $infose->descripcion = $request->comentario;
    $infose->tipo_material = $request->tipo_material;
    $infose->tt = $request->tt;
    $infose->proceso = $request->proceso;
    $infose->save();

    if ($request->cambio_dibujo == 'SI') {
      $path = 'public/Dibujo_OT/' . $infose->orden_trabajo . '/' . $infose->orden_trabajo . '.pdf';
      Storage::delete($path);
      Storage::disk('public')->putFileAs('Dibujo_OT/' . $infose->orden_trabajo, $request->file('dibujo_archivo'), $infose->orden_trabajo . '.pdf');
    }

    return back()->with('mensaje-success', 'El registro ha sido modificado exitosamente!');
  }

  public function factura_remision($id)
  {
    $cliente = Models\cliente::all()->sortBy('nombre');
    $mostrar =  Models\datamain::findOrFail($id);
    return view('sistema_ot.home_facturaremision', compact('mostrar', 'cliente'));
  }

  public function home_remisiones()
  {
    $cliente = Models\cliente::all()->sortBy('nombre');
    $ultima = Models\datamain::max('orden_trabajo');
    $date = Carbon::now();
    $date = $date->format('ym');
    $numero_ot = Models\chart::where('id', '=', '1')->first();
    $altaot = $numero_ot->inicio + 1;
    $altaot = $date . '-' . $altaot;
    return view('sistema_ot.home_remisiones', compact('cliente', 'ultima', 'altaot'));
  }



  public function inbox($id)
  {
    $notificacion_vista = Models\notificacione::where('id', '=', $id)->first();
    $notificacion_vista->seen = "SI";
    $notificacion_vista->save();
    return view('inbox', compact('notificacion_vista'));
  }

  public function home_usuarios()
  {
    $cliente = Models\cliente::all()->sortBy('nombre');
    $usuarios = Models\usuario::all();
    return view('sistema_ot.home_usuarios', compact('cliente', 'usuarios'));
  }


  // REGISTRO DE ENTRADA A REGISTRO HOME
  public function home_usuarios_registro(Request $request)
  {
    $alta_usuario = new Models\usuario;
    $alta_usuario->cliente = $request->cliente;
    $alta_usuario->usuario = $request->usuario;
    $alta_usuario->save();
    return back()->with('mensaje-success', '¡El usuario se registro correctamente!');
  }

  public function editar_usuario($id)
  {
    $cliente = Models\cliente::all()->sortBy('nombre');
    $edicion_usuario = Models\usuario::where('id', '=', $id)->first();
    return view('sistema_ot.edit_usuario', compact('cliente', 'edicion_usuario'));
  }

  public function editar_usuario_registro(Request $request, $id)
  {
    $edicion_usuario_registro = Models\usuario::where('id', '=', $id)->first();
    $edicion_usuario_registro->cliente = $request->cliente;
    $edicion_usuario_registro->usuario = $request->usuario;
    $edicion_usuario_registro->save();
    return back()->with('mensaje-sucess', '¡El usuario se modifico correctamente!');
  }

  public function eliminar_usuario($id)
  {
    $eliminar_usuario = Models\usuario::where('id', '=', $id)->first();
    $eliminar_usuario->delete();
    return back()->with('mensaje-sucess', '¡El usuario se elimino correctamente!');
  }

  public function home_clientes()
  {
    $clientes = Models\cliente::all()->sortBy('nombre');
    return view('sistema_ot.home_clientes', compact('clientes'));
  }

  public function home_clientes_registro(Request $request)
  {
    $alta_cliente = new Models\cliente;
    $alta_cliente->nombre = $request->nombre;
    $alta_cliente->direccion = $request->direccion;
    $alta_cliente->save();

    return back()->with('mensaje-sucess', '¡El cliente ha sigo agregado con exito!');
  }


  public function home_rutas_ot($id)
  {
    $ot = Models\datamain::where('id', '=', $id)->first();
    $mostrar = Models\aeme_ruta::where('ot', '=', $ot->orden_trabajo)->get();
    $aeme_registro = Models\aeme_registro::where('ot', '=', $ot->orden_trabajo)->get();
    return view('sistema_ot.home_ruta_ot', compact('mostrar', 'aeme_registro'));
  }
}