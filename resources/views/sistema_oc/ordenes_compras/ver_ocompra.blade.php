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


                    <!-- Sidebar -->
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
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="true" aria-controls="collapseTwo">
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


                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-fw fa-cog"></i>
                                <span>Almacen</span>
                            </a>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Barra de tareas</h6>
                                    <a class="collapse-item" href="{{ route('home_almacen') }}">Entrada de almacen</a>
                                    <a class="collapse-item" href="{{ route('almacen_baja_herramienta') }}">Salida de herramienta</a>
                                    <a class="collapse-item" href="{{ route('home_inventario') }}">Inventario de almacen</a>
                                </div>
                            </div>
                        </li>



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
                    <form action="{{route('edit_ocompra',$mostrar)}}" method="post">
                      @method('PUT')
                      @csrf
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationDefault02">Entrega</label>
                          <input type="date" class="form-control" name="Entrega" value="{{$mostrar->Entrega}}"  >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Condiciones de pago</label>
                            <select id="inputState2" name="Condiciones_de_pago" value="{{$mostrar->Condiciones_de_pago}}" required class="form-control">
                              <option selected>{{$mostrar->Condiciones_de_pago}}</option>
                                  <option>Transferencia</option>
                                  <option>Cheque al día</option>
                                  <option>Cheque posfechado</option>
                                  <option>Efectivo</option>
                                  <option>Crédito</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>Cliente</label>
                            <select id="inputState" name="Cliente" value="{{$mostrar->Cliente}}" required class="form-control">
                              <option selected>{{$mostrar->Cliente}}</option>
                              <optgroup label="GRUPO 1">
                              <option>1001-Met.</option>
                              <option>1002-Fam.</option>
                              <option>1003-Wei.</option>
                              <option>1004-Mond.</option>
                              <option>1005-Forj.</option>
                              <option>1006-Mab.</option>
                              </optgroup>
                              <optgroup label="GRUPO 2">
                              <option>2001-Kat.</option>
                              <option>2002-Pola.</option>
                              <option>2003-Cupr.</option>
                              <option>2004-Wymn.</option>
                              <option>2005-Nidc.</option>
                              <option>2006-Sate.</option>
                              <option>2007-Ten.</option>
                              <option>2008-Vauto.</option>
                              <option>2009-Martr.</option>
                              <option>2010-Rockw.</option>
                              <option>2011-Nav.</option>
                              <option>2012-Reg.</option>
                              <option>2013-Ced.</option>
                              </optgroup>
                              <optgroup label="GRUPO 3">
                              <option>3001-Trans.</option>
                              <option>3002-Thie.</option>
                              <option>3003-Iind.</option>
                              <option>3004-Copam.</option>
                              <option>3005-Biop.</option>
                              <option>3006-Carg.</option>
                              <option>3007-Bt.</option>
                              <option>3008-For.</option>
                              <option>3009-Temp.</option>
                              <option>3010-Mold.</option>
                              </optgroup>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                              <label>Moneda</label>
                                <select id="inputState" name="Moneda" value="{{$mostrar->Moneda}}" required class="form-control">
                                  <option selected>{{$mostrar->Moneda}}</option>
                                  <option>MXN</option>
                                  <option>USD</option>
                                </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>Observaciones</label>
                          <textarea  name="Observaciones" class="form-control" rows="4" name="Observaciones" cols="80">{{$mostrar->Observaciones}}</textarea>
                        </div>
                      </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-2">
                            <a href="{{route('home_ordenes_compras')}}" class="btn btn-primary btn-block">Regresar</a>
                          </div>
                          <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
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
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="template/js/sb-admin-2.min.js"></script>

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
