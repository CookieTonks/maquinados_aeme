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
        <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <!-- Custom styles for this template-->
        <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
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

                <!-- Nav Item - Charts -->

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
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas  fa-rss-square"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter"></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="height:220px; width:150px; overflow:scroll;">
                                    <h6 class="dropdown-header">
                                        NOTICIAS AEME
                                    </h6>
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
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <br>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- sISTEMA OT'S Card Example -->
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('dashboard_compras')}}">SISTEMA MATERIALES </a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_requisiciones_usuario')}}">
                                                        SISTEMA REQUISICIONES
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_direccion')}}">SISTEMA DIRECCION</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="">SISTEMA ALMACEN</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- SISTEMA OT'S Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_cotizaciones')}}">SISTEMA COTIZACIONES</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-flag fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_sistema_ot')}}">SISTEMA OT'S</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_produccion_programacion')}}">SISTEMA PRODUCCION</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cogs fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('produccion_liberacion')}}">SISTEMA PISO</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cogs fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                        </div>


                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_embarques')}}">SISTEMA EMBARQUES</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_facturacion')}}">SISTEMA FACTURACION</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fas fa-coins fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_ingenieria')}}">SISTEMA INGENIERIA</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fas fa-drafting-compass fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{route('home_calidad')}}">SISTEMA CALIDAD</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fas fa-clipboard-check fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.container-fluid -->
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
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">??</span>
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
                $(document).ready(function() {
                    $('#dtBasicExample').DataTable();
                });
            </script>
    </body>

    </html>