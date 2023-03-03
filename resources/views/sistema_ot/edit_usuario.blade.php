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
  <link href="../template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Plantillas -->
  <link href="../template/css/sb-admin-2.min.css" rel="stylesheet">
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

  <!-- Contenido de pagina -->

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://maquinadosaeme.com/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-fw fa-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Maquinados AEME </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Ordenes de trabajo</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Barra de tareas</h6>
            <a class="collapse-item" href="{{ route('home_sistema_ot')}}">Sistema OT</a>
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
      <li class="nav-item">
        <a class="nav-link" href="{{route('home_usuarios')}}">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Usuarios</span></a>
      </li>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="height:220px; width:150px; overflow:scroll;">
                <h6 class="dropdown-header">
                  Notificaciones
                </h6>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
              </a>
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

        <!-- Main -->
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
          <div class="card-body">
            <form action="{{route('editar_usuario_registro', $edicion_usuario)}}" method="post">
              @method('PUT')
              @csrf
              <div class="form-row">
                <div class="col-md-6">
                  <label for="validationDefault02">CLIENTE</label>
                  <select required name="cliente" id="Cliente_id" class="form-control">
                    <option selected value="{{$edicion_usuario->cliente}}" class="form-control">{{$edicion_usuario->cliente}}</option>
                    @foreach($cliente as $item)
                    <option value="{{$item->nombre}}" class="form-control" name="no_oc"> {{$item->nombre}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault02">USUARIO</label>
                  <input type="text" class="form-control" value="{{$edicion_usuario->usuario}}" name="usuario">
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
        <!-- End main -->

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



    <!-- Modal section -->

    <!-- End modal section -->

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
    </script>
</body>

</html>