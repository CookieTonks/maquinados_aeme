<!DOCTYPE html>
<html lang="en">

<head>
    <title>Maquinados AEME - Dashboard</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Recursos -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="../template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Plantillas -->
    <link href="../template/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Configuraciones -->
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #050505;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://maquinadosaeme.com/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Maquinados AEME </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Menu
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ordenes de compras</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Barra de tareas</h6>
                        <a class="collapse-item" href="{{ route('home_ordenes_compras') }}">Inicio</a>
                        <a class="collapse-item" href="{{ route('home_requisiciones') }}">Requisiones</a>
                        <a class="collapse-item" href="{{ route('home_partidas') }}">Partidas</a>
                        <a class="collapse-item" href="{{ route('home_pago_compras') }}">Complementos de pago</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home_proveedores')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Proveedores</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" data-toggle="modal" href="href=" route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"">                                 <i class=" fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Log out') }}
                                </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Apartado de notificaciones -->
                <div class="card-body">
                    @if (session('mensaje-error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('mensaje-error')}}
                        <script type="text/javascript">
                            $('.alert').alert()
                        </script>
                    </div>
                    @elseif (session('mensaje-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('mensaje-success')}}
                        <script type="text/javascript">
                            $('.alert').alert()
                        </script>
                    </div>
                    @endif
                    <!-- Apartado de notificaciones -->

                    <!-- Contenido principal -->
                    <form action=" {{route('home_requisiciones_usuario_partida', $requisicion)}} " method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-1 mb-3">
                                <label> # REQUISICION</label>
                                <input value=" {{$requisicion->requisicion}} " type="text" class="form-control" name="numero_requisicion" readonly>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> TIPO REQUISICION</label>
                                <input value=" {{$requisicion->tipo_requisicion}} " type="text" class="form-control" id="fuente" name="tipo_requisicion" readonly>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> USUARIO </label>
                                <input value=" {{$requisicion->usuario}} " type="text" class="form-control" name="usuario" readonly>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> CANT </label>
                                <input type="number" class="form-control" name="cantidad" required>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> UNI </label>
                                <input type="text" class="form-control" name="unidad" required>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> DESCRIPCION </label>
                                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" name="descripcion" required>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> MATERIAL </label>
                                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" name="material" required>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> F.ENTREGA </label>
                                <input type="date" class="form-control" name="fecha_entrega" required>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label> OT </label>
                                <input type="text" class="form-control" name="ot" required>
                            </div>
                            <div class="col-md-1 mb-3">
                                <label>Agregar</label>
                                <br>
                                <button class="btn btn-success "><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th class="th-sm">ACCIONES</th>
                                        <th class="th-sm">REQUISICION</th>
                                        <th class="th-sm">USUARIO</th>
                                        <th class="th-sm">CANTIDAD</th>
                                        <th class="th-sm">UNIDAD</th>
                                        <th class="th-sm">DESCRIPCION</th>
                                        <th class="th-sm">(1) PROVEEDOR</th>
                                        <th class="th-sm">(1) P/U</th>
                                        <th class="th-sm">(2) PROVEEDOR</th>
                                        <th class="th-sm">(2) P/U</th>
                                        <th class="th-sm">(3) PROVEEDOR</th>
                                        <th class="th-sm">(3) P/U</th>
                                        <th class="th-sm">MATERIAL</th>
                                        <th class="th-sm">F.ENTREGA</th>
                                        <th class="th-sm">OT</th>
                                        <th class="th-sm">OC</th>
                                        <th class="th-sm">CLIENTE</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;text-align: -webkit-center;">
                                    @foreach($partidas as $partida)
                                    <tr>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edicion_partida_requisicion" data-id="{{$partida->id}}" data-requisicion="{{$partida->requisicion}}" data-partida="{{$partida->partida}}" data-descripcion="{{$partida->descripcion}}" data-material="{{$partida->material}}" data-pu_uno="{{$partida->pu_uno}}" data-pu_dos="{{$partida->pu_dos}}" data-pu_tres="{{$partida->pu_tres}}"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#entrada_material_compras" data-id="{{$partida->id}}" data-requisicion="{{$partida->requisicion}}" data-partida="{{$partida->partida}}" data-descripcion="{{$partida->descripcion}}"><i class="fas fa-sign-in-alt"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_partida_requisicion" data-requisicion="{{$partida->requisicion}}" data-numero_id="{{$partida->id}}" data-partida="{{$partida->partida}}" s data-descripcion="{{$partida->descripcion}}" data-cantidad="{{$partida->cantidad}}" data-precio_unitario="{{$partida->precio_unitario}}" data-proveedor="{{$partida->proveedor}}" data-cliente="{{$partida->cliente}}" data-ot="{{$partida->ot}}" data-factura="{{$partida->factura}}" data-oc="{{$partida->orden_compra}}" data-tp="{{$partida->tipo_requisicion}}"><i class="fas fa-minus-circle"></i></button>
                                        </td>
                                        <td> {{$partida->requisicion}} </td>
                                        <td> {{$partida->usuario}} </td>
                                        <td> {{$partida->cantidad}} </td>
                                        <td> {{$partida->unidad}} </td>
                                        <td> {{$partida->descripcion}} </td>
                                        <td> {{$partida->prov_uno}} </td>
                                        @if($partida->pu_uno==NULL) <td class="table-danger"> {{$partida->pu_uno}} </td>@else<td> {{$partida->pu_uno}} </td>@endif
                                        <td> {{$partida->prov_dos}} </td>
                                        @if($partida->pu_dos==NULL) <td class="table-danger"> {{$partida->pu_dos}} </td>@else<td> {{$partida->pu_dos}} </td>@endif
                                        <td> {{$partida->prov_tres}} </td>
                                        @if($partida->pu_tres==NULL)<td class="table-danger"> {{$partida->pu_tres}} </td>@else<td> {{$partida->pu_tres}} </td>@endif
                                        <td> {{$partida->material}} </td>
                                        <td> {{$partida->fecha_entrega}} </td>
                                        <td> {{$partida->ot}} </td>
                                        <td> {{$partida->orden_compra}} </td>
                                        <td> {{$partida->cliente}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <a href="{{route('home_requisiciones_compras_pendientes')}}" class="btn btn-secondary btn-block"> REGRESAR</a>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#enviar_cotizacion">ENVIAR COTIZACION</button>
                    </div>
                </div>
                @csrf
                </form>
            </div>

            <!-- Contenido principal -->

            <!-- Modal de edicion de partidas -->
            <div class="modal fade" id="entrada_material_compras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Entrada de partida </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('entrada_material_compras')}}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-0 mb-3">
                                        <input id="numero_id" type="hidden" class="form-control" name="numero_id" readonly>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label>#REQUISICION</label>
                                        <input id="numero_requisicion" type="text" class="form-control" name="numero_cotizacion" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label># PARTIDA </label>
                                        <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>DESCRIPCION</label>
                                        <input id="descripcion" type="text" class="form-control" name="descripcion" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>FACTURA</label>
                                        <input id="factura" type="text" class="form-control" name="entrada_material_factura">
                                    </div>
                                </div>
                                <button class="btn btn-success btn-block" type="submit">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de edicion de partidas -->


            <!-- Modal de edicion de partidas -->
            <div class="modal fade" id="edicion_partida_requisicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edicion de partida </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('edicion_partida_requisicion_cotizaciones')}}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-0 mb-3">
                                        <input id="id" type="hidden" class="form-control" name="id" readonly>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label>#COTIZACION</label>
                                        <input id="numero_requisicion" type="text" class="form-control" name="numero_cotizacion" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label># PARTIDA </label>
                                        <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>DESCRIPCION</label>
                                        <input id="descripcion" type="text" class="form-control" name="descripcion" readonly>
                                    </div>
                                </div>
                                  <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>MATERIAL</label>
                                        <input id="material" type="text" class="form-control" name="material" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>(1) PROVEEDOR</label>
                                        <select name="prov_uno" id="prov_uno" class="form-control">
                                            <option selected value="" class="form-control"></option>
                                            @foreach($proveedores as $item)
                                            <option value="{{$item->Rsocial}}" class="form-control" name="cliente"> {{$item->Rsocial}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>(2) PROVEEDOR</label>
                                        <select name="prov_dos" id="prov_dos" class="form-control">
                                            <option selected value="" class="form-control"></option>
                                            @foreach($proveedores as $item)
                                            <option value="{{$item->Rsocial}}" class="form-control" name="cliente"> {{$item->Rsocial}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>(3) PROVEEDOR</label>
                                        <select name="prov_tres" id="prov_tres" class="form-control">
                                            <option selected value="" class="form-control"></option>
                                            @foreach($proveedores as $item)
                                            <option value="{{$item->Rsocial}}" class="form-control" name="cliente"> {{$item->Rsocial}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>(1) P/U </label>
                                        <input id="pu_uno" type="text" class="form-control" name="pu_uno">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>(2) P/U </label>
                                        <input id="pu_dos" type="text" class="form-control" name="pu_dos">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>(3) P/U </label>
                                        <input id="pu_tres" type="text" class="form-control" name="pu_tres">
                                    </div>
                                </div>
                                <button class="btn btn-success btn-block" type="submit">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de edicion de partidas -->

            <!-- Modal para envio de cotizacion -->
            <div class="modal fade" id="enviar_cotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Seleccion de mensajes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('home_requisiciones_compras_cotizaciones_enviar', $requisicion)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <input value=" {{$requisicion->requisicion}} " type="text" class="form-control" name="numero_requisicion" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="marko" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Marko</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="abraham" value="1">
                                            <label class="form-check-label" for="inlineCheckbox2">Abraham</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="eduardo" value="1">
                                            <label class="form-check-label" for="inlineCheckbox3">Eduardo</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-block" type="submit">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para envio de cotizacion -->

            <!-- Modal para eliminar partida -->
            <div class="modal fade" id="delete_partida_requisicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminacion de partidas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('delete_partida_requisicion')}}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>ID</label>
                                        <input id="numero_id" type="text" class="form-control" name="numero_id" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label># REQUISICION</label>
                                        <input id="numero_requisicion" type="text" class="form-control" name="numero_cotizacion" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label># PARTIDA</label>
                                        <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>DESCRIPCION</label>
                                        <input id="descripcion" type="text" class="form-control" name="descripcion" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label>CANTIDAD</label>
                                        <input id="cantidad" type="text" class="form-control" name="cantidad" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>P/U</label>
                                        <input id="precio_unitario" type="text" class="form-control" name="precio_unitario" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label>PROVEEDOR</label>
                                        <input id="proveedor" type="text" class="form-control" name="proveedor" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>CLIENTE</label>
                                        <input id="precio_unitario" type="text" class="form-control" name="cliente" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>OT</label>
                                        <input id="ot" type="text" class="form-control" name="ot" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>FACTURA</label>
                                        <input id="factura" type="text" class="form-control" name="factura" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>OC</label>
                                        <input id="oc" type="text" class="form-control" name="oc" readonly>
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-block" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para eliminar partida -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Maquinados AEME S.A de C.V 2021</span>
                        <!-- Development by Miriam Dominguez -->
                    </div>
                </div>
            </footer>
            <!-- Footer -->

        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Codigo  -->
    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#edicion_partida_requisicion').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var numero_requisicion = button.data('requisicion')
                var id = button.data('id')
                var numero_partida = button.data('partida')
                var descripcion = button.data('descripcion')
                var pu_uno = button.data('pu_uno')
                var prov_uno = button.data('prov_uno')
                var pu_dos = button.data('pu_dos')
                var pu_tres = button.data('pu_tres')
                var material = button.data('material')



                var modal = $(this)
                modal.find('.modal-title').text('Partida en edición: ' + numero_partida)
                modal.find('#numero_requisicion').val(numero_requisicion)
                modal.find('#id').val(id)
                modal.find('#numero_partida').val(numero_partida)
                modal.find('#descripcion').val(descripcion)
                modal.find('#pu_uno').val(pu_uno)
                modal.find('#prov_uno').val(prov_uno)
                modal.find('#pu_dos').val(pu_dos)
                modal.find('#pu_tres').val(pu_tres)
                modal.find('#material').val(material)


            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#delete_partida_requisicion').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var numero_requisicion = button.data('requisicion')
                var numero_id = button.data('numero_id')
                var numero_partida = button.data('partida')
                var descripcion = button.data('descripcion')
                var precio_unitario = button.data('precio_unitario')
                var cantidad = button.data('cantidad')
                var unidad = button.data('unidad')
                var proveedor = button.data('proveedor')
                var cliente = button.data('cliente')
                var ot = button.data('ot')
                var factura = button.data('factura')
                var oc = button.data('oc')
                var tp = button.data('tp')
                                var material = button.data('material')


                var modal = $(this)
                modal.find('.modal-title').text('Estas a punto de eliminar esta partidaa : ' + numero_partida)
                modal.find('#numero_requisicion').val(numero_requisicion)
                modal.find('#numero_id').val(numero_id)
                modal.find('#numero_partida').val(numero_partida)
                modal.find('#descripcion').val(descripcion)
                modal.find('#cantidad').val(cantidad)
                modal.find('#precio_unitario').val(precio_unitario)
                modal.find('#unidad').val(unidad)
                modal.find('#proveedor').val(proveedor)
                modal.find('#cliente').val(cliente)
                modal.find('#ot').val(ot)
                modal.find('#factura').val(factura)
                modal.find('#oc').val(oc)
                                modal.find('#material').val(material)

            })
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#entrada_material_compras').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var numero_requisicion = button.data('requisicion')
                var numero_id = button.data('id')
                var numero_partida = button.data('partida')
                var descripcion = button.data('descripcion')

                var modal = $(this)
                modal.find('.modal-title').text('Estas a punto de dar entrada a esta partida : ' + numero_partida)
                modal.find('#numero_requisicion').val(numero_requisicion)
                modal.find('#numero_id').val(numero_id) 
                modal.find('#numero_partida').val(numero_partida)
                modal.find('#descripcion').val(descripcion)
            })
        });
    </script>
    <!-- Codigos -->

</body>

</html>