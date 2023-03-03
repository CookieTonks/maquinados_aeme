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
    <link href="../template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- Custom styles for this template-->
    <link href="../template/css/sb-admin-2.min.css" rel="stylesheet">
        <style>
        .table
        {
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

          <!-- Nav Item - Pages Collapse Menu -->


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

                      <!-- Nav Item - Alerts -->
                      <li class="nav-item dropdown no-arrow mx-1">
                          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-bell fa-fw"></i>
                              <!-- Counter - Alerts -->
                              <span class="badge badge-danger badge-counter"></span>
                          </a>
                          <!-- Dropdown - Alerts -->

                      </li>
                      <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" data-toggle="modal" href="href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"">                                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
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
                    <form action="{{route('home_cotizaciones_partidas_registro', $cotizacion)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                      <div class="form-row">
                        <div class="col-md-1 mb-3">
                          <label># COTIZACION</label>
                          <input type="text" class="form-control" name="numero_cotizacion"  value="{{$cotizacion->numero_cotizacion}}" readonly>
                        </div>
                        <div class="col-md-1 mb-3">
                          <label># PARTIDA</label>
                          <input type="text" class="form-control" name="partida_cotizacion" value="{{$nueva_cotizacion_partida}}" readonly >
                        </div>
                        <div class="col-md-2 mb-3">
                          <label>DESCRIPCION</label>
                          <input type="text" class="form-control" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" value="" required>
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>CANTIDAD</label>
                          <input type="text" class="form-control" name="cantidad" required >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>P/U</label>
                          <input type="text" class="form-control" name="precio_unitario" required >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label># PARTE</label>
                          <input type="text" class="form-control" name="numero_parte" required  >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>REVISION</label>
                          <input type="text" class="form-control" name="revision" required >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>TIPO ACERO</label>
                          <input type="text" class="form-control" name="tipo_acero" required >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>VIGENCIA</label>
                          <input type="text" class="form-control" name="vigencia" required >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>DIBUJO</label>
                          <input type="file" class="form-control" name="comprobante"  >
                        </div>
                        <div class="col-md-1 mb-3">
                          <label>AGREGAR</label>
                          <button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i></button>
                        </div>
                      </div>
                    </form>
                    <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                  <thead>
                    <tr style="text-align: center;">
                      <th class="th-sm">ACCIONES</th>
                      <th class="th-sm"># COTIZACION</th>
                      <th class="th-sm"># PARTIDA</th>
                      <th class="th-sm">DESCRIPCION</th>
                      <th class="th-sm">CANTIDAD</th>
                      <th class="th-sm">VIGENCIA</th>
                      <th class="th-sm">P/U</th>
                      <th class="th-sm">PRECIO TOTAL</th>
                    </tr>
                  </thead>
                  <tbody style="text-align: center;text-align: -webkit-center;">
                    @foreach($cotizacion_partida as $cotizacion)
                    @if($cotizacion->precio_unitario == '0')
                    <tr class="table-danger">
                      <td>
                        <div style="width: -moz-max-content;width: max-content;">
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_partida_cotizacion" data-descripcion="{{$cotizacion->descripcion}}" data-partida="{{$cotizacion->numero_cotizacion_partida}}" data-cotizacion="{{$cotizacion->numero_cotizacion}}"><i class="fas fa-dollar-sign"></i></button>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edicion_partida_cotizacion" data-cotizacion = "{{$cotizacion->numero_cotizacion}}" data-partida = "{{$cotizacion->numero_cotizacion_partida}}" data-descripcion = "{{$cotizacion->descripcion}}" data-cantidad = "{{$cotizacion->cantidad}}" data-pu = "{{$cotizacion->precio_unitario}}" ><i class="far fa-edit"></i></button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_partida_cotizacion" data-cotizacion = "{{$cotizacion->numero_cotizacion}}" data-partida = "{{$cotizacion->numero_cotizacion_partida}}" data-descripcion = "{{$cotizacion->descripcion}}" data-cantidad = "{{$cotizacion->cantidad}}" data-pu = "{{$cotizacion->precio_unitario}}" ><i class="fas fa-trash"></i></button>
                        </div>
                      </td>
                      <td>{{$cotizacion->numero_cotizacion}}</td>
                      <td><a href="../../storage/Cotizaciones/{{$cotizacion->numero_cotizacion}}/{{$cotizacion->id}}.pdf" class="link-primary">{{$cotizacion->numero_cotizacion_partida}}</a></td>
                      <td>{{$cotizacion->descripcion}}</td>
                      <td>{{$cotizacion->cantidad}}</td>
                      <td>{{$cotizacion->vigencia}}</td>
                      <td>  <?php
                          $importe = $cotizacion->precio_unitario;
                          $importe = number_format($importe,2);
                          echo "$". $importe;
                        ?></td>
                        <td>  <?php
                            $importe = $cotizacion->partida_total;
                            $importe = number_format($importe,2);
                            echo "$". $importe;
                          ?></td>
                    </tr>
                    @else
                    <tr class="table-success">
                      <td>
                        <div style="width: -moz-max-content;width: max-content;">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edicion_partida_cotizacion" data-cotizacion = "{{$cotizacion->numero_cotizacion}}" data-partida = "{{$cotizacion->numero_cotizacion_partida}}" data-descripcion = "{{$cotizacion->descripcion}}" data-cantidad = "{{$cotizacion->cantidad}}" data-pu = "{{$cotizacion->precio_unitario}}" ><i class="far fa-edit"></i></button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_partida_cotizacion" data-cotizacion = "{{$cotizacion->numero_cotizacion}}" data-partida = "{{$cotizacion->numero_cotizacion_partida}}" data-descripcion = "{{$cotizacion->descripcion}}" data-cantidad = "{{$cotizacion->cantidad}}" data-pu = "{{$cotizacion->precio_unitario}}" ><i class="fas fa-trash"></i></button>
                        </div>
                      </td>
                      <td>{{$cotizacion->numero_cotizacion}}</td>
                      <td><a href="../../storage/Cotizaciones/{{$cotizacion->numero_cotizacion}}/{{$cotizacion->id}}.pdf" class="link-primary">{{$cotizacion->numero_cotizacion_partida}}</a></td>
                      <td>{{$cotizacion->descripcion}}</td>
                      <td>{{$cotizacion->cantidad}}</td>
                      <td>{{$cotizacion->vigencia}}</td>
                      <td>  <?php
                          $importe = $cotizacion->precio_unitario;
                          $importe = number_format($importe,2);
                          echo "$". $importe;
                        ?></td>
                        <td>  <?php
                            $importe = $cotizacion->partida_total;
                            $importe = number_format($importe,2);
                            echo "$". $importe;
                          ?></td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <a href="{{route('home_cotizaciones')}}" class="btn btn-primary btn-block">Regresar</a>
                </div>
                <div class="col-md-6 mb-3">
                  <a href="{{route('cotizacion_pdf', $cotizacion)}}" class="btn btn-success btn-block"> CREAR COTIZACION</a>
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
    s

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

    <div class="modal fade" id="modal_partida_cotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Alta OC</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('partida_precio_unitario')}}" method="post">
                      @csrf
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>#COTIZACION</label>
                          <input id="numero_cotizacion" type="text" class="form-control" name="numero_cotizacion" readonly >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label># PARTIDA </label>
                          <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>DESCRIPCION</label>
                          <input id="descripcion" type="text" class="form-control" name="descripcion" readonly >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>P/U </label>
                          <input id="precio_unitario" type="text" class="form-control" name="precio_unitario"  >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>VIGENCIA </label>
                          <input id="vigencia" type="text" class="form-control" name="vigencia"  >
                        </div>
                      </div>
                    <button class="btn btn-success btn-block" type="submit">Guardar</button>
                  </form>
                </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="edicion_partida_cotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edicion de partida</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('edicion_partida_cotizacion')}}" method="post">
                      @csrf
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>#COTIZACION</label>
                          <input id="numero_cotizacion" type="text" class="form-control" name="numero_cotizacion" readonly >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label># PARTIDA </label>
                          <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>DESCRIPCION</label>
                          <input id="descripcion" type="text" class="form-control" name="descripcion"  >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>CANTIDAD</label>
                          <input id="cantidad" type="text" class="form-control" name="cantidad"  >
                        </div>
                        <div class="col-md-12 mb-3">
                          <label>P/U </label>
                          <input id="precio_unitario" type="text" class="form-control" name="precio_unitario"  >
                        </div>
                      </div>
                    <button class="btn btn-success btn-block" type="submit">Guardar</button>
                  </form>
                </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="delete_partida_cotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Eliminacion de partida</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('delete_partida_cotizacion')}}" method="post">
                      @csrf
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label>#COTIZACION</label>
                          <input id="numero_cotizacion" type="text" class="form-control" name="numero_cotizacion" readonly >
                        </div>
                        <div class="col-md-6 mb-3">
                          <label># PARTIDA </label>
                          <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>DESCRIPCION</label>
                          <input id="descripcion" type="text" class="form-control" name="descripcion" readonly >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <label>CANTIDAD</label>
                          <input id="cantidad" type="text" class="form-control" name="cantidad"  readonly  >
                        </div>
                        <div class="col-md-12 mb-3">
                          <label>P/U </label>
                          <input id="precio_unitario" type="text" class="form-control" name="precio_unitario"  readonly>
                        </div>
                      </div>
                    <button class="btn btn-danger btn-block" type="submit">Eliminar</button>
                  </form>
                </div>
          </div>
        </div>
    </div>

    <script>
       $(document).ready(function(){
            $('#modal_partida_cotizacion').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget) // Button that triggered the modal
         var numero_cotizacion = button.data('cotizacion')
         var numero_partida = button.data('partida')
          var descripcion = button.data('descripcion')
          // Extract info from data-* attributes
         // We are jquery here to update the modal's content
         var modal = $(this)
         modal.find('.modal-title').text('Edicion de partida: ' + numero_cotizacion)
         modal.find('#numero_cotizacion').val(numero_cotizacion)
         modal.find('#numero_partida').val(numero_partida)
         modal.find('#descripcion').val(descripcion)
       })
       });
    </script>

    <script>
       $(document).ready(function(){
         $('#edicion_partida_cotizacion').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget) // Button that triggered the modal
         var numero_cotizacion = button.data('cotizacion')
         var numero_partida = button.data('partida')
         var descripcion = button.data('descripcion')
         var cantidad = button.data('cantidad')
         var precio_unitario = button.data('pu')

         var modal = $(this)
         modal.find('.modal-title').text('Edicion de partida: ' + numero_cotizacion)
         modal.find('#numero_cotizacion').val(numero_cotizacion)
         modal.find('#numero_partida').val(numero_partida)
         modal.find('#descripcion').val(descripcion)
         modal.find('#cantidad').val(cantidad)
         modal.find('#precio_unitario').val(precio_unitario)
       })
       });
    </script>

    <script>
       $(document).ready(function(){
         $('#delete_partida_cotizacion').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget) // Button that triggered the modal
         var numero_cotizacion = button.data('cotizacion')
         var numero_partida = button.data('partida')
         var descripcion = button.data('descripcion')
         var cantidad = button.data('cantidad')
         var precio_unitario = button.data('pu')

         var modal = $(this)
         modal.find('.modal-title').text('Estas a punto de eliminar esta partida : ' + numero_cotizacion)
         modal.find('#numero_cotizacion').val(numero_cotizacion)
         modal.find('#numero_partida').val(numero_partida)
         modal.find('#descripcion').val(descripcion)
         modal.find('#cantidad').val(cantidad)
         modal.find('#precio_unitario').val(precio_unitario)
       })
       });
    </script>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="../template/js/sb-admin-2.min.js"></script>
</body>
</html>
