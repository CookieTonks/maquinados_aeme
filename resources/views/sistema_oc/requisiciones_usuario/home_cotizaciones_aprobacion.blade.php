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
        <a class="nav-link" href="{{ route('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->

      <!-- Nav Item - Utilities Collapse Menu -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        MENU
      </div>

      <!-- Nav Item - Charts -->
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

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="height:220px; width:150px; overflow:scroll;">
                <h6 class="dropdown-header">
                  Notificaciones
                </h6>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  {{ Auth::user()->name }}</span>
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
            <div class="table-responsive">
              <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                <thead>
                  <tr style="text-align: center;">
                    <th class="th-sm">REQUISICION</th>
                    <th class="th-sm">PARTIDA</th>
                    <th class="th-sm">USUARIO</th>
                    <th class="th-sm">CANTIDAD</th>
                    <th class="th-sm">UNIDAD</th>
                    <th class="th-sm">DESCRIPCION</th>
                    <th class="th-sm">MATERIAL</th>
                    <th class="th-sm">OT</th>
                    <th class="th-sm">CLIENTE</th>
                    <th class="th-sm">OC</th>
                    <th class="th-sm">MONEDA</th>
                    <th class="th-sm">PRECIO</th>
                    <th class="th-sm">MONTO TOTAL</th>
                    <th class="th-sm">PRECIO AUTORIZADO</th>
                    <th class="th-sm">(1) PROVEEDOR</th>
                    <th class="th-sm">(1) P/U</th>
                    <th class="th-sm">(2) PROVEEDOR</th>
                    <th class="th-sm">(2) P/U</th>
                    <th class="th-sm">(3) PROVEEDOR</th>
                    <th class="th-sm">(3) P/U</th>
                    <th class="th-sm">F.ENTREGA</th>
                  </tr>
                </thead>
                <tbody style="text-align: center;text-align: -webkit-center;">
                  @foreach($requisicion_partidas as $requisicion_partida)
                  @if($requisicion_partida->precio_unitario == NULL)
                  <tr class="table-danger">
                    <td> {{$requisicion_partida->requisicion}} </td>
                    <td> {{$requisicion_partida->partida}} </td>
                    <td> {{$requisicion_partida->usuario}} </td>
                    <td> {{$requisicion_partida->cantidad}} </td>
                    <td> {{$requisicion_partida->unidad}} </td>
                    <td> {{$requisicion_partida->descripcion}} </td>
                    <td> {{$requisicion_partida->material}} </td>
                    <td> {{$requisicion_partida->ot}} </td>
                    <td> {{$requisicion_partida->cliente}} </td>
                    <td> {{$requisicion_partida->orden_compra}} </td>
                    <td> {{$requisicion_partida->moneda}} </td>
                    <td>
                      <?php
                      $importe = $requisicion_partida->monto;
                      $importe = number_format($importe, 2);
                      echo "$" . $importe;
                      ?>
                    </td>
                    <td>
                      <?php
                      $importe = $requisicion_partida->monto_total;
                      $importe = number_format($importe, 2);
                      echo "$" . $importe;
                      ?>
                    </td>
                    <td>
                      <?php
                      $importe = $requisicion_partida->precio_unitario;
                      $importe = number_format($importe, 2);
                      echo "$" . $importe;
                      ?>
                    </td>
                    <td> {{$requisicion_partida->prov_uno}} </td>
                    <td> <a href="{{route('home_cotizacion_aprobacion_uno',$requisicion_partida->id)}}">
                        <?php
                        $importe = $requisicion_partida->pu_uno;
                        $importe = number_format($importe, 2);
                        echo "$" . $importe;
                        ?>
                      </a>
                    </td>
                    <td> {{$requisicion_partida->prov_dos}} </td>
                    <td> <a href="{{route('home_cotizacion_aprobacion_dos',$requisicion_partida->id)}}">
                        <?php
                        $importe = $requisicion_partida->pu_dos;
                        $importe = number_format($importe, 2);
                        echo "$" . $importe;
                        ?></a> </td>
                    <td> {{$requisicion_partida->prov_tres}} </td>
                    <td> <a href="{{route('home_cotizacion_aprobacion_tres',$requisicion_partida->id)}}">
                        <?php
                        $importe = $requisicion_partida->pu_tres;
                        $importe = number_format($importe, 2);
                        echo "$" . $importe;
                        ?> </a> </td>
                    <td> {{$requisicion_partida->fecha_entrega}} </td>
                  </tr>
                  @else
                  <tr class="table-success">
                    <td> {{$requisicion_partida->requisicion}} </td>
                    <td> {{$requisicion_partida->partida}} </td>
                    <td> {{$requisicion_partida->usuario}} </td>
                    <td> {{$requisicion_partida->cantidad}} </td>
                    <td> {{$requisicion_partida->unidad}} </td>
                    <td> {{$requisicion_partida->descripcion}} </td>
                    <td> {{$requisicion_partida->material}} </td>
                    <td> {{$requisicion_partida->ot}} </td>
                    <td> {{$requisicion_partida->cliente}} </td>
                    <td> {{$requisicion_partida->orden_compra}} </td>
                    <td> {{$requisicion_partida->moneda}} </td>
                    <td>
                      <?php
                      $importe = $requisicion_partida->monto;
                      $importe = number_format($importe, 2);
                      echo "$" . $importe;
                      ?>
                    </td>
                    <td>
                      <?php
                      $importe = $requisicion_partida->monto_total;
                      $importe = number_format($importe, 2);
                      echo "$" . $importe;
                      ?>
                    </td>
                    <td>
                      <?php
                      $importe = $requisicion_partida->precio_unitario;
                      $importe = number_format($importe, 2);
                      echo "$" . $importe;
                      ?>
                    </td>
                    <td> {{$requisicion_partida->prov_uno}} </td>
                    <td> <a href="{{route('home_cotizacion_aprobacion_uno',$requisicion_partida->id)}}">
                        <?php
                        $importe = $requisicion_partida->pu_uno;
                        $importe = number_format($importe, 2);
                        echo "$" . $importe;
                        ?>
                      </a>
                    </td>
                    <td> {{$requisicion_partida->prov_dos}} </td>
                    <td> <a href="{{route('home_cotizacion_aprobacion_dos',$requisicion_partida->id)}}">
                        <?php
                        $importe = $requisicion_partida->pu_dos;
                        $importe = number_format($importe, 2);
                        echo "$" . $importe;
                        ?></a> </td>
                    <td> {{$requisicion_partida->prov_tres}} </td>
                    <td> <a href="{{route('home_cotizacion_aprobacion_tres',$requisicion_partida->id)}}">
                        <?php
                        $importe = $requisicion_partida->pu_tres;
                        $importe = number_format($importe, 2);
                        echo "$" . $importe;
                        ?> </a> </td>
                    <td> {{$requisicion_partida->fecha_entrega}} </td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
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
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js">
        </script>
        <script>
          $(document).ready(function() {
            $('#dtBasicExample').DataTable();
          });
        </script>
</body>

</html>