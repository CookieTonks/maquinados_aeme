<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Maquinados AEME - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    .fixed-table-loading
    {
       margin: 0;
       font-family: Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
       font-size: 1rem;
       font-weight: 400;
       line-height: 1.5;
       color: #FFFF;
       text-align: left;
       background-color: #fff;
     }
    </style>
</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-fw fa-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Maquinados AEME   </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home')}}">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard </span></a>
            </li>


            <!-- Nav Item - Utilities Collapse Menu -->

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

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

      <!-- Sidebar Message
           <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>Maquinados AEME</strong></p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->
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
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">{{$contador_notificaciones}}</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown" style="height:220px; width:150px; overflow:scroll;">
                            <h6 class="dropdown-header">
                                Notificaciones
                            </h6>
                            @foreach($notificaciones as $notificacion)
                            @if($notificacion->seen == "NO")
                            <a class="dropdown-item d-flex align-items-center" href="{{route('inbox', $notificacion)}}" target="_blank">
                                <div class="mr-4">
                                    <div class="icon-circle bg-primary">
                                        <i class=" fas fa-bell text-white"></i>
                                    </div>
                                </div>
                                <div >
                                    <span class="font-weight-bold">{{$notificacion->asunto}}</span>
                                </div>
                            </a>
                            @else
                            <a style="background-color:#e0ded7;" class="dropdown-item d-flex align-items-center" href="{{route('inbox', $notificacion)}}" target="_blank">
                                <div class="mr-4">
                                    <div class="icon-circle bg-primary">
                                        <i class=" fas fa-bell text-white"></i>
                                    </div>
                                </div>
                                <div >
                                    <span class="font-weight-bold">{{$notificacion->asunto}}</span>
                                </div>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </li>
                      <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" data-toggle="modal" href="href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"">
                                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  {{ __('Log out') }}
                                </form>
                              </a>
                          </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <div class="modal fade" id="altamodal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                            <h5 cla                             VVVss="modal-title" id="staticBackdropLabel">DESCARGA DE REPORTE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('exportacion_mes')}}" method="post">
                                @csrf
                                <div class="form-row">
                                  <div class="col-md-12 mb-3">
                                    <label>REPORTE DEL MES</label>
                                    <select class="custom-select" name="mes" required>
                                      <option selected disabled>SELECCIONA UN MES</option>
                                      <option>JUNIO</option>
                                      <option>JULIO</option>
                                      <option>AGOSTO</option>
                                      <option>SEPTIEMBRE</option>
                                      <option>OCTUBRE</option>
                                      <option>NOVIEMBRE</option>
                                      <option>DICIEMBRE</option>
                                      <option>ENERO</option>
                                      <option>FEBRERO</option>
                                    </select>
                                  </div>
                                </div>
                              <button class="btn btn-primary btn-block" type="submit">DESCARGAR</button>
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
                           <h1 class="h3 mb-0 text-gray-800">SISTEMA FACTURACION MES: MARZO </h1>
                           <button style="padding:15px 30px 14px 30px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#altamodal" data-toggle="modal" type="button" class="btn btn-primary btn-block"> REPORTE </button>
                    </div>
                    <div class="table-responsive">
                    <table id="table"
                    data-toggle="table"
                    data-search="true"
                    data-filter-control="true"
                    data-toolbar="#toolbar"
                    data-escape="false"
                    data-pagination="true"
                    class="table table-striped table-responsive">
               <thead>
                 <tr>
                   <th>
                     ACCIONES
                   </th>
                   <th data-field="cliente" data-filter-control="select" data-sortable="true">CLIENTE</th>
                   <th data-field="folio" data-filter-control="select" data-sortable="true">FOLIO</th>
                   <th data-field="oc" data-filter-control="select" data-sortable="true">OC</th>
                   <th data-field="fecha" data-filter-control="select" data-sortable="true">FECHA</th>
                   <th data-field="mes" data-filter-control="select" data-sortable="true">MES</th>
                   <th data-field="year" data-filter-control="select" data-sortable="true">AÑO</th>
                   <th data-field="descripcion" data-filter-control="select" data-sortable="true">DESCRIPCION</th>
                   <th data-field="subtotal" data-filter-control="select" data-sortable="true">SUBTOTAL</th>
                   <th data-field="iva" data-filter-control="select" data-sortable="true">IVA</th>
                   <th data-field="total" data-filter-control="select" data-sortable="true">TOTAL</th>
                   <th data-field="moneda" data-filter-control="select" data-sortable="true">MONEDA</th>
                   <th data-field="entrada" data-filter-control="select" data-sortable="true">ENTRADA</th>
                   <th data-field="vence" data-filter-control="select" data-sortable="true">VENCE</th>
                   <th data-field="pagada" data-filter-control="select" data-sortable="true">ESTATUS</th>
                   <th data-field="usuario" data-filter-control="select" data-sortable="true">USUARIO</th>
                   <th data-field="vendedor" data-filter-control="select" data-sortable="true">VENDEDOR</th>
                   <th data-field="observaciones" data-filter-control="select" data-sortable="true">OBSERVACIONES</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach($facturas as $item)
                 @if($item->estatus=='FACTURADA')
                 <tr>
                   <td>
                     <div style="width: -moz-max-content;width: max-content;">
                         <a href="{{route('estatus_factura_pagada',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i></a>
                         <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                         <a href="" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                         <a href="{{route('estatus_factura_cancelada',$item)}}" class="btn btn-danger btn-sm"><i class="fas fa-window-close"></i></a>
                    </div>
                   </td>
                   <td>{{$item->cliente}}</td>
                   <td>{{$item->folio}}</td>
                   <td>{{$item->oc}}</td>
                   <td>{{$item->fecha_registro}}</td>
                   <td>{{$item->fecha_mes}}</td>
                   <td>{{$item->fecha_year}}</td>
                   <td>{{$item->descripcion}}</td>
                   <td>${{$item->subtotal}}</td>
                   <td>${{$item->iva}}</td>
                   <td>${{$item->total}}</td>
                   <td>{{$item->moneda}}</td>
                   <td>{{$item->entrada}}</td>
                   <td>{{$item->vence}}</td>
                   <td>{{$item->estatus}}</td>
                   <td>{{$item->usuario}}</td>
                   <td>{{$item->vendedor}}</td>
                   <td>{{$item->observaciones}}</td>
               </tr>
               @elseif($item->estatus=='REFACTURADA')
               <tr class="table-warning">
                 <td>
                   <div style="width: -moz-max-content;width: max-content;">
                       <a href="{{route('estatus_factura_pagada',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i></a>
                       <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                       <a href="" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                       <a href="{{route('estatus_factura_cancelada',$item)}}" class="btn btn-danger btn-sm"><i class="fas fa-window-close"></i></a>
                  </div>
                 </td>
                 <td>{{$item->cliente}}</td>
                 <td>{{$item->folio}}</td>
                 <td>{{$item->oc}}</td>
                 <td>{{$item->fecha}}</td>
                 <td>{{$item->fecha_mes}}</td>
                 <td>{{$item->fecha_year}}</td>
                 <td>{{$item->descripcion}}</td>
                 <td>${{$item->subtotal}}</td>
                 <td>${{$item->iva}}</td>
                 <td>${{$item->total}}</td>
                 <td>{{$item->moneda}}</td>
                 <td>{{$item->entrada}}</td>
                 <td>{{$item->vence}}</td>
                 <td>{{$item->estatus}}</td>
                 <td>{{$item->usuario}}</td>
                 <td>{{$item->vendedor}}</td>
                 <td>{{$item->observaciones}}</td>
             </tr>
             @elseif($item->estatus=='PAGADA')
             <tr class="table-success">
               <td>
                 <div style="width: -moz-max-content;width: max-content;">
                     <a href="{{route('estatus_factura_pagada',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i></a>
                     <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                     <a href="" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                     <a href="{{route('estatus_factura_cancelada',$item)}}" class="btn btn-danger btn-sm"><i class="fas fa-window-close"></i></a>
                </div>
               </td>
               <td>{{$item->cliente}}</td>
               <td>{{$item->folio}}</td>
               <td>{{$item->oc}}</td>
               <td>{{$item->fecha}}</td>
               <td>{{$item->fecha_mes}}</td>
               <td>{{$item->fecha_year}}</td>
               <td>{{$item->descripcion}}</td>
               <td>${{$item->subtotal}}</td>
               <td>${{$item->iva}}</td>
               <td>${{$item->total}}</td>
               <td>{{$item->moneda}}</td>
               <td>{{$item->entrada}}</td>
               <td>{{$item->vence}}</td>
               <td>{{$item->estatus}}</td>
               <td>{{$item->usuario}}</td>
               <td>{{$item->vendedor}}</td>
               <td>{{$item->observaciones}}</td>
           </tr>
           @elseif($item->estatus=='CANCELADA')
           <tr class="table-danger">
             <td>
               <div style="width: -moz-max-content;width: max-content;">
                   <a href="{{route('estatus_factura_pagada',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i></a>
                   <a href="{{route('edit_facturacion',$item)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                   <a href="" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                   <a href="{{route('estatus_factura_cancelada',$item)}}" class="btn btn-danger btn-sm"><i class="fas fa-window-close"></i></a>
              </div>
             </td>
             <td>{{$item->cliente}}</td>
             <td>{{$item->folio}}</td>
             <td>{{$item->oc}}</td>
             <td>{{$item->fecha}}</td>
             <td>{{$item->fecha_mes}}</td>
             <td>{{$item->fecha_year}}</td>
             <td>{{$item->descripcion}}</td>
             <td>${{$item->subtotal}}</td>
             <td>${{$item->iva}}</td>
             <td>${{$item->total}}</td>
             <td>{{$item->moneda}}</td>
             <td>{{$item->entrada}}</td>
             <td>{{$item->vence}}</td>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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
                        <input id="pago_folio" type="text" class="form-control" name="folio" readonly >
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>FECHA DE PAGO </label>
                        <input type="date" class="form-control" name="fecha_pago" required >
                      </div>
                    </div>
                  <button class="btn btn-success btn-block" type="submit">Guardar</button>
                </form>
              </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="cancelacion_factura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <h2>¿Deseas cancelar esta factura?</h2>
                        <input id="cancelacion_factura" type="text" class="form-control" name="cancelacion_factura" readonly >
                      </div>
                    </div>
                    <button class="btn btn-success btn-block"  type="submit">Aceptar</button>
                  </form>
                </div>
          </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="template/js/sb-admin-2.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js'></script>
    <script src='https://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js'></script><script  src="./script.js"></script>
</body>

</html>
