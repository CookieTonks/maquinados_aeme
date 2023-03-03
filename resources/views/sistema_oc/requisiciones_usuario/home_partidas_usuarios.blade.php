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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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





            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message
                       <div class="sidebar-card d-none d-lg-flex">
                            <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                            <p class="text-center mb-2"><strong>Maquinados AEME</strong></p>
                            <a class="btn btn-success btn-sm" h ref="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
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

                <!-- Begin Page Content -->
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
                                <input type="text" class="form-control" name="unidad"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-3 mb-3">
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
                            @if($requisicion->tipo_requisicion == "HERRAMIENTA")
                            <div class="col-md-1 mb-3">
                                <label> OT </label>
                                <input type="text" class="form-control" id="ot"  value="-" name="ot" readonly>
                            </div>
                            @else
                            <div class="col-md-1 mb-3">
                                <label> OT </label>
                                <input type="text" class="form-control" id="ot" name="ot" required >
                            </div>
                            @endif
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
                                    <th class="th-sm">PARTIDA</th>
                                    <th class="th-sm">USUARIO</th>
                                    <th class="th-sm">CANTIDAD</th>
                                    <th class="th-sm">UNIDAD</th>
                                    <th class="th-sm">DESCRIPCION</th>
                                    <th class="th-sm">MATERIAL</th>
                                    <th class="th-sm">F.ENTREGA</th>
                                    <th class="th-sm">OT</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;text-align: -webkit-center;">
                                @foreach($partidas as $partida)
                                <tr>
                                    <td>
                                        <a href="{{route('home_requisiciones_usuario_partida_delete', $partida)}} " class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    <td> {{$partida->requisicion}} </td>
                                    <td> {{$partida->partida}} </td>
                                    <td> {{$partida->usuario}} </td>
                                    <td> {{$partida->cantidad}} </td>
                                    <td> {{$partida->unidad}} </td>
                                    <td> {{$partida->descripcion}} </td>
                                    <td> {{$partida->material}} </td>
                                    <td> {{$partida->fecha_entrega}} </td>
                                    <td> {{$partida->ot}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                                        </div>

                        <br>
                        <div class="form-row">
                            <div class="col-md-6">
                                <a href="{{route('home_requisiciones_usuario')}}" class="btn btn-secondary btn-block"> REGRESAR</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('home_requisiciones_usuario_compras', $requisicion->id)}}" class="btn btn-success btn-block"> ENVIAR A COMPRAS </a>
                            </div>
                        </div>
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
        <script type="text/javascript" src="plugins/select/dist/js/select2.js"></script>


        <script>
            $(document).ready(function() {
                $('#dtBasicExample').DataTable();
            });

            $(function() {
                $("#fuente").change(function() {
                    if ($(this).val() == "HERRAMIENATA") {
                        $("#ot").prop("disabled", false);
                        $("#fecha_diseno").prop("disabled", true);
                        $("#comentario_diseno").prop("disabled", true);

                    } else {
                        $("#ot").prop("disabled", true);
                        $("#fecha_diseno").prop("disabled", false);
                        $("#comentario_diseno").prop("disabled", false);
                    }
                });
            });
        </script>
</body>

</html>