<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SISTEMA AEME</title>
    <!-- Load jQuery -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Load the plugin bundle. -->
    <script src="boostrap_filter/jquery-1.11.3.js"></script>
    <script src="boostrap_filter/excel-bootstrap-table-filter-bundle.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="boostrap_filter/excel-bootstrap-table-filter-style.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Maquinados AEME - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #050505;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://maquinadosaeme.com/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Maquinados AEME </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home_facturacion')}}">
                    <i class="fas fa-coins"></i>
                    <span>Facturacion</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home_facturacion_buscador')}}">
                    <i class="fas fa-search-dollar"></i>
                    <span>Buscardor</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home_reporte_facturacion')}}">
                    <i class="fas fa-chart-pie"></i>
                    <span>Reporte</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Comisiones</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message
         <div class="sidebar-card d-none d-lg-flex">
              <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
              <p class="text-center mb-2"><strong>Maquinados AEME</strong></p>
              <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
          </div>
          -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->

                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
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
                <div class="modal fade" id="altamodal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">REGISTRO DE FACTURACION</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('home_facturacion_registro')}}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label>EMPRESA</label>
                                            <select class="custom-select" name="empresa" required>
                                                <option selected disabled>Selecciona...</option>
                                                <option>MAQUINADOS AEME</option>
                                                <option>SOLUCIONES AEME</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label>FOLIO AEME</label>
                                            <input type="text" class="form-control" value="AEME-{{$ultima_factura}}" name="folio_aeme" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>FOLIO SOLUCIONES </label>
                                            <input type="text" class="form-control" value="SOL-{{$ultima_factura_soluciones}}" name="folio_sol" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label>CLIENTE</label>
                                            <select required name="cliente" id="Cliente_id" class="form-control">
                                                <option value="" class="form-control"></option>
                                                @foreach($cliente as $item)
                                                <option value="{{$item->nombre}}" class="form-control" name="cliente">
                                                    {{$item->nombre}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>OC</label>
                                            <input type="text" class="form-control" name="oc" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <label>OT</label>
                                        <select class="custom-select" name="ot[]" multiple>
                                            <option selected disabled>Selecciona...</option>
                                            <option value="-">-</option>
                                            @foreach($ot as $item)
                                            <option value="{{$item->ot}}">{{$item->ot}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label>FECHA</label>
                                            <input type="date" class="form-control" name="fecha" value="{{$date_fecha}}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>DESCRIPCION</label>
                                            <input type="text" class="form-control" name="descripcion" required value="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label>SUBTOTAL</label>
                                            <input type="text" class="form-control" name="subtotal" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>MONEDA</label>
                                            <select class="custom-select" name="moneda" required>
                                                <option selected disabled>Selecciona...</option>
                                                <option>MXN</option>
                                                <option>USD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>IVA</label>
                                            <select class="custom-select" name="iva" required>
                                                <option selected disabled>Selecciona...</option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label>ENTRADA</label>
                                            <input type="date" class="form-control" name="entrada" value="">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>RE-FACTURA</label>
                                            <select class="custom-select" name="tipo_factura" required>
                                                <option selected disabled>Selecciona...</option>
                                                <option value="P/REFACTURA">SI</option>
                                                <option value="FACTURADA">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label>USUARIO</label>
                                            <select required name="usuario" id="Cliente_id" class="form-control">
                                                <option value="" class="form-control"></option>
                                                @foreach($usuarios as $usuario_uno => $cliente)
                                                <optgroup label="{{$usuario_uno}}">
                                                    @foreach($cliente as $us)
                                                    <option value="{{$us->usuario}}" class="form-control" name="usuario"> {{$us->usuario}} </option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>VENDEDORES</label>
                                            <select class="custom-select" name="vendedor" required>
                                                <option selected disabled>Selecciona...</option>
                                                 <option> ABRAHAM PADILLA </option>
                                        <option> ALEXIS HERNANDEZ </option>
                                        <option> ANACLETO ISAGUIRRE </option>
                                        <option> EDUARDO GARZA </option>
                                        <option> ELIAS MORALES </option>
                                        <option> IVAN TREVIÑO </option>
                                        <option> JOEL RODRIGUEZ </option>
                                        <option> MARIO RODRIGUEZ </option>
                                        <option> MARKO SAN MIGUEL </option>
                                        <option> REYNALDO GARZA </option>
                                        <option> MAURICIO THOMAS </option>
                                        <option> WENDY ESCOBEDO </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label>OBSERVACIONES</label>
                                            <input type="txt" class="form-control" name="observaciones" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Begin Page Content -->
                <div class="card-body">
                    @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('mensaje')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <script type="text/javascript">
                            $('.alert').alert()
                        </script>
                    </div>
                    @endif
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SISTEMA FACTURACION MES: {{$date_mes}} </h1>
                        <a href="{{route('exportar_facturacion')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                                FACTURACION (MXN)
                                            </div>
                                            <div class="h4 mb-0 font-weight-bold text- gray-800">{{$facturacion_mxn}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                                FACTURACION (USD)
                                            </div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{$facturacion_usd}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered table-lg" width="100%">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>
                                        <button type="button" class="btn btn-outline-primary btn-sm m-0 waves-effect" data-toggle="modal" data-target="#altamodal" style="width:90%; height:100%">
                                            <i class="far fa-plus-square"></i>
                                            Agregar
                                        </button>
                                    </th>
                                    <th class="filter">EMPRESA</th>
                                    <th>CLIENTE</th>
                                    <th>FOLIO</th>
                                    <th>OC</th>
                                    <th>OT</th>
                                    <th>DESCRIPCION</th>
                                    <th>SUBTOTAL</th>
                                    <th>IVA</th>
                                    <th>TOTAL</th>
                                    <th>MONEDA</th>
                                    <th>FECHA REGISTRO</th>
                                    <th>FECHA ENTRADA</th>
                                    <th>FECHA VENCIMIENTO</th>
                                    <th>FECHA PAGO</th>
                                    <th>ESTATUS</th>
                                    <th>USUARIO</th>
                                    <th>VENDEDOR</th>
                                    <th>OBSERVACIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facturas as $item)
                                @if($item->estatus=='FACTURADA')
                                <tr>
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @elseif($item->estatus=='REFACTURADA')
                                <tr class="table-warning">
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @elseif($item->estatus=='REFACTURADA M/A')
                                <tr class="table-warning">
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                        <butoon type="button" class="btn btn-danger btn-sm" data-toggl </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @elseif($item->estatus=='P/REFACTURA')
                                <tr class="table-primary">
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @elseif($item->estatus=='PAGADA')
                                <tr class="table-success">
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @elseif($item->estatus=='CANCELADA')
                                <tr class="table-danger">
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>
                                        <div style="width: -moz-max-content;width: max-content;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#factura_pago" data-folio="{{$item->folio}}"><i class="fas fa-dollar-sign"></i></button>
                                            <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('refacturacion', $item)}}" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelacion_factura" data-folio="{{$item->folio}}"><i class="fas fa-window-close"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->cliente}}</td>
                                    <td>{{$item->folio}}</td>
                                    <td>{{$item->oc}}</td>
                                    <td>{{$item->ot}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>${{$item->subtotal}}</td>
                                    <td>${{$item->iva}}</td>
                                    <td>${{$item->total}}</td>
                                    <td>{{$item->moneda}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                    <td>{{$item->fecha_entrada}}</td>
                                    <td>{{$item->fecha_vencimiento}}</td>
                                    <td>{{$item->fecha_pago}}</td>
                                    <td>{{$item->estatus}}</td>
                                    <td>{{$item->usuario}}</td>
                                    <td>{{$item->vendedor}}</td>
                                    <td>{{$item->observaciones}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Maquinados AEME S.A de C.V 2021</span>
                            <!-- Development by Miriam Dominguez -->
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <div class="modal fade" id="factura_pago" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Alta OC</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('estatus_factura_pagada')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label>FOLIO</label>
                                    <input id="pago_folio" type="text" class="form-control" name="folio" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>FECHA DE PAGO </label>
                                    <input type="date" class="form-control" name="fecha_pago" required>
                                </div>
                            </div>
                            <button class="btn btn-success btn-block" type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cancelacion_factura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('estatus_factura_cancelada')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <h2>ﾂｿDeseas cancelar esta factura?</h2>
                                    <input id="cancelacion_factura" type="text" class="form-control" name="cancelacion_factura" readonly>
                                </div>
                            </div>
                            <button class="btn btn-success btn-block" type="submit">Aceptar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#factura_pago').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var folio = button.data('folio') // Extract info from data-* attributes
                    // We are jquery here to update the modal's content
                    var modal = $(this)
                    modal.find('.modal-title').text('PAGO DE FOLIO:' + folio)
                    modal.find('#pago_folio').val(folio)
                })
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#cancelacion_factura').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var folio = button.data('folio') // Extract info from data-* attributes
                    // We are jquery here to update the modal's content
                    var modal = $(this)
                    modal.find('#cancelacion_factura').val(folio)
                })
            });
        </script>
        <script>
            // Use the plugin once the DOM has been loaded.
            $(function() {
                // Apply the plugin
                $('#table').excelTableFilter();
                $('#table').DataTable();
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script src="template/js/sb-admin-2.min.js"></script>

</body>


</html>
<php>
</php>