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


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
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
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Almacen</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Barra de tareas </h6>
                        <a class="collapse-item" href="{{ route('home_recepcion_herramienta') }}">Entrada de herramienta</a>
                        <a class="collapse-item" href="{{ route('home_salida_herramienta') }}">Salida de herramienta</a>
                        <a class="collapse-item" href="{{ route('home_recepcion_material') }}">Entrada de material</a>
                        <a class="collapse-item" href="{{ route('home_salida_material') }}">Salida de material</a>
                        <a class="collapse-item" href="{{ route('home_inventario') }}">Inventario de almacen</a>
                                                <a class="collapse-item" href="{{ route('home_material_historico') }}">Material historicos</a>

                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard_material_cliente')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Cliente</span></a>
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

                    <form action="{{route('home_salida_herramienta_registro')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="herramienta">Herramienta</label>
                                <input type="text" class="form-control" name="salida_herramienta_codigo" value="" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="inputEmail">Retorno</label>
                                <br>
                                <select name="salida_herramienta_tipo" id="select2" class="myselect form-control" required>
                                    <option value="">Selecciona...</option>
                                    <option name="salida_herramienta_tipo" value="NO">NO</option>
                                    <option name="salida_herramienta_tipo" value="SI">SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>OT</label>
                                <input type="text" class="form-control" name="salida_herramienta_ot" value="" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>CANTIDAD</label>
                                <input type="text" class="form-control" name="salida_herramienta_cantidad" value="" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>USUARIO</label>
                                <input type="text" class="form-control" name="salida_herramienta_usuario" value="" required>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label>PRODUCCION</label>
                                <select name="salida_herramienta_produccion" id="select2" class="myselect form-control" required>
                                    <option value="">Selecciona...</option>
                                    <option name="salida_herramienta_produccion" value="JOEL">JOEL</option>
                                    <option name="salida_herramienta_produccion" value="MARIO">MARIO</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-12 mb-2">
                                <button type="submit" class="btn btn-success btn-block">SALIDA DE HERRAMIENTA</button>
                            </div>
                        </div>
                    </form>
                    <br><br>
                    <table id="dtBasicExample" class="table table-striped table-bordered table-lg" cellspacing="0" width="100%">
                        <thead>
                            <tr style="text-align: center;">
                                <th class="th-sm">RETORNO</th>
                                <th class="th-sm">CODIGO</th>
                                <th class="th-sm">DESCRIPCION</th>
                                <th class="th-sm">USUARIO</th>
                                <th class="th-sm">CANTIDAD</th>
                                <th class="th-sm">PRODUCCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salidas_almacen as $salida_almacen)
                            <tr>
                                <td>
                                    <a href="{{route('home_retorno_herramienta', $salida_almacen)}}" class="btn btn-success btn-block "><i class="fas fa-undo-alt"></i></a>
                                </td>
                                <td>{{$salida_almacen->partida_codigo}}</td>
                                <td>{{$salida_almacen->descripcion}}</td>
                                <td>{{$salida_almacen->usuario}}</td>
                                <td>{{$salida_almacen->cantidad}}</td>
                                <td>{{$salida_almacen->produccion}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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

        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script src="../template/js/sb-admin-2.min.js"></script>

        <script type="text/javascript">
            $(".myselect").select2();
        </script>

        <script src="template/vendor/jquery/jquery.min.js"></script>

        <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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