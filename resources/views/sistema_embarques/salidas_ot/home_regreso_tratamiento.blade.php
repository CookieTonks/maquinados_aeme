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
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home_ingreso_rechazo')}}">
          <i class="fas fa-address-book"></i>
          <span>Rechazo</span></a>
      </li>

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home_regreso_tratamiento')}}">
          <i class="fas fa-address-book"></i>
          <span>Retorno de tratamiento</span></a>
      </li>

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home_remisiones')}}">
          <i class="fas fa-address-book"></i>
          <span>Remision sin OT</span></a>
      </li>

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="{{route('buscador_embarques')}}">
          <i class="fas fa-address-book"></i>
          <span> Buscador de salidas</span></a>
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
            <!-- Content Row -->
            <h1>SISTEMA EMBARQUES TRATAMIENTO</H1>

            <div class="table-responsive">
              <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                <thead>
                  <tr style="text-align: center;">
                    <th></th>
                    <th># OT</th>
                    <th>DESCRIPCION</th>
                    <th>TIPO SALIDA</th>
                    <th>SALIDA PRODUCCION</th>
                    <th>TRATAMIENTO</th>
                    <th>OBSERVACIONES</th>
                    <th>ESTATUS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($salidas as $salida)
                  <tr style="text-align: center;">
                    <td>
                      <div class="col text-center">
                        <button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#regreso_calidad" data-numero_ot="{{$salida->ot}}" data-id="{{$salida->id}}" data-descripcion="{{$salida->descripcion}}"><i class="fas fa-clipboard-check"></i></button>
                        <button type="button" class="btn btn-secondary  btn-sm" data-toggle="modal" data-target="#regreso_produccion" data-numero_ot="{{$salida->ot}}" data-id="{{$salida->id}}" data-descripcion="{{$salida->descripcion}}"><i class="fas fa-cog"></i></button>
                      </div>
                    </td>
                    <td><a style="color:black !important;" href="../storage/app/public/Dibujo_OT/{{$salida->orden_trabajo}}/{{$salida->orden_trabajo}}.pdf">{{$salida->ot}}</a></td>
                    <td>{{$salida->descripcion}}</td>
                    <td>{{$salida->tipo_salida}}</td>
                    <td>{{$salida->produccion_salida}}</td>
                    <td>{{$salida->tratamiento}}</td>
                    <td>{{$salida->observaciones}}</td>
                    <td>{{$salida->estatus}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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

    |
    <!-- Modals para regreso de tratamiento a calidad -->
    <div class="modal fade" id="regreso_calidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Regreso de tratamiento a calidad</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('tratamiento_calidad')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label>FOLIO SALIDA</label>
                  <label class="sr-only" for="inlineFormInputGroup"></label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">SC-</div>
                    </div>
                    <input type="text" class="form-control" id="id" name="id" placeholder="id" readonly>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label>OT</label>
                  <input type="text" class="form-control" id="numero_ot" name="numero_ot" required value="" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label>CANT</label>
                  <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OBSERVACIONES</label>
                  <input type="text" class="form-control" name="observaciones" required>
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

    <div class="modal fade" id="regreso_produccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">SALIDA PARA TRATAMIENTO</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('tratamiento_producccion')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label>FOLIO SALIDA</label>
                  <label class="sr-only" for="inlineFormInputGroup"></label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">SC-</div>
                    </div>
                    <input type="text" class="form-control" id="id" name="id" placeholder="id" readonly>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label>OT</label>
                  <input type="text" class="form-control" id="numero_ot" name="numero_ot" required readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label>CANT. PIEZAS</label>
                  <input required type="text" class="form-control" name="cant_pieza">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OBSERVACIONES</label>
                  <input type="text" class="form-control" name="observaciones">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-block" type="submit">REGISTRAR SALIDA A TRATAMIENTO</button>
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
      $('#regreso_calidad').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var numero_ot = button.data('numero_ot')
        var id = button.data('id')

        var modal = $(this)
        modal.find('.modal-title').text('REGRESO A CALIDAD : SC- ' + id)
        modal.find('#id').val(id)
        modal.find('#numero_ot').val(numero_ot)

      })
    });
  </script>


  <script>
    $(document).ready(function() {
      $('#regreso_produccion').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var id = button.data('id')
        var numero_ot = button.data('numero_ot')


        var modal = $(this)
        modal.find('.modal-title').text('REGRESO A PRODUCCION : SC- ' + id)
        modal.find('#id').val(id)
        modal.find('#numero_ot').val(numero_ot)


      })
    });
  </script>



</body>

</html>