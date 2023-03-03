<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\UsersExport;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Facturacion;
use Auth;

class facturacion_controlador extends Controller
{
  public $prueba_buena;
  //Auntentificacion general pora la pagina
  public function __construct()
  {
    $this->middleware('auth');
  }

  //Vista inicial de facturacion
  public function home_facturacion()
  {
    $ot = Models\production::where('estatus', '=', 'Liberacion por calidad')->get();

    // $ot =  DB::table('productions')
    //   ->join('datamains', 'productions.ot', '=', 'datamains.orden_trabajo')
    //   ->where('productions.ot', 'like', '21%')
    //   ->where('productions.estatus', '=', 'Liberacion por embarques')
    //   ->select('productions.*', 'datamains.*')
    //   ->get();

    //Carga de datos a  mostrar en la pagina
    $cliente = Models\cliente::all()->sortBy('nombre');
    $ultimas_facturas = Models\chart::where('id', '=', '1')->first();
    $ultima_factura =  $ultimas_facturas->C_FACTURA;
    $ultima_factura_soluciones = $ultimas_facturas->C_FAC_SOL;
    $ultima_factura_soluciones = $ultima_factura_soluciones + 1;
    $ultima_factura = $ultima_factura + 1;
    $usuarios = Models\usuario::all()->groupBy('cliente');
    $date = Carbon::now();
    $date_mes = $date->format('m');
    $date_year = $date->format('Y');
    switch ($date_mes) {
      case "01":
        $date_mes = 'ENERO';
        break;
      case "02":
        $date_mes = 'FEBRERO';
        break;
      case "03":
        $date_mes = 'MARZO';
        break;
      case "04":
        $date_mes = 'ABRIL';
        break;
      case "05":
        $date_mess = 'MAYO';
        break;
      case "06":
        $date_mes = 'JUNIO';
        break;
      case "07":
        $date_mes = 'JULIO';
        break;
      case "08":
        $date_mes = 'AGOSTO';
        break;
      case "09":
        $date_mes = 'SEPTIEMBRE';
        break;
      case "10":
        $date_mes = 'OCTUBRE';
        break;
      case "11":
        $date_mes = 'NOVIEMBRE';
        break;
      case "12":
        $date_mes = 'DICIEMBRE';
        break;
    }
    

     $facturas = Models\facturacione::where('fecha_mes', '=', $date_mes)->where('fecha_year', '=', $date_year)->get();


    //Suma de facturas en pesos y en dolares
    $dinero_mxn = 0;
    $dinero_usd = 0;
    foreach ($facturas as $item) {
      if ($item->moneda == 'MXN' && $item->estatus <> 'CANCELADA' && $item->estatus <> 'P/REFACTURA'  && $item->estatus <> 'REFACTURADA M/A') {
        $dinero_mxn = $dinero_mxn + $item->subtotal;
      }
      if ($item->moneda == 'USD' && $item->estatus <> 'CANCELADA' && $item->estatus <> 'P/REFACTURA'  && $item->estatus <> 'REFACTURADA M/A') {
        $dinero_usd = $dinero_usd + $item->subtotal;
      }
    }
    

    //Conversion de suma en formato numerico
    $facturacion_usd = '$' . number_format($dinero_usd, 2);
    $facturacion_mxn = '$' . number_format($dinero_mxn, 2);
    //Fecha actual para registro de facturas
    $date = Carbon::now();
    $date_fecha = $date->format('Y-m-d');
    //Mostrar notificaciones del usuario
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_facturacion.home_facturacion', compact('ultima_factura_soluciones', 'ot', 'ultima_factura', 'date_mes', 'usuarios', 'notificaciones', 'contador_notificaciones', 'date_fecha', 'facturas', 'cliente', 'facturacion_usd', 'facturacion_mxn'));
  }

  public function home_buscador_facturacion()
  {
    //Carga de datos a mostrar en la pagina
    $cliente = Models\cliente::all()->sortBy('nombre');
    $facturas = Models\facturacione::all();
    $date = Carbon::now();
    $date_fecha = $date->format('Y-m-d');
    //Mostrar notificaciones del usuario
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_facturacion.home_buscador_facturacion', compact('notificaciones', 'contador_notificaciones', 'date_fecha', 'facturas', 'cliente'));
  }

