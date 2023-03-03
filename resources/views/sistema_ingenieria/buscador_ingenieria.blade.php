<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu Ingenieria
      </div>
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home_ingenieria')}}">
          <i class="fas fa-calendar-alt"></i>
          <span>Bitacora dibujos</span></a>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="{{route('buscador_ingenieria')}}">
          <i class="fas fa-search"></i>
          <span>Buscador dibujos</span></a>
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
                <span class="badge badge-danger badge-counter"></span>
              </a>
              <!-- Dropdown - Alerts -->

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

          <div class="table-responsive">
            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
              <thead>
                <tr style="text-align: center;">
                  <th>Acciones</th>
                  <th>OT</td>
                  <th>DESCRIPCION</th>
                  <th>CLIENTE</th>
                  <th>VENDEDOR</th>
                  <th>MATERIAL</th>
                  <th>CANTIDAD</th>
                  <th>ESTATUS</th>
                  <th>COMENTARIO</th>
                  <th>RESPONSABLE</th>
                  <th>FECHA DISEÑO</th>
                </tr>
              </thead>
              <tbody style="text-align: center;text-align: -webkit-center;">
                @foreach($mostrar as $item)
                @if($item->estatus == 'PENDIENTE')
                <tr class="table-danger">
                  <td>
                    <div style="width: -moz-max-content;width: max-content;">
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_diseno_responsable" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-user-friends"></i></button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_diseno_proceso" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-spinner"></i></button>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_diseno_completado" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-check-square"></i></button>
                    </div>
                  </td>
                  <td>{{$item->ot}}</td>
                  <td>{{$item->descripcion}}</td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->vendedor}}</td>
                  <td>{{$item->material}}</td>
                  <td>{{$item->cantidad}}</td>
                  <td>{{$item->estatus}}</td>
                  <td>{{$item->comentario_diseno}}</td>
                  <td>{{$item->responsable}}</td>
                  <td>{{$item->fecha_diseno}}</td>
                </tr>
                @elseif($item->estatus == 'ASIGNADA')
                <tr class="table-warning">
                  <td>
                    <div style="width: -moz-max-content;width: max-content;">
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_diseno_responsable" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-user-friends"></i></button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_diseno_proceso" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-spinner"></i></button>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_diseno_completado" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-check-square"></i></button>
                    </div>
                  </td>
                  <td>{{$item->ot}}</td>
                  <td>{{$item->descripcion}}</td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->vendedor}}</td>
                  <td>{{$item->material}}</td>
                  <td>{{$item->cantidad}}</td>
                  <td>{{$item->estatus}}</td>
                  <td>{{$item->comentario_diseno}}</td>
                  <td>{{$item->responsable}}</td>
                  <td>{{$item->fecha_diseno}}</td>
                </tr>
                @elseif($item->estatus == 'EN PROCESO')
                <tr class="table-info">
                  <td>
                    <div style="width: -moz-max-content;width: max-content;">
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_diseno_responsable" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-user-friends"></i></button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_diseno_proceso" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-spinner"></i></button>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_diseno_completado" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-check-square"></i></button>
                    </div>
                  </td>
                  <td>{{$item->ot}}</td>
                  <td>{{$item->descripcion}}</td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->vendedor}}</td>
                  <td>{{$item->material}}</td>
                  <td>{{$item->cantidad}}</td>
                  <td>{{$item->estatus}}</td>
                  <td>{{$item->comentario_diseno}}</td>
                  <td>{{$item->responsable}}</td>
                  <td>{{$item->fecha_diseno}}</td>
                </tr>
                @elseif($item->estatus == 'COMPLETADO')
                <tr class="table-success">
                  <td>
                    <div style="width: -moz-max-content;width: max-content;">
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_diseno_responsable" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-user-friends"></i></button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_diseno_proceso" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-spinner"></i></button>
                      <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_cambio_dibujo" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-exchange-alt"></i></button>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_diseno_completado" data-ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}" data-responsable="{{$item->responsable}}" data-estatus="{{$item->estatus}}"><i class="fas fa-check-square"></i></button>
                    </div>
                  </td>
                  <td><a href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf">{{$item->ot}}</a></td>
                  <td>{{$item->descripcion}}</td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->vendedor}}</td>
                  <td>{{$item->material}}</td>
                  <td>{{$item->cantidad}}</td>
                  <td>{{$item->estatus}}</td>
                  <td>{{$item->comentario_diseno}}</td>
                  <td>{{$item->responsable}}</td>
                  <td>{{$item->fecha_diseno}}</td>
                </tr>
                @endif
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
    s

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


    <div class="modal fade" id="modal_diseno_responsable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">DIBUJO OT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('ingenieria_responsable')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OT</label>
                  <input id="data_ot" type="text" class="form-control" name="data_ot" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="data_descripcion" type="text" class="form-control" name="data_descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>RESPONSABLE </label>
                  <select name="data_responsable" id="proveedor_id" class="form-control">
                    <option value="MONSERRAT ESQUIVEL" class="form-control" name="cliente"> MONSERRAT ESQUIVEL </option>
                    <option value="ANGEL SOLIS" class="form-control" name="cliente"> ANGEL SOLIS </option>
                    <option value="MAURICIO THOMAS" class="form-control" name="cliente"> MAURICIO THOMAS </option>
                  </select>
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_diseno_proceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">DIBUJO OT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('ingenieria_estatus')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OT</label>
                  <input id="data_ot" type="text" class="form-control" name="data_ot" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="data_descripcion" type="text" class="form-control" name="data_descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>RESPONSABLE</label>
                  <input id="data_responsable" type="text" class="form-control" name="data_responsable" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>ESTATUS </label>
                  <select name="data_estatus" id="data_estatus" class="form-control">
                    <option value="ASIGNADA" class="form-control" name="cliente"> ASIGNADA </option>
                    <option value="EN PROCESO" class="form-control" name="cliente"> EN PROCESO </option>
                  </select>
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_diseno_completado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">DIBUJO OT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('ingenieria_completado')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OT</label>
                  <input id="data_ot" type="text" class="form-control" name="data_ot" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="data_descripcion" type="text" class="form-control" name="data_descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>RESPONSABLE</label>
                  <input id="data_responsable" type="text" class="form-control" name="data_responsable" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DIBUJO</label>
                  <input type="file" class="form-control" name="dibujo_archivo" id="dibujo_archivo" accept=".pdf" required>
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_cambio_dibujo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal cambio de dibujo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('home_ingenieria_cambio')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OT</label>
                  <input id="data_ot" type="text" class="form-control" name="data_ot" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="data_descripcion" type="text" class="form-control" name="data_descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>RESPONSABLE</label>
                  <input id="data_responsable" type="text" class="form-control" name="data_responsable" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DIBUJO</label>
                  <input type="file" class="form-control" name="dibujo_archivo" id="dibujo_archivo" accept=".pdf" required>
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $('#dtBasicExample').DataTable();
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#modal_diseno_responsable').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_ot = button.data('ot')
          var descripcion = button.data('descripcion')
          var responsable = button.data('responsable')
          var estatus = button.data('estatus')

          var modal = $(this)
          modal.find('.modal-title').text('DISEÑO OT: ' + numero_ot)
          modal.find('#data_ot').val(numero_ot)
          modal.find('#data_descripcion').val(descripcion)
          modal.find('#data_responsable').val(responsable)
          modal.find('#data_estatus').val(estatus)
        })
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#modal_diseno_proceso').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_ot = button.data('ot')
          var descripcion = button.data('descripcion')
          var responsable = button.data('responsable')
          var estatus = button.data('estatus')

          var modal = $(this)
          modal.find('.modal-title').text('DISEÑO OT: ' + numero_ot)
          modal.find('#data_ot').val(numero_ot)
          modal.find('#data_descripcion').val(descripcion)
          modal.find('#data_responsable').val(responsable)
          modal.find('#data_estatus').val(estatus)
        })
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#modal_diseno_completado').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_ot = button.data('ot')
          var descripcion = button.data('descripcion')
          var responsable = button.data('responsable')
          var estatus = button.data('estatus')

          var modal = $(this)
          modal.find('.modal-title').text('DISEÑO OT: ' + numero_ot)
          modal.find('#data_ot').val(numero_ot)
          modal.find('#data_descripcion').val(descripcion)
          modal.find('#data_responsable').val(responsable)
          modal.find('#data_estatus').val(estatus)
        })
      });
    </script>

<script>
      $(document).ready(function() {
        $('#modal_diseno_completado').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_ot = button.data('ot')
          var descripcion = button.data('descripcion')
          var responsable = button.data('responsable')
          var estatus = button.data('estatus')

          var modal = $(this)
          modal.find('.modal-title').text('DISEÑO OT: ' + numero_ot)
          modal.find('#data_ot').val(numero_ot)
          modal.find('#data_descripcion').val(descripcion)
          modal.find('#data_responsable').val(responsable)
          modal.find('#data_estatus').val(estatus)
        })
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#modal_cambio_dibujo').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_ot = button.data('ot')
          var descripcion = button.data('descripcion')
          var responsable = button.data('responsable')
          var estatus = button.data('estatus')

          var modal = $(this)
          modal.find('.modal-title').text('OT: ' + numero_ot)
          modal.find('#data_ot').val(numero_ot)
          modal.find('#data_descripcion').val(descripcion)
          modal.find('#data_responsable').val(responsable)
          modal.find('#data_estatus').val(estatus)
        })
      });
    </script>

    <script>
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="template/js/sb-admin-2.min.js"></script>
</body>

</html>