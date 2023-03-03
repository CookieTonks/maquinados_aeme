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
      <hr class="sidebar-divider">
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
                  <th class="th-sm">OT´S</th>
                  <th class="th-sm">Clientes</th>
                  <th class="th-sm">Fecha de Inicio</th>
                  <th class="th-sm">Fecha de Entrega</th>
                  <th class="th-sm">Factura / Remision</th>
                  <th class="th-sm">Cant. Piezas</th>
                  <th class="th-sm">Cant. Entregadas</th>
                  <th class="th-sm">Orden de compras</th>
                  <th class="th-sm">Fuente</th>
                  <th class="th-sm">Dibujo</th>
                  <th class="th-sm">Cod. Pieza</th>
                  <th class="th-sm">Usuario</th>
                  <th class="th-sm">Descripcion</th>
                  <th class="th-sm">Tipo de material</th>
                  <th class="th-sm">Tratamiento térmico</th>
                  <th class="th-sm">Proceso</th>
                  <th class="th-sm">Estatus</th>
                  <th class="th-sm">Disponibilidad</th>
                  <th class="th-sm">Gerente</th>
                </tr>
              </thead>
              <tbody style="text-align: center;">
                @foreach($mostrar as $item)
                <tr>
                  <td>
                    <div style="width: -moz-max-content;width: max-content;">
                      <a href="{{route('info_ot',$item)}}" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
                      <a href="{{route('pdf',$item)}}" class="btn btn-info btn-sm"><i class="far fa-file-pdf"></i></a>
                      
                                            <a href="{{route('factura_remision',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-receipt"></i></a>
                    </div>
                  </td>
                  <td>
                    <a href="../public/storage/Dibujo_OT/{{$item->orden_trabajo}}/{{$item->orden_trabajo}}.pdf">{{$item->orden_trabajo}}</a>
                  </td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->fecha_inicio}}</td>
                  <td>{{$item->fecha_entrega}}</td>
                  <td>{{$item->factura_remision}}</td>
                  <td>{{$item->cant_pieza}}</td>
                  <td>{{$item->cant_pieza_entregada}}</td>
                  <td>{{$item->orden_compra}}</td>
                  <td>{{$item->fuente}}</td>
                  <td>{{$item->dibujo}}</td>
                  <td>{{$item->codigo_pieza}}</td>
                  <td>{{$item->usuario}}</td>
                  <td>{{$item->descripcion}}</td>
                  <td>{{$item->tipo_material}}</td>
                  <td>{{$item->tt}}</td>
                  <td>{{$item->proceso}}</td>
                  <td>{{$item->estatus}} %</td>
                  <td>{{$item->disponibilidad}}</td>
                  <td>{{$item->supervisor}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

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