  //Vista inicial del buscador de facturacion
  public function home_facturacion_buscador()
  {
    //Carga de datos a mostrar en la pagina
    $cliente = Models\cliente::all()->sortBy('nombre');
    $facturas = Models\facturacione::all();
    $date = Carbon::now();
    $date_fecha = $date->format('Y-m-d');
    //Mostrar notificaciones del usuario
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_facturacion.home_facturacion_buscador', compact('notificaciones', 'contador_notificaciones', 'date_fecha', 'facturas', 'cliente'));
  }


  //Alta de registro de facturacion
  public function home_facturacion_registro(Request $request)
  {
    $ultima_factura_registrada = Models\chart::where('id', '=', '1')->first();
    //Verificacion si el folio existe
    $verificacion = Models\facturacione::where('folio', '=', $request->folio)->exists();
    if ($verificacion == True) {
      return back()->with('mensaje', 'El numero de folio ya esta en uso, verifica el numero de nuevo');
    } else {
      $date = Carbon::now();
      $date_mes = $date->format('m');
      $date_year = $date->format('Y');
      $alta_facturacion = new Models\facturacione;
      $alta_facturacion->cliente = $request->cliente;
      $alta_facturacion->empresa = $request->empresa;
      if ($request->empresa == "MAQUINADOS AEME") {
        $alta_facturacion->folio = $request->folio_aeme;
        $ultima_factura =  $ultima_factura_registrada->C_FACTURA;
        $ultima_factura = $ultima_factura + 1;
        $ultima_factura_registrada->C_FACTURA = $ultima_factura;
      } else {
        $alta_facturacion->folio = $request->folio_sol;
        $ultima_factura =  $ultima_factura_registrada->C_FAC_SOL;
        $ultima_factura = $ultima_factura + 1;
        $ultima_factura_registrada->C_FAC_SOL = $ultima_factura;
      }
      $alta_facturacion->estatus = $request->tipo_factura;
      $alta_facturacion->oc = $request->oc;
      $array_ot = implode(",", $request->ot);
      $alta_facturacion->ot = $array_ot;
      $alta_facturacion->fecha_registro = $request->fecha;
      switch ($date_mes) {
        case "01":
          $alta_facturacion->fecha_mes = 'ENERO';
          break;
        case "02":
          $alta_facturacion->fecha_mes = 'FEBRERO';
          break;
        case "03":
          $alta_facturacion->fecha_mes = 'MARZO';
          break;
        case "04":
          $alta_facturacion->fecha_mes = 'ABRIL';
          break;
        case "05":
          $alta_facturacion->fecha_mes = 'MAYO';
          break;
        case "06":
          $alta_facturacion->fecha_mes = 'JUNIO';
          break;
        case "07":
          $alta_facturacion->fecha_mes = 'JULIO';
          break;
        case "08":
          $alta_facturacion->fecha_mes = 'AGOSTO';
          break;
        case "09":
          $alta_facturacion->fecha_mes = 'SEPTIEMBRE';
          break;
        case "10":
          $alta_facturacion->fecha_mes = 'OCTUBRE';
          break;
        case "11":
          $alta_facturacion->fecha_mes = 'NOVIEMBRE';
          break;
        case "12":
          $alta_facturacion->fecha_mes = 'DICIEMBRE';
          break;
      }

      $alta_facturacion->fecha_year = $date_year;
      $alta_facturacion->descripcion = $request->descripcion;
      $alta_facturacion->subtotal = $request->subtotal;

      if ($request->iva == 'SI') {
        $proceso_iva = $request->subtotal * 0.16;
        $proceso_total = $request->subtotal + $proceso_iva;
        $alta_facturacion->iva = $proceso_iva;
        $alta_facturacion->total = $proceso_total;
      } else {
        $alta_facturacion->iva = "0";
        $alta_facturacion->total = $request->subtotal;
      }

      $alta_facturacion->moneda = $request->moneda;
      $alta_facturacion->fecha_entrada = $request->entrada;
      $alta_facturacion->fecha_vencimiento = $request->vence;
      $alta_facturacion->usuario = $request->usuario;
      $alta_facturacion->vendedor = $request->vendedor;
      $alta_facturacion->observaciones = $request->observaciones;

      $array_ot = explode(',', $alta_facturacion->ot);

      foreach ($array_ot as $ot) 
      {
        $factura_ot = Models\datamain::where('orden_trabajo', '=', $ot)->first();
        $factura_ot->factura_remision = $request->folio;
        $factura_ot->fecha_entrega_real = $request->fecha;
        $factura_ot->save();

      // $factura_produccion = Models\production::where('ot', '=', $ot)->first();
      //  $factura_produccion->estatus = "Liberacion por facturacion";
      //  $factura_produccion->save();

        $verificacion_ot = Models\aeme_ruta::where('ot', '=', $ot)->exists();
        if ($verificacion_ot == True) {
          //ALTA DE REGISTRO
          $date = Carbon::now();
          $aeme_registro = new Models\aeme_registro;
          $aeme_registro->ot = $ot;
          $aeme_registro->area = 'FACTURACION';
          $aeme_registro->personal = Auth::user()->name;
          $aeme_registro->hora = $date;
          $aeme_registro->save();

          $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $ot)->first();
          $alta_proceso_ot->sistema_facturacion = "DONE";
          $alta_proceso_ot->save();
        }
      }
      //Alta de los datos
      $ultima_factura_registrada->save();
      $alta_facturacion->save();
    }

