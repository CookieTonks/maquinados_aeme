<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Ordenes de trabajo </title>

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
                  <span>Ordenes de trabajo</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Barra de tareas</h6>
                      <a class="collapse-item" href="{{ route('home_sistema_ot')}}">Inicio</a>
                      <a class="collapse-item" href="{{ route('home_buscador_sistema_ot')}}">Buscardor de OT</a>
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
                      </script>pr
                    </div>
                    @endif
                    <div style="display:none;">
                      <textarea id="code" style="widtz h: 200%;" rows="20">
                        @foreach($mostrar as $key)
                          st=>start: <?php if($key->sistema_ot=='-'){echo "OT:{$key->ot}\n";}else{echo "OT: {$key->ot}|invalid\n";} ?>
                          e=>end: <?php if($key->sistema_facturacion=='-'){echo "FACTURACION\n";}else{echo "FACTURACION|invalid\n";} ?>
                          op1=>operation: <?php if($key->sistema_compras=='-'){echo "COMPRAS\n";}else{echo "COMPRAS|invalid\n";} ?>
                          op2=>operation: <?php if($key->sistema_ingenieria=='-'){echo "INGENIERIA\n";}else{echo "INGENIERIA|invalid\n";} ?>
                          op3=>operation: <?php if($key->sistema_produccion=='-'){echo "PRODUCCION\n";}else{echo "PRODUCCION|invalid\n";} ?>
                          op4=>operation: <?php if($key->sistema_calidad=='-'){echo "CALIDAD\n";}else{echo "CALIDAD|invalid\n";} ?>
                          op5=>operation: <?php if($key->sistema_embarques=='-'){echo "EMBARQUES\n";}else{echo "EMBARQUES|invalid\n";} ?>
                        @endforeach
                        st(right)->op1->op2(right)->op3(right)->op4(right)->op5(right)->e
                      </textarea>
                 </div>
                 <div style="display:none;"><button id="run" type="button">Run</button></div>
                 <div id="canvas" style="text-align: center;"></div>
                 <br>
                 <br>
                 <h1>REGISTROS DE MOVIMIENTOS DE OT</h1>
                 <div class="table-responsive">
                   <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                     <thead>
                       <tr style="text-align: center;">
                         <th class="th-sm">OT</th>
                         <th class="th-sm">AREA</th>
                         <th class="th-sm">PERSONAL</th>
                         <th class="th-sm">HORA</th>
                       </tr>
                     </thead>
                     <tbody style="text-align: center;text-align: -webkit-center;">
                       @foreach($aeme_registro as $registro)
                       <tr>
                         <td>{{$registro->ot}}</td>
                         <td>{{$registro->area}}</td>
                         <td>{{$registro->personal}}</td>
                         <td>{{$registro->hora}}</td>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="http://flowchart.js.org/flowchart-latest.js"></script>
      <script src="../release/flowchart.min.js"></script>
      <script>

          window.onload = function () {
              var btn = document.getElementById("run"),
                  cd = document.getElementById("code"),
                  chart;

              (btn.onclick = function () {
                  var code = cd.value;

                  if (chart) {
                    chart.clean();
                  }

                  chart = flowchart.parse(code);
                  chart.drawSVG('canvas', {
                    // 'x': 30,
                    // 'y': 50,
                    'line-width': 3,
                    'maxWidth': 30,//ensures the flowcharts fits within a certian width
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
                      'end':{
                        'class': 'end-element'
                      }
                    },
                    'flowstate' : {
                      'past' : { 'fill' : '#FFFFFF', 'font-size' : 12},
                      'current' : {'fill' : 'yellow', 'font-color' : 'red', 'font-weight' : 'bold'},
                      'future' : { 'fill' : '#FFFFFF'},
                      'request' : { 'fill' : 'blue'},
                      'invalid': {'fill' : '#28a745'},
                      'approved' : { 'fill' : '#FFFFFF', 'font-size' : 12, 'yes-text' : 'APPROVED', 'no-text' : 'n/a' },
                      'rejected' : { 'fill' : '#C45879', 'font-size' : 12, 'yes-text' : 'n/a', 'no-text' : 'REJECTED' }
                    }
                  });

                  $('[id^=sub1]').click(function(){
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
