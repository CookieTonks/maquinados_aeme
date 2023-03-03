<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Produccion</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Barra de tareas</h6>
            <a class="collapse-item" href="{{ route('home_produccion')}}">En produccion</a>
            <a class="collapse-item" href="{{ route('home_produccion_programacion')}}">Programacion OT's</a>
          </div>
        </div>
      </li>

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

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{$contador_notificaciones}}</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="height:220px; width:150px; overflow:scroll;">
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
                  <div>
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
                  <div>
                    <span class="font-weight-bold">{{$notificacion->asunto}}</span>
                  </div>
                </a>
                @endif
                @endforeach
              </div>
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
        <div class="card-body">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SISTEMA PRODUCCION</h1>

            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#entrada_produccion_piso">Generar reporte</button>
          </div>

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
          <div class="table-responsive">
            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
              <thead>
                <tr style="text-align: center;">
                  <th class="th-sm">Orden de trabajo</th>
                  <th class="th-sm">Dibujo</th>
                  <th class="th-sm">Descripcion</th>
                  <th class="th-sm">Cantidad</th>
                  <th class="th-sm">Piezas entregadas</th>
                  <th class="th-sm">Fecha de entrega</th>
                  <th class="th-sm">Dias para entrega</th>
                  <th class="th-sm">Proceso</th>
                  <th class="th-sm">Cliente</th>
                  <th class="th-sm">Vendedor</th>
                  <th class="th-sm">Encargado</th>
                </tr>
              </thead>
              <tbody style="text-align: center;text-align: -webkit-center;">
                @foreach($mostrar as $item)
                <tr>
                  <td style="text-align:-moz-center; color:blue !important;"><a href="{{route('pdf',$item->ot)}}">{{$item->ot}}</a></td>
                  <td><a href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> Ver </a></td>
                  <td>{{$item->descrip}}</td>
                  <td>{{$item->cant}}</td>
                  <td>{{$item->cant_entregada}}</td>
                  <td>{{$item->fecha_entrega}}</td>
                  <td>{{$item->dias}}</td>
                  <td>{{$item->proceso}}</td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->vendedor}}</td>
                  <td>{{$item->encargado}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

        <div class="modal fade" id="entrada_produccion_piso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REPORTE DE PRODUCCION</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close ">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('exportar_produccion')}}" method="post">
                  @csrf
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label>PROGRAMADOR</label>
                      <select class="form-control" id="programador" name="programador" required>
                        <option value="" class="form-control"></option>
                        <option>ALEJANDRO</option>
                        <option>DAVID LOPEZ</option>
                        <option>JOEL RODRIGUEZ</option>
                        <option>JONATHAN PORTILLO </option>
                        <option>JORGE</option>
                        <option>JOSE CRUZ</option>
                        <option>JUAN MAGAÑA</option>
                        <option>MARIO - CONVENCIONAL</option>
                        <option>MARIO - SOLDADURA</option>
                        <option>MARIO - TORNO CNC</option>
                        <option>VICTOR CEBALLOS</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary btn-block" type="submit">Registrar salida</button>
                  </div>
                </form>
              </div>
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
    <script src="template/js/sb-admin-2.min.js"></script>
</body>

</html>