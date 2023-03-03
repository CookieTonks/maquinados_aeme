<!DOCTYPE html>
<html lang="en">

<head>
<title> Ordenes de trabajo </title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Recursos -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Plantillas -->
  <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Configuraciones -->
  <style>
    .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #050505;
    }
  </style>
</head>

<body id="page-top">

  <div class="modal fade" id="exampleModal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">ALTA DE CLIENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('home_clientes_registro')}}" method="post">
            @csrf
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label>RAZON SOCIAL</label>
                <input type="text" class="form-control" placeholder="MAQUINADOS AEME S.A DE C.V" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label>DIRECCION</label>
                <input type="text" class="form-control" placeholder="BLVRD JULIAN TREVIÑO ELIZONDO #410, PARQUE REGGIO, 66633 CD APODACA, N.L." name="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
              </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="wrapper">
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
          <div class="table-responsive">
            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
              <thead>
                <tr style="text-align: center;">
                  <th>
                    <button type="button" class="btn btn-outline-primary btn-sm m-0 waves-effect" data-toggle="modal" data-target="#exampleModal" style="width:90%; height:100%">
                      <i class="far fa-plus-square"></i>
                      Agregar
                    </button>
                  </th>
                  <th class="th-sm">RAZON SOCIAL</th>
                  <th class="th-sm">DIRECCION</th>
                </tr>
              </thead>
              <tbody style="text-align: center;">
                @foreach($clientes as $cliente)
                <tr>
                  <td>

                  </td>
                  <td>{{$cliente->nombre}}</td>
                  <td>{{$cliente->direccion}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

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
    </div>



    <!-- Pie de pagina -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; Maquinados AEME S.A de C.V 2021</span>
          <!-- Development by Miriam Dominguez -->
        </div>
      </div>
    </footer>
    <!-- Fin pie de pagina -->
  </div>

  </div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Script -->
  <script>
    $(document).ready(function() {
      $('#dtBasicExample').DataTable();
    });
  </script>

</body>

</html>