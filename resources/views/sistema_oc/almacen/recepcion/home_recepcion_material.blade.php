<!DOCTYPE html>
<html lang="en">

<head>

  <title>Maquinados AEME - Dashboard</title>
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

</head>

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
            <a class="collapse-item" href="{{ route('home_inventario_folio') }}">Salida de herramienta</a>
            <a class="collapse-item" href="{{ route('home_recepcion_material') }}">Entrada de material</a>
            <a class="collapse-item" href="{{ route('home_salida_material') }}">Salida de material</a>
            <a class="collapse-item" href="{{ route('home_inventario') }}">Inventario de almacen</a>
            <a class="collapse-item" href="{{ route('home_material_historico') }}">Material historicos</a>
          </div>
        </div>
      </li>

      <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard_material_cliente')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Cliente</span></a>
            </li>
            
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="dropdown-item" data-toggle="modal" href="href=" route( 'logout' ) " onclick=" event.preventDefault(); this.closest( 'form' ).submit(); ""> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Log out') }}
                </form>
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Notificaciones -->
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
          <!-- Notificaciones -->

          <!-- Contenido principal -->
          <table id="dtBasicExample" class="table table-striped table-bordered table-lg" cellspacing="0" width="100%">
            <thead>
              <tr style="text-align: center;">
                <th>Entrada</th>
                <th class="th-sm">Partida</th>
                <th class="th-sm">Requisicion</th>
                <th class="th-sm">OC</th>
                <th class="th-sm">OT</th>
                <th class="th-sm">Descripcion</th>
                <th class="th-sm">Material</th>
                <th class="th-sm">Fecha</th>
                <th class="th-sm">Cantidad</th>
                <th class="th-sm">Unidad</th>
                <th class="th-sm">Proveedor</th>
                <th class="th-sm">Precio Unitario</th>
                <th class="th-sm">Certificado</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              @foreach($materiales as $material)
              <tr>
                <td>
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#entrada_material" data-id="{{$material->id}}" data-partida="{{$material->partida}}" data-descripcion="{{$material->descripcion}}"><i class="fas fa-check-square"></i></button>
                  <a href="{{route('almacen_certificado', $material->id)}}" class="btn btn-info btn-sm"><i class="fas fa-file-upload"></i></a>
                </td>
                <td>{{$material->partida}}</td>
                <td>{{$material->requisicion}}</td>
                <td>
                  <a href="../storage/app/public/Ordenes_de_compras/{{$material->orden_compra}}.pdf">{{$material->orden_compra}}</a>
                </td>
                <td>{{$material->ot}}</td>
                <td>{{$material->descripcion}}</td>
                <td>{{$material->material_partida}}</td>
                <td>{{$material->created_at}}</td>
                <td>{{$material->cantidad}}</td>
                <td>{{$material->unidad}}</td>
                <td>{{$material->proveedor}}</td>
                <td>{{$material->precio_unitario}}</td>
                @if($material->certificado_cargado=='0')
                <td style="background:#ed1858;">CERTIFICADO PENDIENTE</td>
                @else
                <td>
                  <a href="../storage/certificado_material/{{$material->partida}}.pdf">CERTIFICADO {{$material->partida}}</a>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Contenido principal -->

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


    <!-- Modal: Entrada de material -->
    <div class="modal fade" id="entrada_material" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('almacen_alta_material_registro')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <h2>ENTRADA MATERIAL AEME</h2>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>ID</label>
                  <input id="entrada_material_id" type="text" class="form-control" name="entrada_material_id" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label>PARTIDA</label>
                  <input id="entrada_material_partida" type="text" class="form-control" name="entrada_material_partida" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="entrada_material_descripcion" type="text" class="form-control" name="entrada_material_descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>FACTURA - SALIDA MATERIAL</label>
                  <input id="entrada_material_factura" type="text" class="form-control" name="entrada_material_factura">
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">REGISTRAR</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal: Entrada de material -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Codigo -->
    <script>
      $(document).ready(function() {
        $('#dtBasicExample').DataTable();
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#entrada_material').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget)
          var id = button.data('id')
          var ot = button.data('ot')
          var descripcion = button.data('descripcion')
          var partida = button.data('partida')
          var modal = $(this)
          modal.find('#entrada_material_id').val(id)
          modal.find('#entrada_material_ot').val(ot)
          modal.find('#entrada_material_descripcion').val(descripcion)
          modal.find('#entrada_material_partida').val(partida)
        })
      });
    </script>
    <!-- Codigo -->

</body>

</html>