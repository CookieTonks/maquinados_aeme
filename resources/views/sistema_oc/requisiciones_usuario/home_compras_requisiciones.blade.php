<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ordenes de compras</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 co    |llapse-inner rounded">
                        <h6 class="collapse-header">Barra de tareas</h6>
                        <a class="collapse-item" href="{{ route('home_ordenes_compras') }}">Inicio</a>
                        <a class="collapse-item" href="{{ route('home_requisiciones_compras_historico') }}">Requisiones historico</a>
                        <a class="collapse-item" href="{{ route('home_administracion_compras') }}">Mapeo de compras OT </a>
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
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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
                    <form action="  " method="post" enctype="multipart/fou rm-data">
                        @method('PUT')
                        @csrf
                        <br>
                        <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                            <thead>
                                <tr style="text-align: center;">
                                    <th class="th-sm">ACCIONES</th>
                                    <th class="th-sm">REQUISICION</th>
                                    <th class="th-sm">ESTATUS</th>
                                    <th class="th-sm">USUARIO</th>
                                    <th class="th-sm">T.REQUISICION</th>
                                    <th class="th-sm">F.CREADA</th>
                                    <th class="th-sm">C. APROBADA</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;text-align: -webkit-center;">
                                @foreach($requisiciones as $requisicion)
                                @if($requisicion->estatus=='PENDIENTE POR COTIZAR')
                                <tr class="table-danger">
                                    <td>
                                        <a href="{{route('home_requisiciones_compras_partidas', $requisicion)}} " class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('home_requisiciones_compras_cambio', $requisicion)}} " class="btn btn-warning btn-sm"><i class="fas fa-retweet"></i></a>
                                    </td>
                                    <td> {{$requisicion->requisicion}} </td>
                                    <td> {{$requisicion->estatus}}</td>
                                    <td> {{$requisicion->usuario}}</td>
                                    <td> {{$requisicion->tipo_requisicion}}</td>
                                    <td> {{$requisicion->created_at}}</td>
                                    <td> {{$requisicion->cot_aprobada}}</td>
                                </tr>
                                @elseif($requisicion->estatus=='COTIZACION APROBADA')
                                <tr class="table-success">
                                    <td>
                                        <a href="{{route('partidas',$requisicion->id)}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i></a>
                                    </td>
                                    <td> {{$requisicion->requisicion}} </td>
                                    <td> {{$requisicion->estatus}}</td>
                                    <td> {{$requisicion->usuario}}</td>
                                    <td> {{$requisicion->tipo_requisicion}}</td>
                                    <td> {{$requisicion->created_at}}</td>
                                    <td> {{$requisicion->cot_aprobada}}</td>
                                </tr>
                                @elseif($requisicion->estatus=='EN ESPERA DE APROBACION')
                                <tr class="table-warning">
                                    <td>
                                        <a href="{{route('home_requisiciones_compras_partidas', $requisicion)}} " class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                    <td> {{$requisicion->requisicion}} </td>
                                    <td> {{$requisicion->estatus}}</td>
                                    <td> {{$requisicion->usuario}}</td>
                                    <td> {{$requisicion->tipo_requisicion}}</td>
                                    <td> {{$requisicion->created_at}}</td>
                                    <td> {{$requisicion->cot_aprobada}}</td>
                                </tr>
                                @elseif($requisicion->estatus=='PENDIENTE POR RECIBIR')
                                <tr class="table-secondary">
                                    <td>
                                        <a href="{{route('home_requisiciones_compras_partidas', $requisicion)}} " class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                    <td> {{$requisicion->requisicion}} </td>
                                    <td> {{$requisicion->estatus}}</td>
                                    <td> {{$requisicion->usuario}}</td>
                                    <td> {{$requisicion->tipo_requisicion}}</td>
                                    <td> {{$requisicion->created_at}}</td>
                                    <td> {{$requisicion->cot_aprobada}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        @csrf
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
            $(document).ready(function() {
                $('#dtBasicExample').DataTable();
            });
        </script>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script src="../template/js/sb-admin-2.min.js"></script>
</body>

</html>