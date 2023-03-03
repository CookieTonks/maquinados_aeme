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
            <a class="collapse-item" href="{{ route('home_material_historico') }}">Material historicos</a>
          </div>
        </div>
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
          <br>
          <!-- Content Row -->
          <div class="row">
            <div class="col-xl-4 col-md-6 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                        <button type="button" class="btn btn-secondary btn-primary" data-toggle="modal" data-target="#entrada_produccion_piso">ENTRADA A PRODUCCION</button>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dolly fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                        <button type="button" class="btn btn-primary btn-primary" data-toggle="modal" data-target="#salida_produccion_parcial"></i>SALIDA PARCIAL DE PRODUCCION </button>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-people-carry fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-2xl	 font-weight-bold text-primary text-uppercase mb-1">
                        <button type="button" class="btn btn-primary btn-success" data-toggle="modal" data-target="#salida_produccion_piso"></i>SALIDA FINAL DE PRODUCCION </button>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-people-carry fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
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
    <div class="modal fade" id="entrada_produccion_piso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ENTRADA A PRODUCCION</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close ">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('produccion_entrada_piso')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label>ENTREGA</label>
                  <input type="text" class="form-control" autofocus name="usuario_entrega" required value="">
                </div>
                <div class="col-md-4 mb-3">
                  <label>OT</label>
                  <input type="text" class="form-control" name="orden_trabajo" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label>RECIBE</label>
                  <select class="form-control" id="moneda" name="usuario_recibe" required>
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

    <div class="modal fade" id="salida_produccion_piso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> SALIDA DE PRODUCCION</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('produccion_salida_piso')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-3 mb-3">
                  <label>USUARIO</label>
                  <input type="text" class="form-control" name="usuario" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label>OT</label>
                  <input type="text" class="form-control" name="orden_trabajo" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label>CANT</label>
                  <input type="number" class="form-control" name="cantidad" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label>RECIBE</label>
                  <select class="form-control" id="usuario_recibe" name="usuario_recibe" required>
                    <option value="" class="form-control"></option>
                    <option>JESUS PEREZ</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Registrar salida OT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="salida_produccion_parcial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> SALIDA PARCIAL DE PRODUCCION</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('produccion_salida_parcial')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-3 mb-3">
                  <label>USUARIO</label>
                  <input type="text" class="form-control" name="usuario" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label>OT</label>
                  <input type="text" class="form-control" name="orden_trabajo" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label>CANT</label>
                  <input type="text" class="form-control" name="cantidad" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label>RECIBE</label>
                  <select class="form-control" id="usuario_recibe" name="usuario_recibe" required>
                    <option value="" class="form-control"></option>
                    <option>JESUS PEREZ</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Registrar salida OT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>





    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script>
      $(document).ready(function() {
        $('#dtBasicExample').DataTable();
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#salida_material_gallinero').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget)
        })
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#salida_material_usuario').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget)
        })
      });
    </script>
</body>

</html>