    return back()->with('mensaje', '¡Factura registrada con exito!');
  }

  //Estado de factura pagada
  public function estatus_factura_pagada(Request $request)
  {
    $factura_pagada = Models\facturacione::where('folio', '=', $request->folio)->first();
    $factura_pagada->estatus = "PAGADA";
    $factura_pagada->fecha_pago = $request->fecha_pago;
    $factura_pagada->save();
    return back()->with('mensaje', '¡Factura registrada como pagada!');
  }

  //Estado de factura cancelada
  public function estatus_factura_cancelada(Request $request)
  {
    $factura_pagada = Models\facturacione::where('folio', '=', $request->cancelacion_factura)->first();
    $factura_pagada->estatus = "CANCELADA";
    $factura_pagada->save();

    return back()->with('mensaje', '¡Factura registrada como cancelada!');
  }

  //Modificacion de una facturacion
  public function edit_facturacion($id)
  {
    //Carga de datos a mostrar en la pagina de edicion
    $cliente = Models\cliente::all()->sortBy('nombre');
    $factura_edit = Models\facturacione::where('id', '=', $id)->first();

    //Mostrar notificaciones del usuario
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    return view('sistema_facturacion.edit_facturacion', compact('notificaciones', 'contador_notificaciones', 'cliente', 'factura_edit'));
  }

  //Carga de registro con la edicion de la factura
  public function edit_facturacion_registro(Request $request, $id)
  {
    $factura_edit_registro = Models\facturacione::where('id', '=', $id)->first();
    $factura_edit_registro->cliente = $request->cliente;
    $factura_edit_registro->folio = $request->folio;
    $factura_edit_registro->oc = $request->oc;
    $factura_edit_registro->fecha_registro = $request->fecha;
    $factura_edit_registro->descripcion = $request->descripcion;
    $factura_edit_registro->subtotal = $request->subtotal;
    $proceso_iva = $request->subtotal * 0.16;
    $proceso_total = $request->subtotal + $proceso_iva;
    $factura_edit_registro->iva = $proceso_iva;
    $factura_edit_registro->total = $proceso_total;
    $factura_edit_registro->moneda = $request->moneda;
    $factura_edit_registro->fecha_entrada = $request->entrada;
    $factura_edit_registro->fecha_vencimiento = $request->vence;
    $factura_edit_registro->usuario = $request->usuario;
    $factura_edit_registro->vendedor = $request->vendedor;
    $factura_edit_registro->observaciones = $request->observaciones;
    $factura_edit_registro->save();
    return back()->with('mensaje', '¡Cambios de factura registrada con exito!');
  }

  //Vista de pagina de refacturacion
  public function refacturacion($id)
  {
    //Carga de datos para mostrar en la pagina de refacturacion
    $cliente = Models\cliente::all()->sortBy('nombre');
    $facturas = Models\facturacione::where('estatus', '<>', 'CANCELADA')->where('estatus', '<>', 'PAGADA')->get();
    $factura_edit = Models\facturacione::where('id', '=', $id)->first();
    return view('sistema_facturacion.refacturacion', compact('facturas', 'cliente', 'factura_edit'));
  }

  //Carga de refacturacion
  public function refacturacion_registro($id, Request $request)
  {
    //Datos de refacturacion
    $verificacion = Models\facturacione::where('folio', '=', $request->folio_nuevo)->exists();
    if ($verificacion == True) {
      $factura_edit_registro = Models\facturacione::where('folio', '=', $request->folio_refacturar)->first();
      $factura_nueva = Models\facturacione::where('id', '=', $id)->first();

      if ($factura_edit_registro->fecha_mes == $factura_nueva->fecha_mes) {
        $factura_edit_registro->estatus = "CANCELADA";
        $factura_edit_registro->observaciones = "ESTA FACTURA QUEDA CANCELADA Y SUSTITUIDA POR LA FACTURA CON FOLIO: $request->folio_refacturar, POR EL SIGUIENTE MOTIVO:  $request->motivo.";
        $factura_edit_registro->save();

        $factura_nueva = Models\facturacione::where('id', '=', $id)->first();
        $factura_nueva->estatus = "REFACTURADA";
        $factura_nueva->save();
      } else {
        $factura_edit_registro->estatus = "CANCELADA";
        $factura_edit_registro->observaciones = "ESTA FACTURA QUEDA CANCELADA Y SUSTITUIDA POR LA FACTURA CON FOLIO: $request->folio_refacturar, POR EL SIGUIENTE MOTIVO:  $request->motivo.";
        $factura_edit_registro->save();

        $factura_nueva = Models\facturacione::where('id', '=', $id)->first();
        $factura_nueva->estatus = "REFACTURADA M/A";
        $factura_nueva->save();
      }
      return back()->with('mensaje', '¡Folio refacturada con exito!');
    } 
    else 
    {
      return back()->with('mensaje', '¡El folio a refacturar no existe!');
    }
  }

  //Vista inicial de reportes de facturacion
  public function home_reporte_facturacion()
  {


    //Mostrar notificaciones a ususarios
    $notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->get()->sortByDesc('id');
    $contador_notificaciones = Models\notificacione::where('usuario', '=', Auth::user()->email)->where('seen', '=', 'NO')->count();

    //Total a facturar al mes en pesos por clientes
    $facturacion_cliente_mxn = DB::table('facturaciones')
      ->select('cliente', DB::raw('SUM(subtotal) as total'))
      ->where('facturaciones.estatus', '<>', 'CANCELADA')
      ->where('facturaciones.estatus', '<>', 'REFACTURADA')
      ->where('facturaciones.moneda', '=', 'MXN')
      ->whereMonth('fecha_registro', '=', date('m'))
      ->orderBy('total', 'DESC')
      ->groupBy('cliente')
      ->get();

    //Total a facturar al mes en dolares por clientes
    $facturacion_cliente_usd = DB::table('facturaciones')
      ->select('cliente', DB::raw('SUM(subtotal) as total'))
      ->where('facturaciones.estatus', '<>', 'CANCELADA')
      ->where('facturaciones.estatus', '<>', 'REFACTURADA')
      ->where('facturaciones.moneda', '=', 'USD')
      ->whereMonth('fecha_registro', '=', date('m'))
      ->orderBy('total', 'DESC')
      ->groupBy('cliente')
      ->get();

    //Total a facturar al mes en pesos por vendedores
    $facturacion_vendedores_mxn = DB::table('facturaciones')
      ->select('vendedor', DB::raw('SUM(subtotal) as total'))
      ->where('facturaciones.estatus', '<>', 'CANCELADA')
      ->where('facturaciones.estatus', '<>', 'REFACTURADA')
      ->where('facturaciones.moneda', '=', 'MXN')
      ->whereMonth('fecha_registro', '=', date('m'))
      ->orderBy('total', 'DESC')
      ->groupBy('vendedor')
      ->get();

    //Total a facturar al mes en dolares por vendedores
    $facturacion_vendedores_usd = DB::table('facturaciones')
      ->select('vendedor', DB::raw('SUM(subtotal) as total'))
      ->where('facturaciones.estatus', '<>', 'CANCELADA')
      ->where('facturaciones.moneda', '=', 'USD')
      ->whereMonth('fecha_registro', '=', date('m'))
      ->orderBy('total', 'DESC')
      ->groupBy('vendedor')
      ->get();

    //Total de facturaciones y sus estados al mes en pesos
    $facturacion_estatus_mxn = DB::table('facturaciones')
      ->select('estatus', DB::raw('COUNT(*) as total'))
      ->where('facturaciones.moneda', '=', 'MXN')
      ->whereMonth('fecha_registro', '=', date('m'))
      ->orderBy('estatus', 'ASC')
      ->groupBy('estatus')
      ->get();

    //Total de facturaciones y sus estados al mes por dolares
    $facturacion_estatus_usd = DB::table('facturaciones')
      ->select('estatus', DB::raw('COUNT(*) as total'))
      ->where('facturaciones.moneda', '=', 'USD')
      ->whereMonth('fecha_registro', '=', date('m'))
      ->orderBy('estatus', 'ASC')
      ->groupBy('estatus')
      ->get();

    //Total de facturas
    $facturas = Models\facturacione::whereMonth('fecha_registro', '=', date('m'))->get();
    $dinero_total_mxn = 0;
    $dinero_pagado_mxn = 0;
    $dinero_total_usd = 0;
    $dinero_pagado_usd = 0;

    foreach ($facturas as $item) {
      if ($item->moneda == 'MXN' && $item->estatus <> 'CANCELADA') {
        $dinero_total_mxn = $dinero_total_mxn + $item->subtotal;
        if ($item->estatus == 'PAGADA') {
          $dinero_pagado_mxn = $dinero_pagado_mxn + $item->subtotal;
        }
      }
      if ($item->moneda == 'USD' && $item->estatus <> 'CANCELADA') {
        $dinero_total_usd = $dinero_total_usd + $item->subtotal;
        if ($item->estatus == 'PAGADA') {
          $dinero_pagado_usd = $dinero_pagado_usd + $item->subtotal;
        }
      }
    }

    $porcentaje_pagada_mxn = $dinero_pagado_mxn * 100;
    $porcentaje_pagada_mxn = $porcentaje_pagada_mxn / $dinero_total_mxn;
    $porcentaje_restante_mxn = 100 - $porcentaje_pagada_mxn;

    $porcentaje_pagada_usd = $dinero_pagado_usd * 100;
    $porcentaje_pagada_usd = $porcentaje_pagada_usd / $dinero_total_usd;
    $porcentaje_restante_usd = 100 - $porcentaje_pagada_usd;

    return view('sistema_facturacion.home_reporte_facturacion', compact('porcentaje_pagada_usd', 'porcentaje_restante_usd', 'porcentaje_pagada_mxn', 'porcentaje_restante_mxn', 'notificaciones', 'contador_notificaciones', 'facturacion_estatus_mxn', 'facturacion_estatus_usd', 'facturacion_cliente_mxn', 'facturacion_cliente_usd', 'facturacion_vendedores_mxn', 'facturacion_vendedores_usd'));
  }


  //Exportacion en formato excel de facturacion al mes
  public function exportar_facturacion()
  {
    return Excel::download(new Facturacion, 'Facturacion.xlsx');
  }

  public function exportacion_mes(Request $request)
  {
    return Excel::download(new UsersExport($request->mes, $request->year), 'facturaciones.xlsx');
  }

  public function actualizar_dolar(Request $request)
  {
    $dolar = Models\chart::where('id', '=', 1)->first();
    $dolar->dolar = $request->dolar;
    $dolar->save();
    return back()->with('mensaje', '¡Valor de dolar actualizado con exito!');
  }

  public function home_comisiones()
  {
    $dolar = Models\chart::where('id', '=', 1)->first();
    $precio_dolar = $dolar->dolar;
    $cliente = Models\cliente::all()->sortBy('nombre');
    $usuarios = Models\usuario::all()->groupBy('cliente')->sortBy('cliente');
    return view('sistema_facturacion.home_comisiones', compact('cliente', 'usuarios', 'precio_dolar'));
  }
  public function reporte_comisiones(Request $request)
  {
    $facturado_usd = 0;
    $facturado_mxn = 0;
    $comision_total = 0;
    $mes = $request->mes;
    $vendedor = $request->vendedor;
    $cliente = $request->cliente;
    $dolar = Models\chart::where('id', '=', 1)->first();
    $precio_dolar = $dolar->dolar;
    if ($request->vendedor <> '-' && $request->cliente <> '-') 
    {
      $facturaciones = Models\facturacione::where('vendedor', '=', $request->vendedor)
        ->where('cliente', '=', $request->cliente)
        ->where('comision', '=', 'PENDIENTE')
        ->where('fecha_mes', '=', $request->mes)
        ->where('estatus', '<>', 'CANCELADA')
        ->where('estatus', '<>', 'REFACTURADA M/A')
        ->get();
    } 
    elseif ($request->vendedor <> '-' && $request->cliente = '-') 
    {
      $facturaciones = Models\facturacione::where('vendedor', '=', $request->vendedor)
        ->where('comision', '=', 'PENDIENTE')
        ->where('fecha_mes', '=', $request->mes)
        ->where('estatus', '<>', 'CANCELADA')
        ->where('estatus', '<>', 'REFACTURADA M/A')
        ->get();
    } elseif ($request->vendedor = '-' && $request->cliente <> '-') {
      $facturaciones = Models\facturacione::where('cliente', '=', $request->cliente)
        ->where('comision', '=', 'PENDIENTE')
        ->where('fecha_mes', '=', $request->mes)
        ->where('estatus', '<>', 'CANCELADA')
        ->where('estatus', '<>', 'REFACTURADA M/A')
        ->get();
    } elseif ($request->vendedor = '-' && $request->cliente = '-') {
      $facturaciones = Models\facturacione::where('fecha_mes', '=', $request->mes)
        ->where('comision', '=', 'PENDIENTE')
        ->where('estatus', '<>', 'CANCELADA')
        ->where('estatus', '<>', 'REFACTURADA M/A')
        ->get();
    } else {
      return back()->with('mensaje', '¡Selecciona filtro!');
    }

    foreach ($facturaciones as $facturacion) {
      if ($facturacion->moneda == 'USD') {
        $facturado_usd = $facturado_usd + $facturacion->subtotal;
      } elseif ($facturacion->moneda == 'MXN') {
        $facturado_mxn = $facturado_mxn + $facturacion->subtotal;
      }
    }
    $comision_usd_pesos = $facturado_usd * $precio_dolar;
    $facturado_total = $comision_usd_pesos + $facturado_mxn;
    $comision_total = $facturado_total * 0.01;
    $facturaciones_comision = 100;
    return view('sistema_facturacion.home_comisiones_reporte', compact('mes', 'facturaciones', 'facturado_usd', 'facturado_mxn', 'facturado_total', 'comision_total', 'vendedor', 'cliente'));
  }
  public function comprobante_pago_facturacion(Request $request)
  {
    $facturado_usd = 0;
    $facturado_mxn = 0;
    $comision_total = 0;
    $dolar = Models\chart::where('id', '=', 1)->first();
    $precio_dolar = $dolar->dolar;
    $vendedor = $request->vendedor;
    $mes = $request->mes;
    $fecha = Carbon::now();

    $facturaciones = Models\facturacione::where('vendedor', '=', $request->vendedor)->where('comision', '=', 'PENDIENTE')->where('fecha_mes', '=', $request->mes)->where('estatus', '<>', 'CANCELADA')->where('estatus', '<>', 'REFACTURADA M/A')->get();

    foreach ($facturaciones as $facturacion) {
      if ($facturacion->moneda == 'USD') {
        $facturado_usd = $facturado_usd + $facturacion->subtotal;
      } elseif ($facturacion->moneda == 'MXN') {
        $facturado_mxn = $facturado_mxn + $facturacion->subtotal;
      }
      $facturacion->comision = "PAGADA";
      $facturacion->save();
    }
    $comision_usd_pesos = $facturado_usd * $precio_dolar;
    $facturado_total = $comision_usd_pesos + $facturado_mxn;
    $comision_total = $facturado_total * 0.01;
    $pdf = PDF::loadView('sistema_facturacion.facturacion_pdf', compact('mes', 'fecha', 'facturaciones', 'facturado_usd', 'facturado_mxn', 'facturado_total', 'comision_total', 'vendedor'));
    return $pdf->stream();
  }
}
