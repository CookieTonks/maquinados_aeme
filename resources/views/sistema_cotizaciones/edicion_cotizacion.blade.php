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
          <div class="card-body">
            <h3>EDICION DE COTIZACION {{$cotizacion->numero_cotizacion}}</h3>
            <form action="{{route('edicion_cotizacion_registro', $cotizacion)}}" method="post">
              @method('PUT')
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>EMPRESA</label>
                  <select class="custom-select" name="empresa" required>
                    <option selected>{{$cotizacion->empresa}}</option>
                    <option>SOLUCIONES AEME</option>
                    <option>MAQUINADOS AEME</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label># COTIZACION</label>
                  <input type="text" class="form-control" value="{{$cotizacion->numero_cotizacion}}" name="numero_cotizacion" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationDefault02">CLIENTE</label>
                  <select name="cliente" id="Cliente_id" class="form-control">
                    <option value="{{$cotizacion->cliente}}" class="form-control">{{$cotizacion->cliente}}</option>
                    @foreach($cliente as $item)
                    <option value="{{$item->nombre}}" class="form-control" name="cliente"> {{$item->nombre}} </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>USUARIO</label>
                  <select required name="usuario" id="Cliente_id" class="form-control">
                    <option value="{{$cotizacion->usuario}}" class="form-control">{{$cotizacion->usuario}}</option>
                    @foreach($usuarios as $usuario_uno => $cliente)
                    <optgroup label="{{$usuario_uno}}">
                      @foreach($cliente as $us)
                      <option value="{{$us->usuario}}" class="form-control" name="usuario"> {{$us->usuario}} </option>
                      @endforeach
                    </optgroup>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>CONDICIONES</label>
                  <select class="form-control" name="condiciones" required>
                    <option value="{{$cotizacion->condiciones}}">{{$cotizacion->condiciones}}</option>
                    <option>CREDITO</option>
                    <option>CONTADO</option>
                    <option>NET 60</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label>ENTREGA</label>
                  <input type="text" class="form-control" value="{{$cotizacion->entrega}}" name="entrega">
                </div>
              </div>
              <div class="form-row">
                <!--Aqui va for each de monedas -->
                <div class="col-md-6 mb-3">
                  <label>MONEDA</label>
                  <select class="form-control" name="moneda" required>
                    <option value="{{$cotizacion->moneda}}">{{$cotizacion->moneda}}</option>
                    <option>MXN</option>
                    <option>USD</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label>IVA</label>
                  <select class="form-control" name="estatus_iva" required>
                    <option value="{{$cotizacion->estatus_iva}}">{{$cotizacion->estatus_iva}}</option>
                    <option>APLICA</option>
                    <option>NO APLICA</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-8">
                  <label>OBSERVACIONES</label>
                  <input type="text" class="form-control" value="{{$cotizacion->observaciones}}" name="observaciones">
                </div>
                <div class="col-md-4">
                  <label>ESTATUS</label>
                  <select class="form-control" name="estatus" required>
                    <option value="{{$cotizacion->estatus}}">{{$cotizacion->estatus}}</option>
                    <option>URGENTE</option>
                    <option>SOLICITADA</option>
                  </select>
                </div>
              </div>

              <br>

              <div class="form-row">
                <div class="col-md-6">
                  <a href="javascript:history.back()" class="btn btn-primary btn-block">Regresar</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success btn-block">Guardar</button>
                </div>
              </div>
            </form>
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
</body>

</html>