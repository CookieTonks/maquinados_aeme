<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Maquinados AEME - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- Custom styles for this template-->
    <link href="../template/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
              <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-fw fa-cog"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Maquinados AEME </div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
              <a class="nav-link" href="{{ route('home')}}">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
          </li>

          <!-- Divider -->

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
          <!-- Nav Item - Tables -->


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
                                    <span   class="font-weight-bold">{{$notificacion->asunto}}</span>
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
                                <a class="dropdown-item" data-toggle="modal" href="href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"">                                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  {{ __('Log out') }}
                              </form>
                            </a>
                          </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

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

                    <form action="{{route('edit_facturacion_registro', $factura_edit)}}" method="post">
                      @method('PUT')
                      @csrf
                      <div class="form-row">
                        <div class="col-md-4 mb-3">
                          <label>CLIENTE</label>
                          <select  required name="cliente" id="Cliente_id" class="form-control">
                                 <option value="{{$factura_edit->cliente}}" class="form-control">{{$factura_edit->cliente}}</option>
                                   @foreach($cliente as $item)
                                 <option value="{{$item->nombre}}" class="form-control" name="cliente"> {{$item->nombre}} </option>
                                 @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>FOLIO</label>
                          <input type="text" class="form-control" name="folio" value="{{$factura_edit->folio}}" required >
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>OC</label>
                          <input type="text" class="form-control" name="oc"  value="{{$factura_edit->oc}}" required >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>FECHA REGISTRO</label>
                          <input type="date" class="form-control" name="fecha"  value="{{$factura_edit->fecha_registro}}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>DESCRIPCION</label>
                          <input type="text" class="form-control" name="descripcion"  value="{{$factura_edit->descripcion}}" >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>SUBTOTAL</label>
                          <input type="text" class="form-control" name="subtotal" value="{{$factura_edit->subtotal}}" required >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>MONEDA</label>
                          <select class="custom-select" name="moneda"required>
                            <option selected >{{$factura_edit->moneda}}</option>
                            <option>MXN </option>
                            <option>USD </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>FECHA ENTRADA</label>
                          <input type="date" class="form-control" name="entrada"  value="{{$factura_edit->fecha_entrada}}" >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>FECHA VENCIMIENTO</label>
                          <input type="date" class="form-control" name="vence" value="{{$factura_edit->fecha_vencimiento}}"  >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>USUARIO</label>
                          <input type="txt" class="form-control" name="usuario"  value="{{$factura_edit->usuario}}" >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>VENDEDOR</label>
                          <select class="custom-select" name="vendedor"required>
                            <option value="{{$factura_edit->vendedor}}">{{$factura_edit->vendedor}}</option>
                            <option>ABRAHAM PADILLA</option>
                            <option>ADRIAN ZAMORA</option>
                            <option>ANACLETO ISAGUIRRE </option>
                            <option>ALEJANDRO TAVARES </option>
                            <option>IVAN TREVIÑO </option>
                            <option>EDUARDO GARZA </option>
                            <option>ELIAS MORALES </option>
                            <option>MANUEL RODRIGUEZ</option>
                            <option>MARIO RODRIGUEZ </option>
                            <option>MARKO SAN MIGUEL </option>
                            <option>REYNALDO GARZA </option>
                            <option>VICTOR CARRERA </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>OBSERVACIONES</label>
                          <input type="txt" class="form-control" name="observaciones" value="{{$factura_edit->observaciones}}" >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6">
                          <a href="{{route('home_facturacion')}}" class="btn btn-primary btn-block">Regresar</a>
                        </div>
                        <div class="col-md-6">
                          <button type="submit"  class="btn btn-success btn-block">Guardar</button>
                        </div>
                      </div>
                    </form>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../template/vendor/jquery/jquery.min.js"></script>
    <script src="../template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../template/js/sb-admin-2.min.js"></script>

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function(){
            $('#dtBasicExample').DataTable();
        });
    </script>
</body>

</html>
