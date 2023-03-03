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

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://maquinadosaeme.com/">
            <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-fw fa-cog"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Maquinados AEME </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
              Menu
          </div>

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
                    @foreach ($mostrar as $mostrar)
                    <div class="form-row">

                      <div class="col-md-6 mb-3">
                        <label>Orden de trabajo</label>
                        <input type="text" class="form-control" name="" value="{{$mostrar->orden_trabajo}}" readonly>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="validationDefault02">Cliente</label>
                        <input type="text" class="form-control" value="{{$mostrar->cliente}}" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Fecha de Inicio</label>
                        <input type="date" class="form-control" value="{{$mostrar->fecha_inicio}}"  readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Fecha de Entrega</label>
                        <input type="date" class="form-control" value="{{$mostrar->fecha_entrega}}"  readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Fecha de Entrega Real</label>
                        <input type="date" class="form-control" value="{{$mostrar->fecha_entrega_real}}"  readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Factura / Remision</label>
                        <input type="text" class="form-control" value="{{$mostrar->factura_remision}}"  readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Cantidad de pieza</label>
                        <input type="text" class="form-control" value="{{$mostrar->cant_pieza}}"  readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Orden de compra</label>
                        <input type="text" class="form-control" value="{{$mostrar->orden_compra}}" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Descripcion</label>
                        <input type="text" class="form-control" value="{{$mostrar->descripcion}}"  readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Fuente</label>
                        <input type="text" class="form-control" value="{{$mostrar->fuente}}"  readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Dibujo</label>
                        <input type="text" class="form-control" value="{{$mostrar->dibujo}}" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                        <label>Codigo de pieza</label>
                        <input type="text" class="form-control" value="{{$mostrar->codigo_pieza}}"  readonly>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>Usuario</label>
                        <input type="text" class="form-control" value="{{$mostrar->usuario}}"  readonly>
                      </div>
                    </div>
                    <div class="form-row">
                          <div class="col-md-4 mb-3">
                            <label>Tipo de material</label>
                            <input type="text" class="form-control" value="{{$mostrar->tipo_material}}"  readonly>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>Tratamiento térmico</label>
                            <input type="text" class="form-control" value="{{$mostrar->tt}}"readonly>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>Proceso</label>
                            <input type="text" class="form-control" value="{{$mostrar->proceso}}" readonly>
                          </div>
                        </div>
                        @endforeach
                          <div class="form-row">
                            <div class="col-md-12 mb-2">
                              <a href="{{route('home_produccion')}}" class="btn btn-primary btn-block">Regresar</a>
                            </div>
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
