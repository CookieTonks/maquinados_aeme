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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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
          <h1>SISTEMA CALIDAD</H1>
          <div class="table-responsive">
            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
              <thead>
                <tr style="text-align: center;">
                  <th></th>
                  <th>#FOLIO</th>
                  <th>#OT</th>
                  <th>DESCRIPCION</th>
                  <th>CANTIDAD</th>
                  <th>CLIENTE</th>
                  <th># PARTE</th>
                </tr>
              </thead>
              <tbody>
                @foreach($mostrar as $item)
                <tr style="text-align: center;">
                  <td>
                    <div class="col text-center">
                      <button type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#calidad_salida" data-id="{{$item->id}}" data-numero_ot="{{$item->ot}}" data-descripcion="{{$item->descripcion}}"><i class="fas fa-check"></i></button>
                      <a href="{{route('calidad_produccion', $item->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></a>
                    </div>
                  </td>
                  <td>{{$item->id}} </td>
                  <td><a style="color:black !important;" href="../storage/app/public/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                  <td>{{$item->descripcion}} </td>
                  <td>{{$item->cant_pieza}}</td>
                  <td>{{$item->cliente}}</td>
                  <td>{{$item->codigo_pieza}}</td>
                </tr>
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



    <div class="modal fade" id="calidad_salida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">SALIDAD DE CALIDAD: </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('calidad_embarques')}}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-3 mb-3">
                  <label>#FOLIO</label>
                  <input id="folio" type="text" class="form-control" name="folio" readonly>
                </div>
                <div class="col-md-3 mb-3">
                  <label>OT</label>
                  <input id="numero_ot" type="text" class="form-control" name="numero_ot" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="descripcion" type="text" class="form-control" name="descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>TIPO DE LIBERACIÓN</label>
                  <select id="tipo_liberacion" class="custom-select" name="tipo_liberacion" required>
                    <option selected disabled>SELECCIONA...</option>
                    <option>CLIENTE</option>
                    <option>TRATAMIENTO</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label>CANT</label>
                  <input id="cantidad" type="text" class="form-control" name="cantidad">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>TRATAMIENTO</label>
                  <select id="tratamiento" class="custom-select" name="tratamiento" required>
                    <option selected disabled>SELECCIONA...</option>
                    <option>TEMPLADO</option>
                    <option>TROPICALIZADO</option>
                    <option>NITRURADO</option>
                    <option>CROMADO</option>
                    <option>PAVONADO</option>
                    <option>NIQUELADO</option>
                    <option>GALVANIZADO</option>
                    <option>RECTIFICADO</option>
                    <option>GENERADO</option>
                    <option>ANODIZADO</option>
                    <option>LUMENA</option>
                    <option>ALCRONA</option>
                    <option>OTRO</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>INSPECCIÓN</label>
                  <select id="inspeccion" class="custom-select" name="inspeccion" required>
                    <option selected disabled>SELECCIONA...</option>
                    <option>JESUS PEREZ</option>
                    <option>JORGE LOPEZ</option>
                    <option>DANIEL ALVARADO</option>
                    <option>JESUS FRANCO</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>OBSERVACIONES</label>
                  <input id="observaciones" type="text" class="form-control" name="observaciones">
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">Guardar cambios</button>
            </form>
          </div>
        </div>
      </div>
    </div>
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
        $('#calidad_salida').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget)
          var numero_ot = button.data('numero_ot')
          var folio = button.data('id')
          var descripcion = button.data('descripcion')

          var modal = $(this)
          modal.find('.modal-title').text('FOLIO DE SALIDA : ' + folio)
          modal.find('#numero_ot').val(numero_ot)
          modal.find('#folio').val(folio)

          modal.find('#descripcion').val(descripcion)

        })
      });
    </script>

    <script>
      $("#tipo_liberacion").change(function() {
        if ($("#tipo_liberacion").val() !== "CLIENTE") {
          $('#tratamiento').prop('disabled', false);
        } else {
          $('#tratamiento').prop('disabled', 'disabled');
        }
      });
    </script>
</body>

</html>