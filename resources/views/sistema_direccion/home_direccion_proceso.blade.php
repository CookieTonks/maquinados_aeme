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

            <li class="nav-item">
                <a class="nav-link" href="{{route('home_direccion_proceso')}}">
                    <i class="fas fa-chart-line"></i> <span>Proceso</span></a>
            </li>
            <hr class="sidebar-divider">

            <!-- Nav Item- Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ordenes de trabajo</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Barra de tareas</h6>
                        <a class="collapse-item" href="{{ route('home_sistema_ot')}}">Inicio</a>
                        <a class="collapse-item" href="{{ route('home_buscador_sistema_ot')}}">Buscardor de OT</a>
                        <a class="collapse-item" href="{{ route('home_remisiones')}}">Remision</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home_clientes')}}">
                    <i class="fas fa-address-book"></i>
                    <span>Clientes</span></a>
            </li>


            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home_usuarios')}}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Usuarios</span></a>
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
                    <div style="display:none;">
                        <textarea id="code" style="widtz h: 200%;" rows="20">
                        st=>start: VENTAS: {{$ot_total}}
                          e=>end: FACTURACION: {{$facturacion_total}}
                          op1=>operation: COMPRAS: {{$compras_total}}
                          op2=>operation: INGENIERIA: {{$ingenieria_total}}
                          op3=>operation: PRODUCCION: {{$produccion_total}}
                          op4=>operation: CALIDAD: {{$calidad_total}}
                          op5=>operation: EMBARQUES: {{$embarques_total}}
                        st(right)->op1->op2(right)->op3(right)->op4(right)->op5(right)->e
                      </textarea>
                    </div>
                    <div style="display:none;"><button id="run" type="button">Run</button></div>
                    <div id="canvas" style="text-align: center;"></div>
                    <br><br>
                    <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav_ot" role="tab" aria-controls="nav-home" aria-selected="true">OT'S VENTAS</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav_compras" role="tab" aria-controls="nav-profile" aria-selected="false">OT'S COMPRAS</a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav_ingenieria" role="tab" aria-controls="nav-contact" aria-selected="false">OT'S INGENIERIA</a>
                        <a class="nav-link" id="nav-people-tab" data-toggle="tab" href="#nav_produccion" role="tab" aria-controls="nav-contact" aria-selected="false">OT'S PRODUCCION</a>
                        <a class="nav-link" id="nav-people-tab" data-toggle="tab" href="#nav_calidad" role="tab" aria-controls="nav-contact" aria-selected="false">OT'S CALIDAD</a>
                        <a class="nav-link" id="nav-people-tab" data-toggle="tab" href="#nav_embarques" role="tab" aria-controls="nav-contact" aria-selected="false">OT'S EMBARQUES</a>
                        <a class="nav-link" id="nav-people-tab" data-toggle="tab" href="#nav_facturacion" role="tab" aria-controls="nav-contact" aria-selected="false">OT'S FACTURACION</a>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav_ot" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">OT</th>
                                            <th scope="col">DESCRIPCION</th>
                                            <th scope="col">CLIENTE</th>
                                            <th scope="col">FECHA INICIO</th>
                                            <th scope="col">FECHA ENTREGA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ot_data as $ot)
                                        <tr>
                                            <td>{{$ot->ot}}</td>
                                            <td>{{$ot->descripcion}}</td>
                                            <td>{{$ot->cliente}}</td>
                                            <td>{{$ot->fecha_inicio}}</td>
                                            <td>{{$ot->fecha_entrega}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav_compras" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">OT</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">FECHA INICIO</th>
                                        <th scope="col">FECHA ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compras_data as $ot)
                                    <tr>
                                        <td>{{$ot->ot}}</td>
                                        <td>{{$ot->descripcion}}</td>
                                        <td>{{$ot->cliente}}</td>
                                        <td>{{$ot->fecha_inicio}}</td>
                                        <td>{{$ot->fecha_entrega}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav_ingenieria" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">OT</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">FECHA INICIO</th>
                                        <th scope="col">FECHA ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ingenieria_data as $ot)
                                    <tr>
                                        <td>{{$ot->ot}}</td>
                                        <td>{{$ot->descripcion}}</td>
                                        <td>{{$ot->cliente}}</td>
                                        <td>{{$ot->fecha_inicio}}</td>
                                        <td>{{$ot->fecha_entrega}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav_produccion" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">OT</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">FECHA INICIO</th>
                                        <th scope="col">FECHA ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produccion_data as $ot)
                                    <tr>
                                        <td>{{$ot->ot}}</td>
                                        <td>{{$ot->descripcion}}</td>
                                        <td>{{$ot->cliente}}</td>
                                        <td>{{$ot->fecha_inicio}}</td>
                                        <td>{{$ot->fecha_entrega}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav_calidad" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">OT</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">FECHA INICIO</th>
                                        <th scope="col">FECHA ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($calidad_data as $ot)
                                    <tr>
                                        <td>{{$ot->ot}}</td>
                                        <td>{{$ot->descripcion}}</td>
                                        <td>{{$ot->cliente}}</td>
                                        <td>{{$ot->fecha_inicio}}</td>
                                        <td>{{$ot->fecha_entrega}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav_embarques" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">OT</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">FECHA INICIO</th>
                                        <th scope="col">FECHA ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($embarques_data as $ot)
                                    <tr>
                                        <td>{{$ot->ot}}</td>
                                        <td>{{$ot->descripcion}}</td>
                                        <td>{{$ot->cliente}}</td>
                                        <td>{{$ot->fecha_inicio}}</td>
                                        <td>{{$ot->fecha_entrega}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav_facturacion" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">OT</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">FECHA INICIO</th>
                                        <th scope="col">FECHA ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($facturacion_data as $ot)
                                    <tr>
                                        <td>{{$ot->ot}}</td>
                                        <td>{{$ot->descripcion}}</td>
                                        <td>{{$ot->cliente}}</td>
                                        <td>{{$ot->fecha_inicio}}</td>
                                        <td>{{$ot->fecha_entrega}}</td>
                                    </tr>
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
            <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="http://flowchart.js.org/flowchart-latest.js"></script>
            <script src="../release/flowchart.min.js"></script>
            <script>
                window.onload = function() {
                    var btn = document.getElementById("run"),
                        cd = document.getElementById("code"),
                        chart;

                    (btn.onclick = function() {
                        var code = cd.value;

                        if (chart) {
                            chart.clean();
                        }

                        chart = flowchart.parse(code);
                        chart.drawSVG('canvas', {
                            // 'x': 30,
                            // 'y': 50,
                            'line-width': 3,
                            'maxWidth': 30, //ensures the flowcharts fits within a certian width
                            'line-length': 70,
                            'text-margin': 10,
                            'font-size': 30,
                            'font': 'normal',
                            'font-family': 'Helvetica',
                            'font-weight': 'normal',
                            'font-color': 'black',
                            'line-color': 'black',
                            'element-color': 'black',
                            'fill': 'white',
                            'yes-text': 'yes',
                            'no-text': 'no',
                            'arrow-end': 'block',
                            'scale': 1,
                            'symbols': {
                                'start': {
                                    'font-color': 'black',
                                    'element-color': 'black',
                                    'fill': 'yellow'
                                },
                                'end': {
                                    'class': 'end-element'
                                }
                            },
                            'flowstate': {
                                'past': {
                                    'fill': '#FFFFFF',
                                    'font-size': 12
                                },
                                'current': {
                                    'fill': 'yellow',
                                    'font-color': 'red',
                                    'font-weight': 'bold'
                                },
                                'future': {
                                    'fill': '#FFFFFF'
                                },
                                'request': {
                                    'fill': 'blue'
                                },
                                'invalid': {
                                    'fill': '#28a745'
                                },
                                'approved': {
                                    'fill': '#FFFFFF',
                                    'font-size': 12,
                                    'yes-text': 'APPROVED',
                                    'no-text': 'n/a'
                                },
                                'rejected': {
                                    'fill': '#C45879',
                                    'font-size': 12,
                                    'yes-text': 'n/a',
                                    'no-text': 'REJECTED'
                                }
                            }
                        });

                        $('[id^=sub1]').click(function() {
                            alert('info here');
                        });
                    })();

                };

                function myFunction(event, node) {
                    console.log("You just clicked this node:", node);
                }
            </script>
</body>

</html>