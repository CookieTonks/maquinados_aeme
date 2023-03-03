<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\notificacion_material;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ocompras;
use DateTime;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\cotizaciones_requisicion;
use App\Notifications\OrderProcessed;
use App\Models\CotizacionFactory;
use App\Models\datamain;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Exports\Material;
use App\Exports\Salida;



class compras_controlador extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $ultima = Models\ocompra::max('id');
    $mostrar = Models\ocompra::where('Codigo', 'LIKE', '%A-7%')->get();
    $fecha = Models\chart::where('id', '=', '1')->first();
    $fecha = $fecha->fecha_oc;
    return view('sistema_oc.ordenes_compras.home_ordenes_compras',  compact('mostrar', 'ultima', 'fecha'));
  }

  public function dashboard_compras()
  {
    return view('sistema_oc.dashboard_compras');
  }

  public function alta_ocompra(Request $request)
  {

    $alta_primera = new Models\ocompra;
    $alta_primera->save();
    $alta = Models\ocompra::where('id', '=', $alta_primera->id)->first();
    $alta->Entrega = $request->Entrega;
    $alta->Codigo = 'A-' . $alta_primera->id;
    $alta->Condiciones_de_pago = $request->Condiciones_de_pago;
    $alta->Moneda = $request->moneda;
    $cliente_array = implode("  ", $request->Cliente);
    $alta->Cliente = $cliente_array;
    $alta->OC_cliente = $request->OC_cliente;
    $alta->Observaciones = $request->Observaciones;
    $alta->save();

    return back()->with('mensaje', '¡Orden de compra generada con exito!');
  }

  public function ver_ocompra($id)
  {
    $mostrar = Models\ocompra::findOrFail($id);
    return view('sistema_oc.ordenes_compras.ver_ocompra',  compact('mostrar'));
  }

  public function edit_ocompra($id, Request $request)
  {
    $update =  Models\ocompra::findOrFail($id);
    $update->Entrega = $request->Entrega;
    $update->Condiciones_de_pago = $request->Condiciones_de_pago;
    $update->Moneda = $request->Moneda;
    $update->Cliente = $request->Cliente;
    $update->OC_cliente = $request->OC_cliente;
    $update->Observaciones = $request->Observaciones;
    $update->save();
    return back()->with('mensaje', '¡Cambios de la orden de compra actualizados!');
  }

  public function liberacion_oc($id)
  {
    $mostrar = Models\ocompra::findOrFail($id);
    $mostrar->Disponibilidad = 'ACTIVO';
    $mostrar->save();
    return back()->with('mensaje', '¡Orden de compra liberada!');
  }

  public function pdf_orden_compra($id)
  {
    $mostrar = Models\ocompra::findOrFail($id);
    return view('sistema_oc.ordenes_compras.pdf_orden_compra',  compact('mostrar'));
  }

  public function alta_pdf_orden_compra(Request $request)
  {
    Storage::disk('public')->putFileAs('Ordenes_de_compras', $request->file('comprobante'), $request->orden_compra . '.pdf');
    return back()->with('mensaje', '¡Orden de compra realizada con exito!');
  }

  public function baja_ocompra(Request $request)
  {
  }

  public function home_pago_compras()
  {
    $orden_compra = Models\ocompra::where('alta_pago', '=', 'PENDIENTE')->get();
    return view('sistema_oc.pagos_ordenes_compra.home_pago_ocompras',  compact('orden_compra'));
  }

  public function alta_pago_compras(Request $request)
  {
    Storage::disk('public')->putFileAs('Comprobante_pago', $request->file('comprobante'), $request->orden_compra . '.pdf');
    $mostrarp = Models\ocompra::where('Codigo', '=', $request->orden_compra)->first();
    $mostrarp->alta_pago = 'PAGADA';
    $mostrarp->dias = "N/A";
    $mostrarp->save();
    return back()->with('mensaje', '¡Comprobante de pago cargado!');
  }

  public function exportar_compras()
  {
    return Excel::download(new ocompras, 'Ordenes de compras.xlsx');
  }

  public function actualizacion_fecha_compras()
  {
    $fecha = Carbon::now();
    $fecha = $fecha->format('Y-m-d');
    $ordenes = Models\ocompra::all();
    foreach ($ordenes as $ordenes) {
      $origin = new DateTime($fecha);
      $target = new DateTime($ordenes->fecha_almacen);
      $interval = $origin->diff($target);
      $dias = $interval->format('%a');
      $ordenes->dias = $dias;
      $ordenes->save();
    }
    $fecha_registro = Models\chart::where('id', '=', '1')->first();
    $fecha_registro->fecha_oc = $fecha;
    $fecha_registro->save();
    return back();
  }

  public function home_proveedores()
  {
    $mostrar = Models\proveedore::all();
    return view('sistema_oc.proveedores.home_proveedores',  compact('mostrar'));
  }

  public function alta_proveedores(Request $request)
  {
    $ere = Models\proveedore::where('Rsocial', $request->Rsocial)->exists();
    if ($ere == True) {
      return back()->with('mensaje', 'PROVEEDOR EXISTENTE');
    } else {
      $alta = new Models\proveedore;
      $alta->RFC = $request->RFC;
      $alta->Direccion = $request->Direccion;
      $alta->Telefono = $request->Telefono;
      $alta->Correo = $request->Correo;
      $alta->Rsocial = $request->Rsocial;
      $alta->Vendedor = $request->Vendedor;
      $alta->tipo_proveedor = $request->tipo_proveedor;
      $alta->nacional_internacional = $request->nacional_internacional;
      $alta->familia = $request->familia;
      $alta->save();
      return back()->with('mensaje', '¡Proveedor agregado con exito!');
    }
  }

  public function edit_proveedores($id)
  {
    $mostrar = Models\proveedore::findOrFail($id);
    return view('sistema_oc.proveedores.edit_proveedores',  compact('mostrar'));
  }

  public function update_proveedores(Request $request, $id)
  {
    $update =  Models\proveedore::findOrFail($id);
    $update->RFC = $request->RFC;
    $update->Direccion = $request->Direccion;
    $update->Telefono = $request->Telefono;
    $update->Correo = $request->Correo;
    $update->Rsocial = $request->Rsocial;
    $update->Vendedor = $request->Vendedor;
    $update->save();
    return back()->with('mensaje', '¡Cambios del proveedor actualizados!');
  }

  public function home_requisiciones()
  {
    $mostrar = Models\requisicione::all();
    return view('sistema_oc.requisiciones.home_requisiciones',  compact('mostrar'));
  }

  public function alta_requisiciones(Request $request)
  {
    $alta = new Models\requisicione;
    $alta->requisicion = $request->requisicion;
    $alta->fecha_pedido = $request->fecha_pedido;
    $alta->solicito = $request->solicito;
    $alta->autorizo = $request->autorizo;
    $alta->familia = $request->familia;
    $alta->orden_compra = $request->orden_compra;
    $alta->save();
    return back()->with('mensaje', '¡Requisicion agregada con exito!');
  }

  public function partidas(Request $request, $id)
  {
    $mostrar = Models\requisicion_folio::findOrFail($id);
    $cliente = Models\cliente::all()->sortBy('nombre');
    $oc = Models\ocompra::where('Disponibilidad', '=', 'ACTIVO')->orderBy('created_at', 'DESC')->limit(10)->get();
    $proveedor = Models\proveedore::all()->sortBy('Rsocial');
    $partida = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->get();
    $contador = $partida->count();
    $nuevo_contador = $contador + 1;
    $partida_nueva = $mostrar->requisicion . '-' . $nuevo_contador;
    return view('sistema_oc.requisiciones.partidas', compact('oc', 'proveedor', 'mostrar', 'partida_nueva', 'cliente', 'partida'));
  }

  public function alta_partidas(Request $request)
  {

    $alta = new Models\requisicion_partida;
    $alta->requisicion = $request->requisicion;
    $alta->partida = $request->partida;
    $alta->descripcion = $request->descripcion;
    $alta->cantidad = $request->cantidad;
    $alta->precio_unitario = $request->precio_unitario;
    $alta->proveedor = $request->proveedor;
    $alta->unidad = $request->unidad;
    $alta->ot = $request->ot;

    $alta->material = $request->material;
    $alta->cliente = $request->cliente;
    $alta->save();
    return back()->with('mensaje', '¡Partida agregada con exito!');
  }
  public function asignar_oc(Request $request)
  {
    $oc = Models\requisicion_folio::where('requisicion', '=', $request->requisicion_oc)->first();
    $oc->orden_compra = $request->no_oc;
    $oc->proveedor = $request->proveedor;
    $oc->save();

    $partidas = Models\requisicion_partida::where('requisicion', '=', $request->requisicion_oc)->where('requisicion_partidas.proveedor', '=', $request->proveedor)->get();
    foreach ($partidas as $partidas) {
      $partidas->orden_compra = $request->no_oc;
      $partidas->save();
    }
    return back()->with('mensaje', '¡Orden de compra asignada!');
  }

  public function home_partidas()
  {
    $mostrar = Models\requisicion_partida::where('requisicion', '>=', '14000')->get();
    return view('sistema_oc.requisiciones.home_partidas',  compact('mostrar'));
  }

  public function partidas_edit($id)
  {
    $mostrar = Models\requisicion_partida::findOrFail($id);
    $proveedor = Models\proveedore::all();
    $cliente = Models\cliente::all();
    return view('sistema_oc.requisiciones.partidas_edit', compact('mostrar', 'cliente', 'proveedor'));
  }

  public function partidas_update(Request $request)
  {
      
    $mostrar = Models\requisicion_partida::where('partida', '=', $request->partida)->first();
    $mostrar->requisicion = $request->requisicion;
    $mostrar->partida = $request->partida;
    $mostrar->descripcion = $request->descripcion;
    $mostrar->cantidad = $request->cantidad;
    $mostrar->unidad = $request->unidad;
    $mostrar->precio_unitario = $request->precio_unitario;
    $mostrar->proveedor = $request->proveedor;
    $mostrar->material_partida = $request->material;
    $mostrar->ot = $request->ot;
    $mostrar->cliente = $request->cliente;
    $mostrar->save();
    return back()->with('mensaje', '¡Los datos de la partida han sido actualizados!');
  }

  public function home_almacen()
  {
    $mostrar = Models\requisicion_partida::all();
    return view('sistema_oc.almacen.buscador_almacen', compact('mostrar'));
  }

  public function almacen_alta_material($id)
  {
    $mostrar = Models\requisicion_partida::findOrFail($id);
    return view('sistema_oc.almacen.alta_almacen_material', compact('mostrar'));
  }

  public function almacen_alta_herramienta($id)
  {
    $mostrar = Models\requisicion_partida::findOrFail($id);
    $herramienta = Models\productos::all();
    return view('sistema_oc.almacen.alta_almacen_herramienta', compact('mostrar', 'herramienta'));
  }

  public function almacen_alta_herramienta_registro(Request $request, $id)
  {
    $mostrar = Models\requisicion_partida::where('partida', '=', $request->partida)->first();
    $mostrar->partida_recibida = 1;
    $mostrar->factura = $request->factura;
    $mostrar->save();

    $fecha = Carbon::now();
    $fecha = $fecha->format('Y-m-d');

    $wordCount = Models\requisicion_partida::where('orden_compra', '=', $mostrar->orden_compra)->count();
    $recibidas = Models\requisicion_partida::where('orden_compra', '=', $mostrar->orden_compra)->sum('partida_recibida');
    if ($wordCount == $recibidas) {
      $mostraroc = Models\ocompra::where('Codigo', '=', $mostrar->orden_compra)->first();
      $mostraroc->alta_almacen = 'RECIBIDA';
      $mostraroc->fecha_almacen = $fecha;
      $mostraroc->save();
    }

    $conteo_ot = Models\requisicion_partida::where('orden_compra', '=', $mostrar->orden_compra)->where('ot', '=', $mostrar->ot)->count();
    $recibidas_ot = Models\requisicion_partida::where('orden_compra', '=', $mostrar->orden_compra)->where('ot', '=', $mostrar->ot)->sum('partida_recibida');
    if ($conteo_ot == $recibidas_ot) {
      $produccionot = Models\production::where('ot', '=', $mostrar->ot)->first();
      $produccionot->entrada_material = 'RECIBIDA';
      $produccionot->save();
    }

    $almacen = Models\productos::where('codigo', '=', $request->herramienta)->first();
    $cantidad = $almacen->Cantidad_Actual + $request->cantidad;
    $almacen->Cantidad_Actual = $cantidad;
    $almacen->save();
    return back()->with('mensaje', 'ENTRADA DE REQUISICION A ALMACEN EXITOSA');
  }

  public function almacen_baja_material($id)
  {
    $mostrar = Models\requisicion_partida::findOrFail($id);
    return view('sistema_oc.almacen.baja_almacen_material', compact('mostrar'));
  }

  public function almacen_certificado($id)
  {
    $mostrar = Models\requisicion_partida::findOrFail($id);
    return view('sistema_oc.almacen.alta_almacen_certificado', compact('mostrar'));
  }

  public function almacen_certificado_registro($id, request $request)
  {
    Storage::disk('public')->putFileAs('certificado_material', $request->file('certificado_material'), $request->numero_partida . '.pdf');
    $mostrarp = Models\requisicion_partida::where('partida', '=', $request->numero_partida)->first();
    $mostrarp->certificado_cargado = '1';
    $mostrarp->save();
    return back()->with('mensaje', '¡Cerficado cargado con exito!');
  }

  public function home_inventario()
  {
    $maximo = Models\productos::max('id');
    $mostrar = Models\productos::all();
    $proveedor = Models\proveedore::all();
    return view('sistema_oc.almacen.home_inventario', compact('mostrar', 'maximo', 'proveedor'));
  }

  public function alta_inventario(Request $request)
  {
    $codigo = Models\chart::where('id', '=', '1')->first();
    $alta = new Models\productos;
    if ($request->categoria == 'TOR-') {
      $numero = $codigo->C_TOR;
      $numero = $numero + 1;
      $alta->codigo = 'TOR-' . $numero;
      $codigo->C_TOR = $numero;
    } elseif ($request->categoria == 'END-') {
      $numero = $codigo->C_END;
      $numero = $numero + 1;
      $alta->codigo = 'END-' . $numero;
      $codigo->C_END = $numero;
    } elseif ($request->categoria == 'INS-') {
      $numero = $codigo->C_INS;
      $numero = $numero + 1;
      $alta->codigo = 'INS-' . $numero;
      $codigo->C_INS = $numero;
    } elseif ($request->categoria == 'HERR-') {
      $numero = $codigo->C_HERR;
      $numero = $numero + 1;
      $alta->codigo = 'HERR-' . $numero;
      $codigo->C_HERR = $numero;
    } elseif ($request->categoria == 'HERR-') {
      $numero = $codigo->C_HERR;
      $numero = $numero + 1;
      $alta->codigo = 'HERR-' . $numero;
      $codigo->C_HERR = $numero;
    } elseif ($request->categoria == 'CONS-') {
      $numero = $codigo->C_CONS;
      $numero = $numero + 1;
      $alta->codigo = 'CONS-' . $numero;
      $codigo->C_CONS = $numero;
    } elseif ($request->categoria == 'LIM-') {
      $numero = $codigo->C_LIM;
      $numero = $numero + 1;
      $alta->codigo = 'LIM-' . $numero;
      $codigo->C_LIM = $numero;
    } elseif ($request->categoria == 'SEG-') {
      $numero = $codigo->C_SEG;
      $numero = $numero + 1;
      $alta->codigo = 'SEG-' . $numero;
      $codigo->C_SEG = $numero;
    } elseif ($request->categoria == 'SOLD-') {
      $numero = $codigo->C_SOLD;
      $numero = $numero + 1;
      $alta->codigo = 'SOLD-' . $numero;
      $codigo->C_SOLD = $numero;
    } elseif ($request->categoria == 'MACH-') {
      $numero = $codigo->C_MACH;
      $numero = $numero + 1;
      $alta->codigo = 'MACH-' . $numero;
      $codigo->C_MACH = $numero;
    }
    $alta->Descripcion = $request->Descripcion;
    $alta->Numero_de_parte = $request->Numero_de_parte;
    $alta->Cantidad_Actual = $request->Cantidad_Actual;
    $alta->Min = $request->Min;
    $alta->Max = $request->Max;
    $alta->Unidad = $request->Unidad;
    $alta->Proveedor_cliente = $request->Proveedor_cliente;
    $alta->save();
    $codigo->save();
    return back()->with('mensaje', '¡Herramienta agregada con exito!');
  }

  public function inventario_edit($id)
  {
    $mostrar = Models\productos::findOrFail($id);
    return view('sistema_oc.almacen.edit_inventario', compact('mostrar'));
  }

  public function inventario_edit_registro(Request $request, $id)
  {
    $update =  Models\productos::findOrFail($id);
    $update->Descripcion = $request->Descripcion;
    $update->Numero_de_parte = $request->Numero_de_parte;
    $update->Cantidad_Actual = $request->Cantidad_Actual;
    $update->Min = $request->Min;
    $update->Max = $request->Max;
    $update->Unidad = $request->Unidad;
    $update->Proveedor_cliente = $request->Proveedor_cliente;
    $update->save();
    return back()->with('mensaje', '¡El registro ha sido modificado exitosamente!');
  }

  public function almacen_baja_herramienta(Request $request)
  {
    $herramienta = Models\productos::all();
    return view('sistema_oc.almacen.baja_almacen_herramienta', compact('herramienta'));
  }

  public function almacen_baja_herramienta_registro(Request $request)
  {
    $almacen = Models\productos::where('codigo', '=', $request->herramienta)->first();
    $cantidad = $almacen->Cantidad_Actual - $request->cantidad;
    $almacen->Cantidad_Actual = $cantidad;
    $almacen->save();

    $registro = new Models\registro;
    $registro->codigo = $request->herramienta;
    $registro->folio = $request->folio;
    $registro->solicita = $request->solicita;
    $registro->cantidad = $request->cantidad;
    $registro->area = $request->area;
    $registro->save();
    return back()->with('mensaje', '¡Salida de herramienta registrada!');
  }

  public function delete_partida_requisicion(Request $request)
  {
    $partida_delete_cotizacion = Models\requisicion_partida::where('id', '=', $request->numero_id)->delete();
    return back()->with('mensaje', '¡Partida eliminada con exitos!');
  }

  public function edicion_partida_requisicion(Request $request)
  {
    $partida_edicion_cotizacion = Models\requisicion_partida::where('id', '=', $request->numero_id)->first();
    $partida_edicion_cotizacion->partida = $request->numero_partida;
    $partida_edicion_cotizacion->descripcion = $request->descripcion;
    $partida_edicion_cotizacion->cantidad = $request->cantidad;
    $partida_edicion_cotizacion->precio_unitario = $request->precio_unitario;
    $partida_edicion_cotizacion->pu_uno = $request->pu_uno;
    $partida_edicion_cotizacion->prov_uno = $request->prov_uno;
    $partida_edicion_cotizacion->pu_dos = $request->pu_dos;
    $partida_edicion_cotizacion->prov_dos = $request->prov_dos;
    $partida_edicion_cotizacion->pu_tres = $request->pu_tres;
    $partida_edicion_cotizacion->prov_tres = $request->prov_tres;
    $partida_edicion_cotizacion->proveedor = $request->proveedor;
    $partida_edicion_cotizacion->ot = $request->ot;
    $partida_edicion_cotizacion->material = $request->material;
    $partida_edicion_cotizacion->factura = $request->factura;
    $partida_edicion_cotizacion->orden_compra = $request->oc;
    $partida_edicion_cotizacion->save();
    return back()->with('mensaje', '¡Cambios realizados con exito!');
  }

  public function edicion_partida_requisicion_cotizaciones(Request $request)
  {
      
    $partida_edicion_cotizacion = Models\requisicion_partida::where('id', '=', $request->id)->first();
    $partida_edicion_cotizacion->partida = $request->numero_partida;
    $partida_edicion_cotizacion->descripcion = $request->descripcion;
    $partida_edicion_cotizacion->precio_unitario = $request->precio_unitario;

    $partida_edicion_cotizacion->pu_uno = $request->pu_uno;
    $partida_edicion_cotizacion->prov_uno = $request->prov_uno;
    $partida_edicion_cotizacion->pu_dos = $request->pu_dos;
    $partida_edicion_cotizacion->prov_dos = $request->prov_dos;
    $partida_edicion_cotizacion->pu_tres = $request->pu_tres;
    $partida_edicion_cotizacion->prov_tres = $request->prov_tres;
    $partida_edicion_cotizacion->material = $request->material;

    $partida_edicion_cotizacion->save();
    return back()->with('mensaje', '¡Cambios realizados con exito!');
  }

  public function home_administracion_compras()
  {
    $ots = Models\compras_ruta::all();
    $date = Carbon::now();
    return view('sistema_oc.administracion.home_administracion_compras', compact('ots', 'date'));
  }

  public function rutas_administracion_compras($id)
  {
    $ruta_ot = Models\compras_ruta::where('id', '=', $id)->first();
    $registro_ot = Models\compras_registro::where('ot', '=', $ruta_ot->ot)->get();
    return view('sistema_oc.administracion.rutas_administracion_compras', compact('ruta_ot', 'registro_ot'));
  }

  public function home_requisiciones_pendientes()
  {

    $material_pendiente = Models\compras_ruta::where('compras_oc', '=', 'DONE')->where('compras_entrada', '=', '-')->get();
    return view('sistema_oc.requisiciones.home_requisiciones_pendientes', compact('material_pendiente'));
  }

  public function home_recepcion_material()
  {
    $materiales = Models\requisicion_partida::where('tipo_requisicion', '=', 'MATERIAL')->where('partida_recibida', '=', '0')->get();
    return view('sistema_oc.almacen.recepcion.home_recepcion_material', compact('materiales'));
  }

  public function home_material_historico()
  {
    $materiales = Models\requisicion_partida::all();
    return view('sistema_oc.almacen.recepcion.home_material_historico', compact('materiales'));
  }

  public function almacen_alta_material_registro(Request $request)
  {

    $fecha = Carbon::now();
    $mostrar = Models\requisicion_partida::where('id', '=', $request->entrada_material_id)->first();
    $mostrar->partida_recibida = 1;
    $mostrar->fecha_recibida = $fecha;
    $mostrar->factura = $request->entrada_material_factura;
    $mostrar->save();

    $partidas_totales_ot = Models\requisicion_partida::where('ot', '=', $mostrar->ot)->count();
    $recibidas_ot = Models\requisicion_partida::where('ot', '=', $mostrar->ot)->sum('partida_recibida');
    if ($partidas_totales_ot == $recibidas_ot) {
      //  $produccionot = Models\production::where('ot', '=', $mostrar->ot)->first();
      // $produccionot->entrada_material = 'RECIBIDA';
      // $produccionot->save();

      $combrobacion_ruta_ot = Models\aeme_ruta::where('ot', '=', $mostrar->ot)->exists();
      if ($combrobacion_ruta_ot == True) {
        $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $mostrar->ot)->first();
        $alta_proceso_ot->sistema_compras = "DONE";
        $alta_proceso_ot->save();

        $alta_proceso_compras =  Models\compras_ruta::where('ot', '=', $mostrar->ot)->first();
        $alta_proceso_compras->compras_entrada = 'DONE';
        $alta_proceso_compras->save();

        $date = Carbon::now();
        $aeme_registro = new Models\aeme_registro;
        $aeme_registro->ot = $mostrar->ot;
        $aeme_registro->area = 'COMPRAS';
        $aeme_registro->personal = Auth::user()->name;
        $aeme_registro->hora = $date;
        $aeme_registro->save();
      }
    }
    $requisicion_conteo = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->count();
    $requisicion_recibidas = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->sum('partida_recibida');

    if ($requisicion_conteo == $requisicion_recibidas) {
      $requisicion_folio = Models\requisicion_folio::where('requisicion', '=', $mostrar->requisicion)->first();
      $requisicion_folio->estatus = "ENTRADA REGISTRADA EN ALMACEN";
      $requisicion_folio->save();
    }
    $alta_registro_compras = new Models\compras_registro();
    $alta_registro_compras->ot = $mostrar->ot;
    $alta_registro_compras->descripcion = $mostrar->descripcion;
    $alta_registro_compras->area = "ALMACEN";
    $alta_registro_compras->personal =  Auth::user()->name;
    $alta_registro_compras->hora = $fecha;
    $alta_registro_compras->save();

    $oc_total = Models\datamain::where('orden_trabajo', '=', $mostrar->ot)->first();
    $oc_ot_totales = Models\datamain::where('orden_compra', '=', $oc_total->orden_compra)->where('cliente', '=', $oc_total->cliente)->get();
    $total_invertido = 0;


    foreach ($oc_ot_totales as $partidas_recibidas_ot) {
      $partidas_recibidas = Models\requisicion_partida::where('ot', '=', $partidas_recibidas_ot->orden_trabajo)->where('partida_recibida', '=', 1)->get();

      foreach ($partidas_recibidas as $partida_recibida) {
        $suma = 0;
        $suma = $partida_recibida->precio_unitario * $partida_recibida->cantidad;
        $porcentaje = $suma * 0.16;
        $suma = $suma + $porcentaje;
        $total_invertido = $total_invertido + $suma;
      }
    }

    foreach ($oc_ot_totales as  $ot_total) {
      $ot_total->monto_total = $total_invertido;
      $ot_total->save();
    }


    $mostrar = Models\requisicion_partida::where('partida', '=', $request->entrada_material_partida)->first();
    $codigo = $mostrar->partida;
    return view('barcode', compact('codigo'));
  }

  public function home_salida_material()
  {
    $date = Carbon::now();
    $materiales = Models\requisicion_partida::where('tipo_requisicion', '=', 'MATERIAL')->where('partida_recibida', '=', '1')->where('salida_partida', '=', '0')->get();
    return view('sistema_oc.almacen.recepcion.home_salida_material', compact('materiales', 'date'));
  }

  public function salida_material_registro(Request $request)
  {
    //Registro en produccion
    $date = Carbon::now();
    $mostrar = Models\requisicion_partida::where('partida', '=', $request->salida_material_partida)->first();
    $mostrar->salida_partida = 1;
    $mostrar->fecha_salida = $date;
    $mostrar->save();

    //Registro en el proceso de compras
    $comprobacion_compras_ot = Models\compras_ruta::where('ot', '=', $mostrar->ot)->exists();
    if ($comprobacion_compras_ot == True) {
      $compras_ruta_registro = Models\compras_ruta::where('ot', '=', $mostrar->ot)->first();
      $compras_ruta_registro->compras_salida = "DONE";
      $compras_ruta_registro->save();

      $compras_registro = new Models\compras_registro;
      $compras_registro->ot = $mostrar->ot;
      $compras_registro->area = "ALMACEN PISO";
      $compras_registro->personal = Auth::user()->name;
      $compras_registro->hora = $date;
      $compras_registro->save();
    }

    //Registro de almacen
    $registro = new Models\registro;
    $registro->tipo_salida = 'MATERIAL';
    $registro->ot = $request->salida_material_ot;
    $registro->cliente = $request->salida_material_cliente;
    $registro->partida_codigo = $request->salida_material_partida;
    $registro->descripcion = $request->salida_material_descripcion;
    $registro->cantidad = $request->salida_material_cantidad;
    $registro->almacen = $request->salida_material_almacen;
    $registro->usuario = $request->salida_material_usuario;
    $registro->produccion = $request->salida_material_produccion;
    $registro->inspeccion = $request->salida_material_inspeccion;
    $registro->save();
    return back()->with('mensaje', '¡Salida de material registrado con exito!');
  }
  public function home_recepcion_herramienta()
  {
    $herramientas = Models\productos::all();
    $materiales = Models\requisicion_partida::where('tipo_requisicion', '=', 'HERRAMIENTA')->where('partida_recibida', '=', '0')->get();
    return view('sistema_oc.almacen.recepcion.home_recepcion_herramienta', compact('materiales', 'herramientas'));
  }
  public function home_recepcion_herramienta_registro(Request $request)
  {

    //Alta de la partida en almacen
    $fecha = Carbon::now();
    $mostrar = Models\requisicion_partida::where('id', '=', $request->entrada_material_id)->first();
    $mostrar->partida_recibida = 1;
    $mostrar->fecha_recibida = $fecha;
    $mostrar->factura = $request->entrada_herramienta_factura;
    $mostrar->save();


    //Alta de la herramienta en el inventario
    $herramienta = Models\productos::where('id', '=', $request->herramienta)->first();
    $cantidad = $herramienta->Cantidad_Actual + $mostrar->cantidad;
    $herramienta->Cantidad_Actual = $cantidad;
    $herramienta->save();

    //Marcar la orden de compra como completada
    $partidas_totales_ot = Models\requisicion_partida::where('orden_compra', '=', $mostrar->orden_compra)->count();
    $recibidas = Models\requisicion_partida::where('orden_compra', '=', $mostrar->orden_compra)->sum('partida_recibida');
    if ($partidas_totales_ot == $recibidas) {
      $mostraroc = Models\ocompra::where('Codigo', '=', $mostrar->orden_compra)->first();
      $mostraroc->alta_almacen = 'RECIBIDA';
      $mostraroc->fecha_almacen = $fecha;
      $mostraroc->save();
    }

    $requisicion_conteo = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->count();
    $requisicion_recibidas = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->sum('partida_recibida');

    if ($requisicion_conteo == $requisicion_recibidas) {
      $requisicion_folio = Models\requisicion_folio::where('requisicion', '=', $mostrar->requisicion)->first();
      $requisicion_folio->estatus = "ENTRADA REGISTRADA EN ALMACEN";
      $requisicion_folio->save();
    }
    return back()->with('mensaje', 'La entrada de la herramienta se ha registrado con exito');
  }
  public function home_salida_herramienta()
  {
    $herramienta = Models\productos::all();
    $salidas_almacen = Models\registro::where('tipo_salida', '=', 'SALIDA ALMACEN')->get();
    return view('sistema_oc.almacen.recepcion.home_salida_herramienta', compact('herramienta', 'salidas_almacen'));
  }
  public function home_salida_herramienta_registro(Request $request)
  {
    $verificacion_ot = Models\production::where('ot', '=', $request->salida_herramienta_ot)->exists();
    if ($verificacion_ot == 'True') {
      $informacion_ot = Models\production::where('ot', '=', $request->salida_herramienta_ot)->first();
      //Busqueda de la herramienta
      $herramienta = Models\productos::where('id', '=', $request->salida_herramienta_id)->first();
      if ($request->salida_herramienta_tipo == 'NO') {
        //Resta en el inventario
        $cantidad = $herramienta->Cantidad_Actual - $request->salida_herramienta_cantidad;
        $herramienta->Cantidad_Actual = $cantidad;
        $herramienta->save();
        //Registro de almacen
        $registro = new Models\registro;
        $registro->tipo_salida = 'HERRAMIENTA';
        $registro->ot = $request->salida_herramienta_ot;
        $registro->cliente = $informacion_ot->cliente;
        $registro->partida_codigo = $herramienta->codigo;
        $registro->descripcion = $herramienta->Descripcion;
        $registro->cantidad = $request->salida_herramienta_cantidad;
        $registro->almacen = 'N/A';
        $registro->usuario = $request->salida_herramienta_usuario;
        $registro->produccion = $request->salida_herramienta_produccion;
        $registro->inspeccion = 'N/A';
        $registro->save();
        return back()->with('mensaje', '¡La salida de la herramienta ha sido registrada con exito!');
      } elseif ($request->salida_herramienta_tipo == 'SI') {
        //Resta en el inventario
        $cantidad = $herramienta->Cantidad_Actual - $request->salida_herramienta_cantidad;
        $herramienta->Cantidad_Actual = $cantidad;
        $herramienta->save();
        //Registro de almacen
        $registro = new Models\registro;
        $registro->tipo_salida = 'SALIDA ALMACEN';
        $registro->ot = $request->salida_herramienta_ot;
        $registro->cliente = $informacion_ot->cliente;
        $registro->partida_codigo = $herramienta->codigo;
        $registro->descripcion = $herramienta->Descripcion;
        $registro->cantidad = $request->salida_herramienta_cantidad;
        $registro->almacen = 'N/A';
        $registro->usuario = $request->salida_herramienta_usuario;
        $registro->produccion = $request->salida_herramienta_produccion;
        $registro->inspeccion = 'N/A';
        $registro->save();
      }
    }
    return back()->with('mensaje', '¡La salida de la herramienta ha sido registrada con exito!');
  }

  public function home_retorno_herramienta($id)
  {
    $retorno_herramienta = Models\registro::where('id', '=', $id)->first();
    $retorno_herramienta->tipo_salida = 'RETORNO ALMACEN';
    $retorno_herramienta->save();

    dd($retorno_herramienta);

    $herramienta = Models\productos::where('codigo', '=', $retorno_herramienta->partida_codigo)->first();
    $cantidad = $herramienta->Cantidad_Actual + $retorno_herramienta->cantidad;
    $herramienta->Cantidad_Actual = $cantidad;
    $herramienta->save();

    return back()->with('mensaje', '¡Retorno de herramienta registrado con exito!');
  }

  public function home_inventario_folio()
  {
    $registros = Models\salida_folio::where('registrada', '=', 'PENDIENTE')->get();
    $folio = Models\chart::where('id', '=', '1')->first();
    return view('sistema_oc.almacen.recepcion.home_inventario_folio', compact('folio', 'registros'));
  }
  public function home_inventario_folio_registro(Request $request)
  {
    $registro_folio = new Models\salida_folio();
    $registro_folio->folio = $request->folio;
    $registro_folio->solicita = $request->solicita;
    $registro_folio->entrega = $request->entrega;
    $registro_folio->area = $request->area;
    $registro_folio->registrada = "PENDIENTE";
    $registro_folio->save();

    $folio = Models\chart::where('id', '=', '1')->first();
    $folio_final = $folio->salida_folio;
    $folio->salida_folio = $folio_final + 1;
    $folio->save();
    return back()->with('message', '¡Folio registrado con exito!');
  }

  public function home_inventario_partidas($id)
  {
    $registro_folio = Models\salida_folio::where('id', '=', $id)->first();
    $registros =  Models\salida_partida::where('folio', '=', $registro_folio->folio)->get();
    return view('sistema_oc.almacen.recepcion.home_inventario_partidas', compact('registro_folio', 'registros'));
  }

  public function home_inventario_partidas_registro(Request $request)
  {
    $herramienta_busqueda = Models\productos::where('codigo', '=', $request->codigo)->exists();
    if ($herramienta_busqueda == True) {
      $herramienta = Models\productos::where('codigo', '=', $request->codigo)->first();
      $herramienta_registro = new Models\salida_partida;
      $herramienta_registro->folio = $request->folio;
      $herramienta_registro->entrega = Auth::user()->name;
      $herramienta_registro->codigo = $request->codigo;
      $herramienta_registro->descripcion = $herramienta->Descripcion;
      $herramienta_registro->cantidad = 1;
      $herramienta_registro->save();
      return back()->with('mensaje', '¡Salida registrada!');
    } else {
      return back()->with('mensaje', '¡Esta herramienta no esta en el inventario!');
    }
  }

  public function delete_inventario_partidas_registro($registro)
  {
    $salida_partida = Models\salida_partida::where('id', '=', $registro)->first();
    $salida_partida->delete();
    return back()->with('mensaje', '¡Eliminada con exito!');
  }

  public function registro_folio_partidas_inventario($registro_folio)
  {
    $folio = Models\salida_folio::where('id', '=', $registro_folio)->first();
    $partidas =  Models\salida_partida::where('folio', '=', $folio->folio)->get();
    foreach ($partidas as $partida) {
      $herramienta = Models\productos::where('codigo', '=', $partida->codigo)->first();
      $herramienta->Cantidad_Actual =  $herramienta->Cantidad_Actual - 1;
      $herramienta->save();
    }
    $folio->registrada = "REGISTRADA";
    $folio->save();
    return back()->with('mensaje', '¡Salidas reflejadas en el inventario con exito!');
  }

  public function barcode($id)
  {
    $herramienta = Models\productos::where('id', '=', $id)->first();
    $codigo = $herramienta->codigo;
    return view('barcode', compact('codigo'));
  }

  public function salida_material_usuario_barcode(Request $request)
  {
    //Registro de entrada de la partida a almacen.
    $date = Carbon::now();
    $mostrar = Models\requisicion_partida::where('partida', '=', $request->material)->first();
    $mostrar->salida_partida = 1;
    $mostrar->fecha_salida = $date;
    $mostrar->save();

    //Conteo de la partidas para la OT
    $conteo_partidas_totales = Models\requisicion_partida::where('ot', '=', $mostrar->ot)->count();
    $conteo_partidas_recibidas = Models\requisicion_partida::where('ot', '=', $mostrar->ot)->where('salida_partida', '=', 1)->count();

    //Registro de salida de material almacen
    if ($conteo_partidas_totales == $conteo_partidas_recibidas) {
      $comprobacion_compras_ot = Models\compras_ruta::where('ot', '=', $mostrar->ot)->exists();
      if ($comprobacion_compras_ot == True) {
        $compras_ruta_registro = Models\compras_ruta::where('ot', '=', $mostrar->ot)->first();
        $compras_ruta_registro->compras_salida = "DONE";
        $compras_ruta_registro->save();
      }
    }
    $compras_registro = new Models\compras_registro;
    $compras_registro->ot = $mostrar->ot;
    $compras_registro->area = $request->usuario;
    $compras_registro->descripcion = $mostrar->descripcion;
    $compras_registro->personal = Auth::user()->name;
    $compras_registro->hora = $date;
    $compras_registro->save();
    return back()->with('mensaje', '¡Salida de material al usuario registrado con exito!');
  }

  public function salida_material_gallinero_barcode(Request $request)
  {
    // Registro de almacen para el gallinero
    $date = Carbon::now();
    $mostrar = Models\requisicion_partida::where('partida', '=', $request->material)->first();
    $compras_registro = new Models\compras_registro;
    $compras_registro->ot = $mostrar->ot;
    $compras_registro->area = "GALLINERO";
    $compras_registro->descripcion = $mostrar->descripcion;
    $compras_registro->personal = Auth::user()->name;
    $compras_registro->hora = $date;
    $compras_registro->save();
    return back()->with('mensaje', '¡Salida de material al gallinero registrado con exito!');
  }
  //Este es donde es empezara el modulo de requisisciones
  public function home_requisiciones_usuario()
  {
    $usuario =  Auth::user()->name;
    $usuario_requisiciones = Models\requisicion_folio::where('usuario', '=', $usuario)->get();
    return view('sistema_oc.requisiciones_usuario.home_requisiciones_usuario', compact('usuario', 'usuario_requisiciones'));
  }
  public function home_requisiciones_usuario_registro(Request $request)
  {
    $alta = new Models\requisicion_folio();
    $alta->tipo_requisicion = $request->tipo_requisicion;
    $alta->usuario =  Auth::user()->name;
    $alta->estatus = "SOLICITADA";
    $alta->save();
    $alta->requisicion = $alta->id;
    $alta->save();
    return back()->with('mensaje', '¡Tu requisicion fue registrada con exito!');
  }

  public function home_requisiciones_usuario_partida($id)
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $id)->first();
    $partidas = Models\requisicion_partida::where('requisicion', '=', $requisicion->requisicion)->get();
    return view('sistema_oc.requisiciones_usuario.home_partidas_usuarios', compact('requisicion', 'partidas'));
  }

  public function home_requisiciones_usuario_partida_registro(Request $request)
  {
    $contador = Models\requisicion_partida::where('requisicion', '=', $request->numero_requisicion)->count();
    $verificacion_folio = Models\requisicion_folio::where('requisicion', '=', $request->numero_requisicion)->first();
    if ($verificacion_folio->estatus == 'SOLICITADA') {
      $contador = $contador + 1;
      $alta = new Models\requisicion_partida();
      $alta->requisicion = $request->numero_requisicion;
      $alta->partida = $request->numero_requisicion . '-' . $contador;
      $alta->usuario = $request->usuario;
      $alta->cantidad = $request->cantidad;
      $alta->unidad = $request->unidad;
      $alta->descripcion = $request->descripcion;
      $alta->material = $request->material;
      $alta->fecha_entrega = $request->fecha_entrega;
      $alta->ot = $request->ot;
      $buscador_ot = Models\datamain::where('orden_trabajo', '=', $request->ot)->exists();
      if ($buscador_ot == True) {
        $buscador_ot = Models\datamain::where('orden_trabajo', '=', $request->ot)->first();
        $alta->cliente = $buscador_ot->cliente;
        $alta->save();
        return back()->with('mensaje-success', '¡Registro de requisicion se ha realizado con exito!');
      } else {
        return back()->with('mensaje-error', '¡Ingresa una OT valida!');
      }
    } else {
      return back()->with('mensaje-error', '¡No puedes agregar más partidas a una requisición ya enviada!');
    }
  }

  public function home_requisiciones_usuario_partida_delete($id)
  {
    $partida_requisicion = Models\requisicion_partida::where('id', '=', $id)->first();
    $requisicion = Models\requisicion_folio::where('requisicion', '=', $partida_requisicion->requisicion)->first();
    if ($requisicion->estatus == 'SOLICITADA') {
      $partida_delete = Models\requisicion_partida::where('id', '=', $id)->delete();
      return back()->with('mensaje-success', '¡Partida eliminada!');
    } else {
      return back()->with('mensaje-error', '¡Requisicion ya enviada a compras!');
    }
  }

  public function home_requisiciones_usuario_compras($id)
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $id)->first();
    if ($requisicion->estatus == 'SOLICITADA') {
      $requisicion->estatus = "PENDIENTE POR COTIZAR";
      $requisicion->save();
      return back()->with('mensaje-success', '¡Requisicion enviada al departamento de compras!');
    } else {
      return back()->with('mensaje-error', '¡La requisicion ya fue enviada a compras anteriormente!');
    }
  }
  public function home_requisiciones_compras_pendientes() //se usa
  {
    $compras_estado = Auth::user()->state;
    $requisiciones = Models\requisicion_folio::where('tipo_requisicion', '=', $compras_estado)->where('estatus', '<>', 'ENTRADA REGISTRADA EN ALMACEN')->get();

    return view('sistema_oc.requisiciones_usuario.home_compras_requisiciones', compact('requisiciones'));
  }

  public function home_requisiciones_compras_historico() //se usa
  {
    $requisiciones = Models\requisicion_folio::all();
    return view('sistema_oc.requisiciones_usuario.home_requisiciones_historicos', compact('requisiciones'));
  }

  public function home_requisiciones_compras_historico_regreso($requisicion) //se usa
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $requisicion)->first();
    $requisicion->estatus = "COTIZACION APROBADA";
    $requisicion->save();
    return back()->with('mensaje', '¡Requisicion liberada con éxito!');
  }

  public function home_requisiciones_compras_historico_regreso_usuario($requisicion) //se usa
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $requisicion)->first();
    $requisicion->estatus = "SOLICITADA";
    $requisicion->save();
    return back()->with('mensaje', '¡Requisicion regresada al usuario!');
  }

  public function home_requisiciones_compras_historico_cancelar($requisicion) //se usa
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $requisicion)->first();
    $requisicion->estatus = "CANCELADA";
    $requisicion->save();
    return back()->with('mensaje', '¡Requisicion cancelada!');
  }
  public function home_requisiciones_compras_historico_aprobacion($requisicion) //se usa
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $requisicion)->first();
    $requisicion->cot_dos = "DONE";
    $requisicion->cot_tres = "DONE";
    $requisicion->save();
    return back()->with('mensaje', '¡Cotizaciones liberadas!');
  }

  public function home_requisiciones_compras_partidas($id)
  {
    $proveedores = Models\proveedore::orderBy('rsocial')->get();
    $requisicion = Models\requisicion_folio::where('id', '=', $id)->first();
    $partidas = Models\requisicion_partida::where('requisicion', '=', $requisicion->requisicion)->get();
    return view('sistema_oc.requisiciones_usuario.home_compras_partidas', compact('requisicion', 'partidas', 'proveedores'));
  }

  public function home_requisiciones_compras_cambio($id)
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $id)->first();
    if ($requisicion->tipo_requisicion == 'HERRAMIENTA') {
      $requisicion->tipo_requisicion = 'MATERIAL';
    } elseif ($requisicion->tipo_requisicion == 'MATERIAL') {
      $requisicion->tipo_requisicion = 'HERRAMIENTA';
    }
    $requisicion->save();
    return back()->with('mensaje', '¡Tipo de requisicion cambiada!');
  }


  public function home_requisiciones_compras_cotizacion_uno(Request $request)
  {
    $requisicion_folio = Models\requisicion_folio::where('requisicion', '=', $request->numero_requisicion)->first();
    Storage::disk('public')->putFileAs('cotizacion_orden', $request->file('cotizacion'), '1-' . $request->numero_requisicion . '.pdf');
    $requisicion_folio->cot_uno = "DONE";
    $requisicion_folio->cot_uno_proveedor = $request->proveedor;
    $requisicion_folio->save();
    return back()->with('mensaje-success', '¡La cotizacion #1 fue cargada con exito!');
  }
  public function home_requisiciones_compras_cotizacion_dos(Request $request)
  {
    $requisicion = Models\requisicion_folio::where('requisicion', '=', $request->numero_requisicion)->first();
    Storage::disk('public')->putFileAs('cotizacion_orden', $request->file('cotizacion'), '2-' . $request->numero_requisicion . '.pdf');
    $requisicion->cot_dos = "DONE";
    $requisicion->cot_dos_proveedor = $request->proveedor;

    $requisicion->save();
    return back()->with('mensaje-success', '¡La cotizacion #2 fue cargada con exito!');
  }
  public function home_requisiciones_compras_cotizacion_tres(Request $request)
  {
    $requisicion = Models\requisicion_folio::where('requisicion', '=', $request->numero_requisicion)->first();
    Storage::disk('public')->putFileAs('cotizacion_orden', $request->file('cotizacion'), '3-' . $request->numero_requisicion . '.pdf');
    $requisicion->cot_tres = "DONE";
    $requisicion->cot_tres_proveedor = $request->proveedor;
    $requisicion->save();
    return back()->with('mensaje-success', '¡La cotizacion #3 fue cargada con exito!');
  }


  public function home_requisiciones_compras_cotizaciones_enviar(Request $request, $requisicion)
  {

    $requisicion_folio = Models\requisicion_folio::where('id', '=', $requisicion)->first();

    if ($request->marko == 1) {
      $requisicion_folio->c_marko = 1;
    }
    if ($request->abraham == 1) {
      $requisicion_folio->c_abraham = 1;
    }
    if ($request->eduardo == 1) {
      $requisicion_folio->c_eduardo = 1;
    }
    $requisicion_folio->estatus = "EN ESPERA DE APROBACION";

    $requisicion_folio->save();
    $request->user()->notify(new OrderProcessed($requisicion_folio));
    return back()->with('mensaje-success', '¡La requisicion fue enviada para su aprobación!');
  }

  // Recepcion de partidas desde compras
  public function entrada_material_compras(Request $request)
  {

    $fecha = Carbon::now();
    $mostrar = Models\requisicion_partida::where('id', '=', $request->numero_id)->first();
    $mostrar->partida_recibida = 1;
    $mostrar->fecha_recibida = $fecha;
    $mostrar->factura = $request->entrada_material_factura;
    $mostrar->save();

    $partidas_totales_ot = Models\requisicion_partida::where('ot', '=', $mostrar->ot)->count();
    $recibidas_ot = Models\requisicion_partida::where('ot', '=', $mostrar->ot)->sum('partida_recibida');
    if ($partidas_totales_ot == $recibidas_ot) {
      //  $produccionot = Models\production::where('ot', '=', $mostrar->ot)->first();
      // $produccionot->entrada_material = 'RECIBIDA';
      //  $produccionot->save();

      $combrobacion_ruta_ot = Models\aeme_ruta::where('ot', '=', $mostrar->ot)->exists();
      if ($combrobacion_ruta_ot == True) {
        $alta_proceso_ot = Models\aeme_ruta::where('ot', '=', $mostrar->ot)->first();
        $alta_proceso_ot->sistema_compras = "DONE";
        $alta_proceso_ot->save();

        $alta_proceso_compras =  Models\compras_ruta::where('ot', '=', $mostrar->ot)->first();
        $alta_proceso_compras->compras_entrada = 'DONE';
        $alta_proceso_compras->save();

        $date = Carbon::now();
        $aeme_registro = new Models\aeme_registro;
        $aeme_registro->ot = $mostrar->ot;
        $aeme_registro->area = 'COMPRAS';
        $aeme_registro->personal = Auth::user()->name;
        $aeme_registro->hora = $date;
        $aeme_registro->save();
      }
    }
    $requisicion_conteo = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->count();
    $requisicion_recibidas = Models\requisicion_partida::where('requisicion', '=', $mostrar->requisicion)->sum('partida_recibida');

    if ($requisicion_conteo == $requisicion_recibidas) {
      $requisicion_folio = Models\requisicion_folio::where('requisicion', '=', $mostrar->requisicion)->first();
      $requisicion_folio->estatus = "ENTRADA REGISTRADA EN ALMACEN";
      $requisicion_folio->save();
    }
    $alta_registro_compras = new Models\compras_registro();
    $alta_registro_compras->ot = $mostrar->ot;
    $alta_registro_compras->descripcion = $mostrar->descripcion;
    $alta_registro_compras->area = "COMPRAS";
    $alta_registro_compras->personal =  Auth::user()->name;
    $alta_registro_compras->hora = $fecha;
    $alta_registro_compras->save();

    $oc_total = Models\datamain::where('orden_trabajo', '=', $mostrar->ot)->first();
    $oc_ot_totales = Models\datamain::where('orden_compra', '=', $oc_total->orden_compra)->where('cliente', '=', $oc_total->cliente)->get();
    $total_invertido = 0;


    foreach ($oc_ot_totales as $partidas_recibidas_ot) {
      $partidas_recibidas = Models\requisicion_partida::where('ot', '=', $partidas_recibidas_ot->orden_trabajo)->where('partida_recibida', '=', 1)->get();

      foreach ($partidas_recibidas as $partida_recibida) {
        $suma = 0;
        $suma = $partida_recibida->precio_unitario * $partida_recibida->cantidad;
        $porcentaje = $suma * 0.16;
        $suma = $suma + $porcentaje;
        $total_invertido = $total_invertido + $suma;
      }
    }

    foreach ($oc_ot_totales as  $ot_total) {
      $ot_total->monto_total = $total_invertido;
      $ot_total->save();
    }


    return back()->with('mensaje', '¡Entrada de partida registrada por almacen! ');
  }

  public function home_cotizaciones_aprobacion($id)
  {
    $requisicion = Models\requisicion_folio::where('id', '=', $id)->first();
    //$requisicion_partida = Models\requisicion_partida::where('requisicion', '=', $requisicion->requisicion)->get();
    $requisicion_partidas = DB::table('requisicion_partidas')
      ->join('datamains', 'requisicion_partidas.ot', '=', 'datamains.orden_trabajo')
      ->where('requisicion_partidas.requisicion', '=', $requisicion->requisicion)
      ->select(
        'requisicion_partidas.requisicion',
        'requisicion_partidas.partida',
        'requisicion_partidas.usuario',
        'requisicion_partidas.cantidad',
        'requisicion_partidas.descripcion',
        'requisicion_partidas.material',
        'requisicion_partidas.precio_unitario',
        'requisicion_partidas.unidad',
        'requisicion_partidas.prov_uno',
        'requisicion_partidas.pu_uno',
        'requisicion_partidas.id',
        'requisicion_partidas.prov_dos',
        'requisicion_partidas.pu_dos',
        'requisicion_partidas.fecha_entrega',
        'requisicion_partidas.prov_tres',
        'requisicion_partidas.pu_tres',
        'requisicion_partidas.cliente',
        'requisicion_partidas.ot',
        'datamains.orden_compra',
        'datamains.moneda',
        'datamains.monto',
        'datamains.monto_total',
      )
      ->get();

    return view('sistema_oc.requisiciones_usuario.home_cotizaciones_aprobacion', compact('requisicion', 'requisicion_partidas'));
  }

  public function home_cotizacion_aprobacion_uno($requisicion_partida)
  {
    $requisicion_partidas = Models\requisicion_partida::where('id', '=', $requisicion_partida)->first();
    $requisicion_partidas->precio_unitario = $requisicion_partidas->pu_uno;
    $requisicion_partidas->proveedor = $requisicion_partidas->prov_uno;
    $requisicion_partidas->pu_aprobado = 1;
    $requisicion_partidas->save();

    $requisicion_totales_conteo = Models\requisicion_partida::where('requisicion', '=', $requisicion_partidas->requisicion)->count();
    $requisicion_totales_suma = Models\requisicion_partida::where('requisicion', '=', $requisicion_partidas->requisicion)->where('pu_aprobado', '=', 1)->count();
    if ($requisicion_totales_conteo == $requisicion_totales_suma) {
      $requisicion = Models\requisicion_folio::where('requisicion', '=', $requisicion_partidas->requisicion)->first();
      $requisicion->estatus = "COTIZACION APROBADA";
      $requisicion->save();
    }

    return back()->with('mensaje', '¡Partida aprobada con el proveedor: ' . $requisicion_partidas->proveedor . ' con exito!');
  }
  public function home_cotizacion_aprobacion_dos($requisicion_partida)
  {
    $requisicion_partidas = Models\requisicion_partida::where('id', '=', $requisicion_partida)->first();
    $requisicion_partidas->precio_unitario = $requisicion_partidas->pu_dos;
    $requisicion_partidas->proveedor = $requisicion_partidas->prov_dos;
    $requisicion_partidas->pu_aprobado = 1;
    $requisicion_partidas->save();

    $requisicion_totales_conteo = Models\requisicion_partida::where('requisicion', '=', $requisicion_partidas->requisicion)->count();
    $requisicion_totales_suma = Models\requisicion_partida::where('requisicion', '=', $requisicion_partidas->requisicion)->where('pu_aprobado', '=', 1)->count();
    if ($requisicion_totales_conteo == $requisicion_totales_suma) {
      $requisicion = Models\requisicion_folio::where('requisicion', '=', $requisicion_partidas->requisicion)->first();
      $requisicion->estatus = "COTIZACION APROBADA";
      $requisicion->save();
    }


    return back()->with('mensaje', '¡Partida aprobada con el proveedor: ' . $requisicion_partidas->proveedor . ' con exito!');
  }
  public function home_cotizacion_aprobacion_tres($requisicion_partida)
  {
    $requisicion_partidas = Models\requisicion_partida::where('id', '=', $requisicion_partida)->first();
    $requisicion_partidas->precio_unitario = $requisicion_partidas->pu_tres;
    $requisicion_partidas->proveedor = $requisicion_partidas->prov_tres;
    $requisicion_partidas->pu_aprobado = 1;
    $requisicion_partidas->save();

    $requisicion_totales_conteo = Models\requisicion_partida::where('requisicion', '=', $requisicion_partidas->requisicion)->count();
    $requisicion_totales_suma = Models\requisicion_partida::where('requisicion', '=', $requisicion_partidas->requisicion)->where('pu_aprobado', '=', 1)->count();
    if ($requisicion_totales_conteo == $requisicion_totales_suma) {
      $requisicion = Models\requisicion_folio::where('requisicion', '=', $requisicion_partidas->requisicion)->first();
      $requisicion->estatus = "COTIZACION APROBADA";
      $requisicion->save();
    }
    return back()->with('mensaje', '¡Partida aprobada con el proveedor: ' . $requisicion_partidas->proveedor . ' con exito!');
  }

  public function dashboard_material_cliente()
  {

    $clientes = models\cliente::all();
    $material_cliente = models\material_clientes::all();
    return view('sistema_oc.almacen.cliente.dashboard_material_cliente', compact('clientes', 'material_cliente'));
  }
  public function dashboard_material_cliente_in(Request $request)
  {

    $fecha = Carbon::now();
    $clientes = models\cliente::all();
    $material_cliente =  new models\material_clientes();
    $material_cliente->cliente = $request->cliente;

    $material_cliente->ot = $request->ot_salida;
    $material_cliente->descripcion = $request->descripcion;
    $material_cliente->cantidad = $request->cantidad;
    $material_cliente->folio = $request->folio;
    $material_cliente->partida = $request->folio . '-' . $request->partida;
    $material_cliente->estatus = "EN ALMACEN";
    $material_cliente->usuario_recepcion = Auth::user()->name;
    $material_cliente->fecha_recepcion = $fecha;
    $material_cliente->usuario_salida = "N/A";
    $material_cliente->fecha_salida = "N/A";
    $material_cliente->save();

    $cliente = substr($material_cliente->cliente, 0, 3);




    $codigo = $cliente . ' ' . $material_cliente->partida;
    return view('barcode', compact('codigo'));
  }

  public function dashboard_material_cliente_out(Request $request)
  {

    $fecha = Carbon::now();

    $material_cliente = models\material_clientes::where('id', '=', $request->id)->first();
    $material_cliente->usuario_salida = $request->usuario_salida;
    $material_cliente->fecha_salida = $fecha;
    $material_cliente->ot = $request->ot_salida;
    $material_cliente->estatus = "ENTREGADO A USUARIO";
    $material_cliente->save();


    return back()->with('mensaje', '¡Material del cliente registrado!');
  }

  public function exportar_material(Request $request)
  {
    $c = $request->cliente;
    return Excel::download(new Material($request->cliente), 'CLIENTE(' . $c . ').xlsx');
  }

  public function reporte_salida($material)
  {

    $material_cliente = models\material_clientes::where('id', '=', $material)->first();
    $salidas = models\calidadsalida::where('ot', '=', $material_cliente->ot)->get();
    return view('sistema_oc.almacen.cliente.dashboard_material_historial', compact('salidas'));
  }

  public function reporte_salidas_cliente(Request $request)
  {
    $c = $request->cliente;
    return Excel::download(new Salida($request->cliente), 'CLIENTE(' . $c . ').xlsx');
  }
}
