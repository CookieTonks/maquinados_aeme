  <?php

  use App\Http\Controllers\direccion_controlador;
  use App\Http\Controllers\UserController;
  use App\Http\Middleware;
  use App\Models;
  use Illuminate\Support\Facades\Route;
  use Illuminate\Http\Request;
  use Carbon\Carbon;
  use PhpParser\Node\Stmt\ElseIf_;
  use Barryvdh\DomPDF\Facade as PDF;

  Auth::routes();

  //Rutas de inicio y por default
  Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
  Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  //Rutas de prueba para las pruebas de whatsapp
  Route::get('/whats', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
  Route::post('/whats', [App\Http\Controllers\HomeController::class, 'store_dos'])->name('store_dos');

  //Rutas sistema OT
  Route::get('/home_sistema_ot', [App\Http\Controllers\ot_controlador::class, 'index'])->name('home_sistema_ot')->middleware('usuarios_sistema_ot');
  Route::post('/home_sistema_ot', [App\Http\Controllers\ot_controlador::class, 'alta_ot'])->name('alta_ot')->middleware('usuarios_sistema_ot');
  Route::get('/home_buscador_sistema_ot', [App\Http\Controllers\ot_controlador::class, 'home_buscador_sistema_ot'])->name('home_buscador_sistema_ot')->middleware('usuarios_sistema_ot');

  Route::get('/pdf/{id}', function ($id) {
    $datos = Models\datamain::findOrFail($id);
    $mostrar = Models\datamain::where('id', '=', $id)->get();
    foreach ($mostrar as $key) {
      $cadena = $key->proceso;
      $array = explode(",", $cadena);
    }

    $contador = count($array);
    $linea_uno = 0;
    $linea_dos = 0;
    $linea_tres = 0;

    if ($contador >= 0 && $contador <= 4) {
      $linea_uno = 1;
    } elseif ($contador >= 4 && $contador <= 6) {
      $linea_uno = 2;
    } elseif ($contador >= 6 && $contador <= 12) {
      $linea_uno = 3;
    }
    $contador = $contador - 1;
    $pdf = PDF::loadView('sistema_ot.plantillaPDF', compact('datos', 'array', 'contador', 'linea_uno'));
    return $pdf->stream($datos->orden_trabajo . '.pdf');
  })->name('pdf');

  Route::get('/info_ot/{id}', [App\Http\Controllers\ot_controlador::class, 'info_ot'])->name('info_ot')->middleware('usuarios_sistema_ot');
  Route::get('/edit_ot/{id}', [App\Http\Controllers\ot_controlador::class, 'edit_ot'])->name('edit_ot')->middleware('usuarios_sistema_ot');
  Route::put('/edit_ot/{id}', [App\Http\Controllers\ot_controlador::class, 'edit_ot_update'])->name('edit_ot_update')->middleware('usuarios_sistema_ot');
  Route::get('/factura_remision/{id}', [App\Http\Controllers\ot_controlador::class, 'factura_remision'])->name('factura_remision')->middleware('usuarios_sistema_ot');
  Route::get('/home_remisiones', [App\Http\Controllers\ot_controlador::class, 'home_remisiones'])->name('home_remisiones')->middleware('usuarios_sistema_embarques');


  //Rutas para la alta y edicion de los usuarios
  Route::get('/home_usuarios/', [App\Http\Controllers\ot_controlador::class, 'home_usuarios'])->name('home_usuarios')->middleware('usuarios_sistema_ot');
  Route::post('/home_usuarios/', [App\Http\Controllers\ot_controlador::class, 'home_usuarios_registro'])->name('home_usuarios_registro')->middleware('usuarios_sistema_ot');
  Route::get('/editar_usuarios/{id}', [App\Http\Controllers\ot_controlador::class, 'editar_usuario'])->name('editar_usuario')->middleware('usuarios_sistema_ot');
  Route::put('/editar_usuarios/{id}', [App\Http\Controllers\ot_controlador::class, 'editar_usuario_registro'])->name('editar_usuario_registro')->middleware('usuarios_sistema_ot');
  Route::get('/eliminar_usuarios/{id}', [App\Http\Controllers\ot_controlador::class, 'eliminar_usuario'])->name('eliminar_usuario')->middleware('usuarios_sistema_ot');
  Route::get('/home_ruta_ot/{id}', [App\Http\Controllers\ot_controlador::class, 'home_rutas_ot'])->name('home_rutas_ot')->middleware('usuarios_sistema_ot');

  //Rutas para la alta de los clientes (Empresas)
  Route::get('/home_clientes/', [App\Http\Controllers\ot_controlador::class, 'home_clientes'])->name('home_clientes')->middleware('usuarios_sistema_ot');
  Route::post('/home_clientes', [App\Http\Controllers\ot_controlador::class, 'home_clientes_registro'])->name('home_clientes_registro')->middleware('usuarios_sistema_ot');

  //Rutas de produccion
  Route::get('/home_produccion_modulo/', [App\Http\Controllers\produccion_controlador::class, 'produccion_liberacion'])->name('produccion_liberacion')->middleware('usuarios_sistema_produccion');
  Route::post('/home_produccion_entrada_piso/', [App\Http\Controllers\produccion_controlador::class, 'produccion_entrada_piso'])->name('produccion_entrada_piso')->middleware('usuarios_sistema_produccion');
  Route::post('/home_produccion_salida_piso/', [App\Http\Controllers\produccion_controlador::class, 'produccion_salida_piso'])->name('produccion_salida_piso')->middleware('usuarios_sistema_produccion');
  Route::post('/produccion_salida_parcial/', [App\Http\Controllers\produccion_controlador::class, 'produccion_salida_parcial'])->name('produccion_salida_parcial')->middleware('usuarios_sistema_produccion');


  Route::get('/home_produccion/', [App\Http\Controllers\produccion_controlador::class, 'index'])->name('home_produccion')->middleware('usuarios_sistema_produccion');
  Route::get('/home_produccion_programacion/', [App\Http\Controllers\produccion_controlador::class, 'home_produccion_programacion'])->name('home_produccion_programacion')->middleware('usuarios_sistema_produccion');
  Route::get('/liberacion_ot/{id}', [App\Http\Controllers\produccion_controlador::class, 'liberacion_ot'])->name('liberacion_ot')->middleware('usuarios_sistema_produccion');
  Route::get('/entrada_material_cliente/{id}', [App\Http\Controllers\produccion_controlador::class, 'entrada_material_cliente'])->name('entrada_material_cliente')->middleware('usuarios_sistema_produccion');
  Route::get('/edit_produccion/{id}', [App\Http\Controllers\produccion_controlador::class, 'edit_produccion'])->name('edit_produccion')->middleware('usuarios_sistema_produccion');
  Route::put('/edit_produccion/{id}', [App\Http\Controllers\produccion_controlador::class, 'update_produccion'])->name('update_produccion')->middleware('usuarios_sistema_produccion');
  Route::get('/ver_produccion_ot/{id}', [App\Http\Controllers\produccion_controlador::class, 'ver_produccion_ot'])->name('ver_produccion_ot')->middleware('usuarios_sistema_produccion');
  Route::get('/baja_produccion/{id}', [App\Http\Controllers\produccion_controlador::class, 'bajaproduccion'])->name('bajaproduccion')->middleware('usuarios_sistema_produccion');
  Route::post('/exportar_produccion/', [App\Http\Controllers\produccion_controlador::class, 'exportar_produccion'])->name('exportar_produccion')->middleware('usuarios_sistema_produccion');

  //Rutas de compras
  Route::get('/dashboard_compras/', [App\Http\Controllers\compras_controlador::class, 'dashboard_compras'])->name('dashboard_compras');
  Route::get('/home_ordenes_compras/', [App\Http\Controllers\compras_controlador::class, 'index'])->name('home_ordenes_compras')->middleware('usuarios_sistema_compras');
  Route::post('/home_ordenes_compras/', [App\Http\Controllers\compras_controlador::class, 'alta_ocompra'])->name('alta_ocompra')->middleware('usuarios_sistema_compras');
  Route::get('/exportar_compras/', [App\Http\Controllers\compras_controlador::class, 'exportar_compras'])->name('exportar_compras')->middleware('usuarios_sistema_compras');
  Route::get('/actualizacion_fecha_compras/', [App\Http\Controllers\compras_controlador::class, 'actualizacion_fecha_compras'])->name('actualizacion_fecha_compras')->middleware('usuarios_sistema_compras');
  Route::get('/orden_compra_ver/{id}', [App\Http\Controllers\compras_controlador::class, 'ver_ocompra'])->name('ver_ocompra')->middleware('usuarios_sistema_compras');
  Route::put('/orden_compra_ver/{id}', [App\Http\Controllers\compras_controlador::class, 'edit_ocompra'])->name('edit_ocompra')->middleware('usuarios_sistema_compras');
  Route::get('/pdf_orden_compra/{id}', [App\Http\Controllers\compras_controlador::class, 'pdf_orden_compra'])->name('pdf_orden_compra')->middleware('usuarios_sistema_compras');
  Route::post('/pdf_orden_compra/{id}', [App\Http\Controllers\compras_controlador::class, 'alta_pdf_orden_compra'])->name('alta_pdf_orden_compra')->middleware('usuarios_sistema_compras');
  Route::get('/orden_compra_liberacion/{id}', [App\Http\Controllers\compras_controlador::class, 'liberacion_oc'])->name('liberacion_oc')->middleware('usuarios_sistema_compras');
  Route::delete('/orden_compra/{id}', [App\Http\Controllers\compras_controlador::class, 'baja_ocompra'])->name('baja_ocompra')->middleware('usuarios_sistema_compras');

  Route::get('/home_pago_ordenes_compras/', [App\Http\Controllers\compras_controlador::class, 'home_pago_compras'])->name('home_pago_compras')->middleware('usuarios_sistema_compras');
  Route::post('/home_pago_ordenes_compras/', [App\Http\Controllers\compras_controlador::class, 'alta_pago_compras'])->name('alta_pago_compras')->middleware('usuarios_sistema_compras');
  Route::get('/pdf_remision/{id}', function ($id, request $request) {



    $datos  =  Models\datamain::where('id', '=', $id)->first();
    $cliente = Models\cliente::where('nombre', '=', $datos->cliente)->first();
    $numero_remision = $cliente->ultima_remision + 1;
    $cliente->ultima_remision = $numero_remision;
    $cliente->save();
    $date = Carbon::now();
    $date->format('d-m-Y');

    if ($datos->factura_remision == 'N/A') {
      $datos->factura_remision = $numero_remision;
      $datos->estatus = '100';
      $datos->fecha_entrega_real = $date;
      $datos->save();

      //Registro de aerea en rutas
      $date = Carbon::now();
      $aeme_registro = new Models\aeme_registro;
      $aeme_registro->ot = $datos->ot;
      $aeme_registro->area = 'EMBARQUES';
      $aeme_registro->personal = Auth::user()->name;
      $aeme_registro->hora = $date;
      $aeme_registro->save();
    }
    $observaciones = $request->observaciones;
    $pieza = $request->factura_remision;
    $pdf = PDF::loadView('sistema_ot/factura_pdf', compact('observaciones', 'datos', 'cliente', 'date', 'pieza'));
    return $pdf->stream();
  })->name('pdf_remision');

  //Rutas para la alta y edicion de proveedores
  Route::get('/home_proveedores/', [App\Http\Controllers\compras_controlador::class, 'home_proveedores'])->name('home_proveedores')->middleware('usuarios_sistema_compras');
  Route::post('/home_proveedores/', [App\Http\Controllers\compras_controlador::class, 'alta_proveedores'])->name('alta_proveedores')->middleware('usuarios_sistema_compras');
  Route::get('/proveedores_edit/{id}', [App\Http\Controllers\compras_controlador::class, 'edit_proveedores'])->name('edit_proveedores')->middleware('usuarios_sistema_compras');
  Route::put('/proveedores_edit/{id}', [App\Http\Controllers\compras_controlador::class, 'update_proveedores'])->name('update_proveedores')->middleware('usuarios_sistema_compras');

  //Rutas para asignacion de OC y requisiciones
  Route::get('/home_compras_pendientes/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_pendientes'])->name('home_requisiciones_pendientes')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones'])->name('home_requisiciones')->middleware('usuarios_sistema_compras');
  Route::post('/home_requisiciones/', [App\Http\Controllers\compras_controlador::class, 'alta_requisiciones'])->name('alta_requisiciones')->middleware('usuarios_sistema_compras');
  Route::get('/partidas/{id}', [App\Http\Controllers\compras_controlador::class, 'partidas'])->name('partidas')->middleware('usuarios_sistema_compras');
  Route::get('/partidas/{id}', [App\Http\Controllers\compras_controlador::class, 'partidas'])->name('partidas')->middleware('usuarios_sistema_compras');
  Route::post('/delete_partida_requisicion/', [App\Http\Controllers\compras_controlador::class, 'delete_partida_requisicion'])->name('delete_partida_requisicion');
  Route::post('/edicion_partida_requisicion/', [App\Http\Controllers\compras_controlador::class, 'edicion_partida_requisicion'])->name('edicion_partida_requisicion');
  Route::post('/edicion_partida_requisicion_cotizaciones/', [App\Http\Controllers\compras_controlador::class, 'edicion_partida_requisicion_cotizaciones'])->name('edicion_partida_requisicion_cotizaciones');
  Route::put('/partidas/{id}', [App\Http\Controllers\compras_controlador::class, 'alta_partidas'])->name('alta_partidas')->middleware('usuarios_sistema_compras');
  Route::get('/asignar_oc/', [App\Http\Controllers\compras_controlador::class, 'asignar_oc'])->name('asignar_oc')->middleware('usuarios_sistema_compras');
  route::get('/pdf_herramienta/{id}', function ($id) {
    $subtotal = 0;
    $date = Carbon::now();
    $requisicion = Models\requisicion_folio::findOrFail($id);
    $proveedor = Models\proveedore::where('Rsocial', '=', $requisicion->proveedor)->first();

    $partida = Models\requisicion_partida::where('requisicion_partidas.requisicion', '=', $requisicion->requisicion)
      ->where('requisicion_partidas.proveedor', '=', $requisicion->proveedor)
      ->get();

    foreach ($partida as $item) {
      $subtotal = $subtotal + ($item->cantidad * $item->precio_unitario);
    }
    $tipo_partida = Models\requisicion_partida::where('requisicion', '=', $requisicion->requisicion)->get();
    foreach ($tipo_partida as $tipo_partida) {
      $tipo_partida->tipo_requisicion  = 'HERRAMIENTA';
      $tipo_partida->save();
    }

    $orden_compra = Models\ocompra::where('Codigo', '=', $requisicion->orden_compra)->first();
    $orden_compra->Disponibilidad = 'OCUPADA';
    $orden_compra->save();

    $requisicion->estatus = "PENDIENTE POR RECIBIR";
    $requisicion->save();

    $pdf = PDF::loadView('sistema_oc.requisiciones.pdf_herramienta', compact('partida', 'subtotal', 'proveedor', 'partida', 'requisicion', 'date', 'orden_compra'));
    return $pdf->stream();
  })->name('pdf_herramienta')->middleware('usuarios_sistema_compras');

  route::get('/pdf_material/{id}', function ($id) {
    $subtotal = 0;
    $date = Carbon::now();
    $requisicion = Models\requisicion_folio::findOrFail($id);
    $proveedor = Models\proveedore::where('Rsocial', '=', $requisicion->proveedor)->first();
    $partida = DB::table('requisicion_partidas')
      ->join('datamains', 'requisicion_partidas.ot', '=', 'datamains.orden_trabajo')
      ->where('requisicion_partidas.proveedor', '=', $requisicion->proveedor)
      ->where('requisicion_partidas.requisicion', '=', $requisicion->requisicion)
      ->select('requisicion_partidas.*', 'datamains.supervisor', 'datamains.user')->get();



    foreach ($partida as $item) {
      $subtotal = $subtotal + ($item->cantidad * $item->precio_unitario);
      $origin = date_create($item->created_at);
      $target = date_create($date);
      $interval = date_diff($origin, $target);
      $dias = $interval->format('%a');

      $compras_ruta = Models\compras_ruta::where('ot', '=', $item->ot)->exists();
      if ($compras_ruta == True) {
        $compras_ruta_registro = Models\compras_ruta::where('ot', '=', $item->ot)->first();
        $compras_ruta_registro->compras_requisicion = "DONE";
        $compras_ruta_registro->compras_oc = "DONE";
        $compras_ruta_registro->save();

        $compras_registro = new Models\compras_registro;
        $compras_registro->ot = $item->ot;
        $compras_registro->area = "REQUISICION";
        $compras_registro->personal = Auth::user()->name;
        $compras_registro->hora = $date;
        $compras_registro->save();

        $compras_registro = new Models\compras_registro;
        $compras_registro->ot = $item->ot;
        $compras_registro->area = "COMPRAS";
        $compras_registro->personal = Auth::user()->name;
        $compras_registro->hora = $date;
        $compras_registro->save();
      }
    }

    $tipo_partida = Models\requisicion_partida::where('requisicion', '=', $requisicion->requisicion)->get();
    foreach ($tipo_partida as $tipo_partida) {
      $tipo_partida->tipo_requisicion  = 'MATERIAL';
      $tipo_partida->save();
    }


    $orden_compra = Models\ocompra::where('Codigo', '=', $requisicion->orden_compra)->first();
    $orden_compra->Disponibilidad = 'OCUPADA';
    $orden_compra->save();

    $requisicion->estatus = "PENDIENTE POR RECIBIR";
    $requisicion->save();
    $pdf = PDF::loadView('sistema_oc.requisiciones.pdf_material', compact('subtotal', 'proveedor', 'partida', 'requisicion', 'date', 'orden_compra'));
    return $pdf->stream();
  })->name('pdf_material')->middleware('usuarios_sistema_compras');


  Route::get('/home_partidas/', [App\Http\Controllers\compras_controlador::class, 'home_partidas'])->name('home_partidas')->middleware('usuarios_sistema_compras');
  Route::get('/partidas_edit/{id}', [App\Http\Controllers\compras_controlador::class, 'partidas_edit'])->name('partidas_edit')->middleware('usuarios_sistema_compras');
  Route::put('/partidas_edit/{id}', [App\Http\Controllers\compras_controlador::class, 'partidas_update'])->name('partidas_update')->middleware('usuarios_sistema_compras');


  //Rutas para las requisiciones del usuario
  Route::get('/home_requisiciones_usuario/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_usuario'])->name('home_requisiciones_usuario');
  Route::post('/home_requisiciones_usuario/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_usuario_registro'])->name('home_requisiciones_usuario_registro');
  Route::get('/home_requisiciones_usuario_partida/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_usuario_partida'])->name('home_requisiciones_usuario_partida');
  Route::put('/home_requisiciones_usuario_partida/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_usuario_partida_registro'])->name('home_requisiciones_usuario_partida_registro');
  Route::get('/home_requisiciones_usuario_partida_delete/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_usuario_partida_delete'])->name('home_requisiciones_usuario_partida_delete');
  Route::get('/home_requisiciones_usuario_compra/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_usuario_compras'])->name('home_requisiciones_usuario_compras');


  //Rutas para las requisiciones del usuario desde compras
  Route::get('/home_requisiciones_compras_pendientes/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_pendientes'])->name('home_requisiciones_compras_pendientes')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_historico/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_historico'])->name('home_requisiciones_compras_historico')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_historico_regreso/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_historico_regreso'])->name('home_requisiciones_compras_historico_regreso')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_historico_regreso_usuario/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_historico_regreso_usuario'])->name('home_requisiciones_compras_historico_regreso_usuario')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_historico_cancelar/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_historico_cancelar'])->name('home_requisiciones_compras_historico_cancelar')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_historico_aprobacion/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_historico_aprobacion'])->name('home_requisiciones_compras_historico_aprobacion')->middleware('usuarios_sistema_compras');

  Route::get('/home_requisiciones_compras_cambio/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_cambio'])->name('home_requisiciones_compras_cambio')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_partidas/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_partidas'])->name('home_requisiciones_compras_partidas')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_partidas_edicion/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_partidas_edicion'])->name('home_requisiciones_compras_partidas_edicion')->middleware('usuarios_sistema_compras');
  Route::get('/home_requisiciones_compras_pendientes/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_pendientes'])->name('home_requisiciones_compras_pendientes')->middleware('usuarios_sistema_compras');
  Route::post('/home_requisiciones_compras_cotizacion_uno/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_cotizacion_uno'])->name('home_requisiciones_compras_cotizacion_uno')->middleware('usuarios_sistema_compras');
  Route::post('/home_requisiciones_compras_cotizacion_dos/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_cotizacion_dos'])->name('home_requisiciones_compras_cotizacion_dos');
  Route::post('/home_requisiciones_compras_cotizacion_tres/', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_cotizacion_tres'])->name('home_requisiciones_compras_cotizacion_tres')->middleware('usuarios_sistema_compras');
  Route::post('/home_requisiciones_compras_cotizaciones_enviar/{id}', [App\Http\Controllers\compras_controlador::class, 'home_requisiciones_compras_cotizaciones_enviar'])->name('home_requisiciones_compras_cotizaciones_enviar')->middleware('usuarios_sistema_compras');
  Route::post('/entrada_material_compras/', [App\Http\Controllers\compras_controlador::class, 'entrada_material_compras'])->name('entrada_material_compras');

  Route::get('/home_cotizaciones_aprobacion/{id}', [App\Http\Controllers\compras_controlador::class, 'home_cotizaciones_aprobacion'])->name('home_cotizaciones_aprobacion');
  Route::get('/home_cotizacion_aprobacion_uno/{requisicion}/', [App\Http\Controllers\compras_controlador::class, 'home_cotizacion_aprobacion_uno'])->name('home_cotizacion_aprobacion_uno');
  Route::get('/home_cotizacion_aprobacion_dos/{requisicion}/', [App\Http\Controllers\compras_controlador::class, 'home_cotizacion_aprobacion_dos'])->name('home_cotizacion_aprobacion_dos');
  Route::get('/home_cotizacion_aprobacion_tres/{requisicion}/', [App\Http\Controllers\compras_controlador::class, 'home_cotizacion_aprobacion_tres'])->name('home_cotizacion_aprobacion_tres');


  Route::get('/home_recepcion_material/', [App\Http\Controllers\compras_controlador::class, 'home_recepcion_material'])->name('home_recepcion_material')->middleware('usuarios_sistema_almacen');
  Route::get('/home_material_historico/', [App\Http\Controllers\compras_controlador::class, 'home_material_historico'])->name('home_material_historico')->middleware('usuarios_sistema_almacen');
  Route::post('/home_salida_material/', [App\Http\Controllers\compras_controlador::class, 'salida_material_registro'])->name('salida_material_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/home_recepcion_herramienta/', [App\Http\Controllers\compras_controlador::class, 'home_recepcion_herramienta'])->name('home_recepcion_herramienta')->middleware('usuarios_sistema_almacen');
  Route::post('/home_recepcion_herramienta_registro/', [App\Http\Controllers\compras_controlador::class, 'home_recepcion_herramienta_registro'])->name('home_recepcion_herramienta_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/home_salida_herramienta/', [App\Http\Controllers\compras_controlador::class, 'home_salida_herramienta'])->name('home_salida_herramienta')->middleware('usuarios_sistema_almacen');
  Route::post('/home_salida_herramienta_registro/', [App\Http\Controllers\compras_controlador::class, 'home_salida_herramienta_registro'])->name('home_salida_herramienta_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/home_retorno_herramienta/{id}', [App\Http\Controllers\compras_controlador::class, 'home_retorno_herramienta'])->name('home_retorno_herramienta')->middleware('usuarios_sistema_almacen');

  //Prueba de recepcion de material
  Route::get('/home_inventario_folio/', [App\Http\Controllers\compras_controlador::class, 'home_inventario_folio'])->name('home_inventario_folio');
  Route::post('/home_inventario_folio/', [App\Http\Controllers\compras_controlador::class, 'home_inventario_folio_registro'])->name('home_inventario_folio_registro');
  Route::get('/home_inventario_partidas/{id}', [App\Http\Controllers\compras_controlador::class, 'home_inventario_partidas'])->name('home_inventario_partidas');
  Route::post('/home_inventario_partidas_registro/', [App\Http\Controllers\compras_controlador::class, 'home_inventario_partidas_registro'])->name('home_inventario_partidas_registro');
  Route::get('/delete_inventario_partidas_registro/{id}', [App\Http\Controllers\compras_controlador::class, 'delete_inventario_partidas_registro'])->name('delete_inventario_partidas_registro');
  Route::get('/registro_folio_partidas_inventario/{id}', [App\Http\Controllers\compras_controlador::class, 'registro_folio_partidas_inventario'])->name('registro_folio_partidas_inventario');
  Route::get('/home_salida_material/', [App\Http\Controllers\compras_controlador::class, 'home_salida_material'])->name('home_salida_material')->middleware('usuarios_sistema_almacen');
  Route::post('/salida_material_usuario_barcode/', [App\Http\Controllers\compras_controlador::class, 'salida_material_usuario_barcode'])->name('salida_material_usuario_barcode');
  Route::post('/salida_material_gallinero_barcode/', [App\Http\Controllers\compras_controlador::class, 'salida_material_gallinero_barcode'])->name('salida_material_gallinero_barcode');


  //Barcode general para OT y para partidas (Material y herramienta)
  Route::get('/barcode/{id}', [App\Http\Controllers\compras_controlador::class, 'barcode'])->name('barcode');


  Route::get('/home_almacen/', [App\Http\Controllers\compras_controlador::class, 'home_almacen'])->name('home_almacen')->middleware('usuarios_sistema_almacen');
  Route::get('/almacen_alta_material/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_alta_material'])->name('almacen_alta_material')->middleware('usuarios_sistema_almacen');
  Route::post('/almacen_alta_material/', [App\Http\Controllers\compras_controlador::class, 'almacen_alta_material_registro'])->name('almacen_alta_material_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/almacen_baja_material/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_baja_material'])->name('almacen_baja_material')->middleware('usuarios_sistema_almacen');
  Route::post('/almacen_baja_material/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_baja_material_registro'])->name('almacen_baja_material_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/almacen_alta_herramienta/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_alta_herramienta'])->name('almacen_alta_herramienta')->middleware('usuarios_sistema_almacen');
  Route::post('/almacen_alta_herramienta/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_alta_herramienta_registro'])->name('almacen_alta_herramienta_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/almacen_baja_herramienta/', [App\Http\Controllers\compras_controlador::class, 'almacen_baja_herramienta'])->name('almacen_baja_herramienta')->middleware('usuarios_sistema_almacen');
  Route::post('/almacen_baja_herramienta/', [App\Http\Controllers\compras_controlador::class, 'almacen_baja_herramienta_registro'])->name('almacen_baja_herramienta_registro')->middleware('usuarios_sistema_almacen');
  Route::get('/almacen_certificado/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_certificado'])->name('almacen_certificado')->middleware('usuarios_sistema_almacen');
  Route::post('/almacen_certificado/{id}', [App\Http\Controllers\compras_controlador::class, 'almacen_certificado_registro'])->name('almacen_certificado_registro')->middleware('usuarios_sistema_almacen');

  Route::get('/home_inventario/', [App\Http\Controllers\compras_controlador::class, 'home_inventario'])->name('home_inventario')->middleware('usuarios_sistema_almacen');
  Route::post('/home_inventario/', [App\Http\Controllers\compras_controlador::class, 'alta_inventario'])->name('alta_inventario')->middleware('usuarios_sistema_almacen');

  Route::get('/inventario_edit/{id}', [App\Http\Controllers\compras_controlador::class, 'inventario_edit'])->name('inventario_edit')->middleware('usuarios_sistema_almacen');
  Route::post('/inventario_edit/{id}', [App\Http\Controllers\compras_controlador::class, 'inventario_edit_registro'])->name('inventario_edit_registro')->middleware('usuarios_sistema_almacen');

  Route::get('/home_administracion_compras/', [App\Http\Controllers\compras_controlador::class, 'home_administracion_compras'])->name('home_administracion_compras')->middleware('usuarios_sistema_compras_master');
  Route::get('/rutas_administracion_compras/{id}/', [App\Http\Controllers\compras_controlador::class, 'rutas_administracion_compras'])->name('rutas_administracion_compras')->middleware('usuarios_sistema_compras_master');


  //Recepcion de material del cliente

  Route::get('/dashboard_material_cliente/', [App\Http\Controllers\compras_controlador::class, 'dashboard_material_cliente'])->name('dashboard_material_cliente');
  Route::post('/dashboard_material_cliente/', [App\Http\Controllers\compras_controlador::class, 'dashboard_material_cliente_in'])->name('dashboard_material_cliente_in');

  Route::post('/dashboard_material_cliente_out/', [App\Http\Controllers\compras_controlador::class, 'dashboard_material_cliente_out'])->name('dashboard_material_cliente_out');
  Route::post('/exportar_material/', [App\Http\Controllers\compras_controlador::class, 'exportar_material'])->name('exportar_material');
  Route::post('/reporte_salidas_cliente/', [App\Http\Controllers\compras_controlador::class, 'reporte_salidas_cliente'])->name('reporte_salidas_cliente');

  Route::get('/reporte_cliente/{id}',  [App\Http\Controllers\compras_controlador::class, 'reporte_cliente'])->name('reporte_cliente');


  //Rutas de embarques
  Route::get('/home_embarques/', [App\Http\Controllers\embarques_controlador::class, 'home_embarques'])->name('home_embarques')->middleware('usuarios_sistema_embarques');
  Route::put('/home_embarques/', [App\Http\Controllers\embarques_controlador::class, 'recepcion_embarques_ot'])->name('recepcion_embarques_ot')->middleware('usuarios_sistema_embarques');
  Route::post('/factura_entrega_pdf/', [App\Http\Controllers\embarques_controlador::class, 'factura_entrega_pdf'])->name('factura_entrega_pdf')->middleware('usuarios_sistema_embarques');
  Route::post('/entrega_remision_pdf/', [App\Http\Controllers\embarques_controlador::class, 'entrega_remision_pdf'])->name('entrega_remision_pdf')->middleware('usuarios_sistema_embarques');
  Route::post('/salida_tratamiento_pdf/', [App\Http\Controllers\embarques_controlador::class, 'salida_tratamiento_pdf'])->name('salida_tratamiento_pdf')->middleware('usuarios_sistema_embarques');

  Route::get('/home_regreso_tratamiento/', [App\Http\Controllers\embarques_controlador::class, 'home_regreso_tratamiento'])->name('home_regreso_tratamiento')->middleware('usuarios_sistema_embarques');
  Route::post('/tratamiento_calidad/', [App\Http\Controllers\embarques_controlador::class, 'tratamiento_calidad'])->name('tratamiento_calidad')->middleware('usuarios_sistema_embarques');
  Route::post('/tratamiento_produccion/', [App\Http\Controllers\embarques_controlador::class, 'tratamiento_producccion'])->name('tratamiento_producccion')->middleware('usuarios_sistema_embarques');
  Route::post('/tratamiento_produccion/', [App\Http\Controllers\embarques_controlador::class, 'tratamiento_producccion'])->name('tratamiento_producccion')->middleware('usuarios_sistema_embarques');
  Route::post('/home_remisiones_registro/', [App\Http\Controllers\embarques_controlador::class, 'home_remisiones_registro'])->name('home_remisiones_registro')->middleware('usuarios_sistema_embarques');

  Route::get('/buscador_embarques/', [App\Http\Controllers\embarques_controlador::class, 'buscador_embarques'])->name('buscador_embarques')->middleware('usuarios_sistema_embarques');


  // Route::get('/registro_regreso_tratamiento/{id}', [App\Http\Controllers\embarques_controlador::class, 'registro_regreso_tratamiento'])->name('registro_regreso_tratamiento')->middleware('usuarios_sistema_embarques');

  Route::get('/home_ingreso_rechazo/', [App\Http\Controllers\embarques_controlador::class, 'home_ingreso_rechazo'])->name('home_ingreso_rechazo')->middleware('usuarios_sistema_embarques');
  Route::put('/home_ingreso_rechazo/', [App\Http\Controllers\embarques_controlador::class, 'registro_ingreso_rechazo'])->name('registro_ingreso_rechazo')->middleware('usuarios_sistema_embarques');



  Route::controller(direccion_controlador::class)->group(function () {
    Route::get('home_direccion', 'index');
    Route::post('home_direccionAjax', 'ajax')->name('home_direccion')->middleware('usuarios_sistema_direccion');
  });
  //Rutas de facturacion
  Route::get('/home_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'home_facturacion'])->name('home_facturacion')->middleware('usuarios_sistema_facturacion');
  Route::post('/home_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'home_facturacion_registro'])->name('home_facturacion_registro')->middleware('usuarios_sistema_facturacion_master');
  Route::post('/home_facturacion_pago/', [App\Http\Controllers\facturacion_controlador::class, 'estatus_factura_pagada'])->name('estatus_factura_pagada')->middleware('usuarios_sistema_facturacion');
  Route::get('/edit_facturacion/{id}', [App\Http\Controllers\facturacion_controlador::class, 'edit_facturacion'])->name('edit_facturacion')->middleware('usuarios_sistema_facturacion_master');
  Route::put('/edit_facturacion/{id}', [App\Http\Controllers\facturacion_controlador::class, 'edit_facturacion_registro'])->name('edit_facturacion_registro')->middleware('usuarios_sistema_facturacion_master');
  Route::get('/refacturacion/{id}',  [App\Http\Controllers\facturacion_controlador::class, 'refacturacion'])->name('refacturacion')->middleware('usuarios_sistema_facturacion_master');

  Route::put('/refacturacion/{id}', [App\Http\Controllers\facturacion_controlador::class, 'refacturacion_registro'])->name('refacturacion_registro')->middleware('usuarios_sistema_facturacion_master');



  Route::get('/home_comisiones/', [App\Http\Controllers\facturacion_controlador::class, 'home_comisiones'])->name('home_comisiones')->middleware('usuarios_sistema_comisiones');
  Route::post('/reporte_comisiones/', [App\Http\Controllers\facturacion_controlador::class, 'reporte_comisiones'])->name('reporte_comisiones')->middleware('usuarios_sistema_comisiones');
  Route::post('/actualizar_dolar/', [App\Http\Controllers\facturacion_controlador::class, 'actualizar_dolar'])->name('actualizar_dolar')->middleware('usuarios_sistema_comisiones');
  Route::post('/comprobante_pago_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'comprobante_pago_facturacion'])->name('comprobante_pago_facturacion')->middleware('usuarios_sistema_comisiones');

  Route::post('/estatus_factura_cancelada', [App\Http\Controllers\facturacion_controlador::class, 'estatus_factura_cancelada'])->name('estatus_factura_cancelada')->middleware('usuarios_sistema_facturacion_master');

  Route::get('/home_reporte_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'home_reporte_facturacion'])->name('home_reporte_facturacion')->middleware('usuarios_sistema_facturacion');
  Route::get('/exportar_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'exportar_facturacion'])->name('exportar_facturacion')->middleware('usuarios_sistema_facturacion');
  Route::post('/exportacion_mes/', [App\Http\Controllers\facturacion_controlador::class, 'exportacion_mes'])->name('exportacion_mes')->middleware('usuarios_sistema_facturacion');
  Route::get('/home_facturacion_buscador/', [App\Http\Controllers\facturacion_controlador::class, 'home_facturacion_buscador'])->name('home_facturacion_buscador')->middleware('usuarios_sistema_facturacion');
  Route::get('/home_buscador_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'home_buscador_facturacion'])->name('home_buscador_facturacion')->middleware('usuarios_sistema_facturacion');

  Route::get('/inbox/{id}', [App\Http\Controllers\ot_controlador::class, 'inbox'])->name('inbox');

  Route::get('/inbox/{id}', [App\Http\Controllers\ot_controlador::class, 'inbox'])->name('inbox');

  Route::get('/home_facturacion/', [App\Http\Controllers\facturacion_controlador::class, 'home_facturacion'])->name('home_facturacion')->middleware('usuarios_sistema_facturacion');


  //Rutas de cotizacion
  Route::get('/home_cotizaciones/', [App\Http\Controllers\cotizaciones_controlador::class, 'home_cotizaciones'])->name('home_cotizaciones');
  Route::post('/home_cotizaciones/', [App\Http\Controllers\cotizaciones_controlador::class, 'home_cotizaciones_registro'])->name('home_cotizaciones_registro');
  Route::get('/buscador_cotizaciones/', [App\Http\Controllers\cotizaciones_controlador::class, 'buscador_cotizaciones'])->name('buscador_cotizaciones');
  Route::get('/buscador_cotizaciones_liberacion/{id}', [App\Http\Controllers\cotizaciones_controlador::class, 'buscador_cotizaciones_liberacion'])->name('buscador_cotizaciones_liberacion');

  Route::get('/home_cotizaciones_edicion/{id}', [App\Http\Controllers\cotizaciones_controlador::class, 'edicion_cotizacion'])->name('edicion_cotizacion');
  Route::put('/home_cotizaciones_edicion/{id}', [App\Http\Controllers\cotizaciones_controlador::class, 'edicion_cotizacion_registro'])->name('edicion_cotizacion_registro');

  Route::get('/cotizaciones_dibujos/{id}', [App\Http\Controllers\cotizaciones_controlador::class, 'descargar_dibujos'])->name('descargar_dibujos');
  Route::get('/home_cotizaciones_partidas/{id}', [App\Http\Controllers\cotizaciones_controlador::class, 'home_cotizaciones_partidas'])->name('home_cotizaciones_partidas');
  Route::put('/home_cotizaciones_partidas/{id}', [App\Http\Controllers\cotizaciones_controlador::class, 'home_cotizaciones_partidas_registro'])->name('home_cotizaciones_partidas_registro');
  Route::post('/home_cotizaciones_partidas_precio/', [App\Http\Controllers\cotizaciones_controlador::class, 'partida_precio_unitario'])->name('partida_precio_unitario');
  Route::post('/edicion_partida_cotizacion/', [App\Http\Controllers\cotizaciones_controlador::class, 'edicion_partida_cotizacion'])->name('edicion_partida_cotizacion');
  Route::post('/delete_partida_cotizacion/', [App\Http\Controllers\cotizaciones_controlador::class, 'delete_partida_cotizacion'])->name('delete_partida_cotizacion');


  Route::get('/cotizacion_pdf/{id}', function ($id) {

    $fecha = Carbon::now();
    $fecha = $fecha->format('Y-m-d');

    $cotizacion_numero = Models\cotizaciones_partida::where('id', '=', $id)->first();
    $cotizacion = Models\cotizacione::where('numero_cotizacion', '=', $cotizacion_numero->numero_cotizacion)->first();
    $cliente = Models\cliente::where('nombre', '=', $cotizacion->cliente)->first();
    $usuario = Models\usuario::where('usuario', '=', $cotizacion->usuario)->first();
    $total_cotizacion =  0;
    $datos_partidas_cotizacion = Models\cotizaciones_partida::where('numero_cotizacion', '=', $cotizacion->numero_cotizacion)->get();

    if ($cotizacion->empresa == 'MAQUINADOS AEME') {
      foreach ($datos_partidas_cotizacion as $cotizaciones) {
        $total = $cotizaciones->cantidad * $cotizaciones->precio_unitario;
        $cotizaciones->partida_total = $total;
        $cotizaciones->save();
        $total_cotizacion = $total_cotizacion + $total;
      }
      $cotizacion->importe = $total_cotizacion;
      if ($cotizacion->estatus_iva == 'APLICA') {
        $cotizacion->iva = $cotizacion->importe * 0.16;
        $cotizacion->total = $cotizacion->importe + $cotizacion->iva;
      } else {
        $cotizacion->iva = $cotizacion->importe * 0;
        $cotizacion->total = $cotizacion->importe + $cotizacion->iva;
      }
      $cotizacion->estatus = "COTIZADA";
      $cotizacion->save();
      $pdf = PDF::loadView('sistema_cotizaciones.cotizacion_pdf', compact('cotizacion', 'fecha', 'cliente', 'usuario', 'datos_partidas_cotizacion'));
      return $pdf->stream();
    } elseif ($cotizacion->empresa == 'SOLUCIONES AEME') {
      foreach ($datos_partidas_cotizacion as $cotizaciones) {
        $total = $cotizaciones->cantidad * $cotizaciones->precio_unitario;
        $cotizaciones->partida_total = $total;
        $cotizaciones->save();
        $total_cotizacion = $total_cotizacion + $total;
      }
      $cotizacion->importe = $total_cotizacion;
      if ($cotizacion->estatus_iva == 'APLICA') {
        $cotizacion->iva = $cotizacion->importe * 0.16;
        $cotizacion->total = $cotizacion->importe + $cotizacion->iva;
      } else {
        $cotizacion->iva = $cotizacion->importe * 0;
        $cotizacion->total = $cotizacion->importe + $cotizacion->iva;
      }
      $cotizacion->estatus = "COTIZADA";
      $cotizacion->save();
      $pdf = PDF::loadView('sistema_cotizaciones.cotizacion_pdf_soluciones', compact('cotizacion', 'fecha', 'cliente', 'usuario', 'datos_partidas_cotizacion'));
      return $pdf->stream();
    }
  })->name('cotizacion_pdf');

  Route::get('/home_ingenieria/', [App\Http\Controllers\ingenieria_controlador::class, 'Index_ingenieria'])->name('home_ingenieria')->middleware('usuarios_sistema_ingenieria');
  Route::get('/buscador_ingenieria/', [App\Http\Controllers\ingenieria_controlador::class, 'buscador_ingenieria'])->name('buscador_ingenieria')->middleware('usuarios_sistema_ingenieria');
  Route::post('/home_ingenieria_responsable/', [App\Http\Controllers\ingenieria_controlador::class, 'ingenieria_responsable'])->name('ingenieria_responsable')->middleware('usuarios_sistema_ingenieria');
  Route::post('/home_ingenieria_estatus/', [App\Http\Controllers\ingenieria_controlador::class, 'ingenieria_estatus'])->name('ingenieria_estatus')->middleware('usuarios_sistema_ingenieria');
  Route::post('/home_ingenieria_completado/', [App\Http\Controllers\ingenieria_controlador::class, 'ingenieria_completado'])->name('ingenieria_completado')->middleware('usuarios_sistema_ingenieria');
  Route::post('/home_ingenieria_cambio/', [App\Http\Controllers\ingenieria_controlador::class, 'home_ingenieria_cambio'])->name('home_ingenieria_cambio')->middleware('usuarios_sistema_ingenieria');
  Route::get('/exportar_ingenieria/', [App\Http\Controllers\ingenieria_controlador::class, 'exportar_ingenieria'])->name('exportar_ingenieria')->middleware('usuarios_sistema_ingenieria');


  //Rutas de Calidad
  Route::get('/home_calidad/', [App\Http\Controllers\calidad_controlador::class, 'index_calidad'])->name('home_calidad')->middleware('usuarios_sistema_calidad');
  Route::post('/calidad_embarques/', [App\Http\Controllers\calidad_controlador::class, 'calidad_embarques'])->name('calidad_embarques')->middleware('usuarios_sistema_calidad');
  Route::get('/calidad_produccion/{id}', [App\Http\Controllers\calidad_controlador::class, 'calidad_produccion'])->name('calidad_produccion')->middleware('usuarios_sistema_calidad');
