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
            <div id="contesnt">

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name }}</span>
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
                <div class="modal fade" id="altamodal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Alta de inventario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('alta_inventario')}}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label>Categoria</label>
                                            <select id="" name="categoria" required class="form-control">
                                                <option value="TOR-">Tornilleria</option>
                                                <option value="END-">Endmills</option>
                                                <option value="INS-">Insertos</option>
                                                <option value="HERR-">Herramientas</option>
                                                <option value="CONS-">Consumibles</option>
                                                <option value="LIM-">Limpieza</option>
                                                <option value="SEG-">Seguridad</option>
                                                <option value="SOLD-">Soldadura</option>
                                                <option value="MACH-">Machuelos</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationDefault02">Descripción</label>
                                            <input type="text" class="form-control" name="Descripcion" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label>Número de parte</label>
                                            <input type="text" class="form-control" name="Numero_de_parte" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Cantidad actual</label>
                                            <input type="text" class="form-control" name="Cantidad_Actual">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Mínimo</label>
                                            <input type="text" class="form-control" name="Min">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label>Máximo</label>
                                            <input type="text" class="form-control" name="Max">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Unidad</label>
                                            <input type="text" class="form-control" name="Unidad" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Proveedor</label>
                                            <select name="Proveedor_cliente" id="Proveedor_cliente" class="form-control">
                                                <option value="" class="form-control">Selecciona OC</option>
                                                @foreach($proveedor as $item)
                                                <option value="{{$item->Rsocial}}" class="form-control" name="Proveedor_cliente"> {{$item->Rsocial}}</option>
                                                @endforeach
                                            </select>
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

                    <table id="dtBasicExample" class="table table-striped table-bordered table-lg" cellspacing="0" width="100%">
                        <thead>
                            <tr style="text-align: center;">
                                <th>
                                    <button type="button" class="btn btn-outline-primary btn-sm m-0 waves-effect" data-toggle="modal" data-target="#altamodal" style="width:90%; height:100%">
                                        <i class="far fa-plus-square"></i>
                                        Agregar
                                    </button>
                                </th>
                                <th class="th-sm">Estatus </th>
                                <th class="th-sm">Codigo</th>
                                <th class="th-sm">Descripción</th>
                                <th class="th-sm">Número de parte</th>
                                <th class="th-sm">Cantidad actual</th>
                                <th class="th-sm">Minimo</th>
                                <th class="th-sm">Maximo</th>
                                <th class="th-sm">Unidad</th>
                                <th class="th-sm">Proveedor</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach($mostrar as $item)
                            <tr>
                                <td style="text-align: -moz-center;">
                                    <div style="width: -moz-max-content;">
                                        <a href="{{route('inventario_edit',$item)}}" class="btn btn-info btn-sm" style="background-color: #007bff;"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('barcode',$item)}}" class="btn btn-info btn-sm" style="background-color: #007bff;"><i class="fas fa-barcode"></i></a>
                                    </div>
                                </td>
                                @if($item->Min>=$item->Cantidad_Actual)
                                <td style="background-color:rgb(240, 137, 137);">Realizar pedido</td>
                                @else
                                <td style="background-color:rgb(151, 199, 167);">OK</td>
                                @endif
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->Descripcion}}</td>
                                <td>{{$item->Numero_de_parte}}</td>
                                <td>{{$item->Cantidad_Actual}}</td>
                                <td>{{$item->Min}}</td>
                                <td>{{$item->Max}}</td>
                                <td>{{$item->Unidad}}</td>
                                <td>{{$item->Proveedor_cliente}}</td>
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

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="plugins/select/dist/js/select2.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="plugins/select/dist/js/select2.js"></script>
        <script>
            $(document).ready(function() {
                $('#dtBasicExample').DataTable();
            });
        </script>
</body>

</html>