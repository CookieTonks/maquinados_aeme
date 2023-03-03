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
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Ordenes de compras</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Barra de tareas</h6>
            <a class="collapse-item" href="{{ route('home_ordenes_compras') }}">Inicio</a>
            <a class="collapse-item" href="{{ route('home_requisiciones') }}">Requisiones</a>
            <a class="collapse-item" href="{{ route('home_partidas') }}">Partidas</a>
            <a class="collapse-item" href="{{ route('home_pago_compras') }}">Complementos de pago</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('home_proveedores')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Proveedores</span></a>
      </li>
      <hr class="sidebar-divider">

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


        <div class="modal fade" id="altamodal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Alta OC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('alta_ocompra')}}" method="post">
                  @csrf
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label>Entrega</label>
                      <input type="date" class="form-control" name="Entrega" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="validationDefault02">Condiciones pago</label>
                      <select class="custom-select" name="Condiciones_de_pago" required>
                        <option selected disabled>Selecciona...</option>
                        <option>Transferencia</option>
                        <option>Cheque al día</option>
                        <option>Cheque posfechado</option>
                        <option>Efectivo</option>
                        <option>Crédito</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Moneda</label>
                      <select id="inputState" name="moneda" required class="form-control">
                        <option selected>MXN</option>
                        <option>USD</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <select class="custom-select" name="Cliente[]" multiple>
                      <option selected disabled>Selecciona...</option>
                      <option value="-">-</option>
                      <optgroup label="GRUPO 1">
                        <option value="1001-Met.">1001-Met.</option>
                        <option value="1002-Fam.">1002-Fam.</option>
                        <option value="1003-Wei.">1003-Wei.</option>
                        <option value="1004-Mond.">1004-Mond.</option>
                        <option value="1005-Forj.">1005-Forj.</option>
                        <option value="1006-Mab.">1006-Mab.</option>
                      </optgroup>
                      <optgroup label="GRUPO 2">
                        <option value="2001-Kat.">2001-Kat.</option>
                        <option value="2002-Pola.">2002-Pola.</option>
                        <option value="2003-Curp.">2003-Cupr.</option>
                        <option value="2004-Wymn.">2004-Wymn.</option>
                        <option value="2005-Nidc.">2005-Nidc.</option>
                        <option value="2006-Sate.">2006-Sate.</option>
                        <option value="2007-Ten.">2007-Ten.</option>
                        <option value="2008-Vauto.">2008-Vauto.</option>
                        <option value="2009-Martr.">2009-Martr.</option>
                        <option value="2010-Rockw.">2010-Rockw.</option>
                        <option value="2011-Nav.">2011-Nav.</option>
                        <option value="2012-Reg.">2012-Reg.</option>
                        <option value="2013-Ced.">2013-Ced.</option>
                      </optgroup>
                      <optgroup label="GRUPO 3">
                        <option value="3001-Trans.">3001-Trans.</option>
                        <option value="3002-Thie.">3002-Thie.</option>
                        <option value="3003-Iind.">3003-Iind.</option>
                        <option value="3004-Copam.">3004-Copam.</option>
                        <option value="3005-Biop.">3005-Biop.</option>
                        <option value="3006-Carg.">3006-Carg.</option>
                        <option value="3007-Bt.">3007-Bt.</option>
                        <option value="3008-For.">3008-For.</option>
                        <option value="3009-Temp.">3009-Temp.</option>
                        <option value="3010-Mold.">3010-Mold.</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label>Observaciones</label>
                      <input type="text" class="form-control" name="Observaciones" required>
                    </div>
                  </div>
                  <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Begin Page Content -->
        <div class="card-body">

          <div class="d-sm-flex align-items justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SISTEMA ORDENES DE COMPRAS</h1>
            <a href="{{route('exportar_compras')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
          </div>
          <div class="d-sm-flex align-items justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="{{route('actualizacion_fecha_compras')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="far fa-clock fa-sm text-white-50"></i> Actualizar fecha</a>
          </div>


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

          <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
            <thead>
              <tr style="text-align: center;">
                <th>
                  <button type="button" class="btn btn-outline-primary btn-sm m-0 waves-effect" data-toggle="modal" data-target="#altamodal" style="width:90%; height:100%">
                    <i class="far fa-plus-square"></i>
                    Agregar
                  </button>
                </th>
                <th class="th-sm">Código</th>
                <th class="th-sm">Entrega</th>
                <th class="th-sm">Condiciones de pago</th>
                <th class="th-sm">Moneda</th>
                <th class="th-sm">Cliente</th>
                <th class="th-sm">Estatus Almacen</th>
                <th class="th-sm">Fecha Almacen</th>
                <th class="th-sm">Estatus Pago</th>
                <th class="th-sm">Dias sin pago</th>
                <th class="th-sm">Disponibilidad</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              @foreach($mostrar as $item)
              @if($item->alta_almacen=='PENDIENTE' && $item->alta_pago =='PAGADA' || $item->alta_almacen=='RECIBIDA' && $item->alta_pago =='PENDIENTE')
              <tr style="background:#f5ad42;">
                <td style="text-align: -moz-center;">
                  <div style="width: -moz-max-content;">
                    <a href="{{route('pdf_orden_compra', $item)}}" class="btn btn-info btn-sm"><i class="fas fa-file-upload"></i></a>
                    <a href="{{route('ver_ocompra',$item)}}" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
                    <a href="{{route('liberacion_oc',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                    <form action="{{route('baja_ocompra',$item)}}" methods="post" class="d-inline" id="miFormulario">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                    </form>
                    <script type="text/javascript">
                      (function() {
                        var form = document.getElementById('miFormulario');
                        form.addEventListener('submit', function(event) {
                          // si es false entonces que no haga el submit
                          if (!confirm('¿Realmente deseas eliminar?')) {
                            event.preventDefault();
                          }
                        }, false);
                      })();
                    </script>
                  </div>
                </td>
                <td>
                  <a style="color: #FFFFFF;" href="../storage/app/public/Ordenes_de_compras/{{$item->Codigo}}.pdf">{{$item->Codigo}}</a>
                </td>
                <td>{{$item->Entrega}}</td>
                <td>{{$item->Condiciones_de_pago}}</td>
                <td>{{$item->Moneda}}</td>
                <td>{{$item->Cliente}}</td>
                <td>{{$item->alta_almacen}}</td>
                <td>{{$item->fecha_almacen}}</td>
                <td>{{$item->alta_pago}}</td>
                @if($item->dias >= 30 && $item->alta_pago == 'PENDIENTE')
                <td style="background:#d91821;">
                  {{$item->dias}}
                </td>
                @else
                <td>
                  {{$item->dias}}
                </td>
                @endif
                <td>{{$item->Disponibilidad}}</td>
              </tr>
              @elseif($item->alta_almacen=='RECIBIDA' && $item->alta_pago =='PAGADA')
              <tr style="background:#47a80c;">
                <td style="text-align: -moz-center;">
                  <div style="width: -moz-max-content;">
                    <a href="{{route('pdf_orden_compra', $item)}}" class="btn btn-info btn-sm"><i class="fas fa-file-upload"></i></a>
                    <a href="{{route('ver_ocompra',$item)}}" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
                    <a href="{{route('liberacion_oc',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                    <form action="{{route('baja_ocompra',$item)}}" method="post" class="d-inline" id="miFormulario">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                    </form>
                    <script type="text/javascript">
                      (function() {
                        var form = document.getElementById('miFormulario');
                        form.addEventListener('submit', function(event) {
                          // si es false entonces que no haga el submit
                          if (!confirm('¿Realmente deseas eliminar?')) {
                            event.preventDefault();
                          }
                        }, false);
                      })();
                    </script>
                  </div>
                </td>
                <td>
                  <a style="color: #FFFFFF;" href="../storage/app/public/Ordenes_de_compras/{{$item->Codigo}}.pdf">{{$item->Codigo}}</a>
                </td>
                <td>{{$item->Entrega}}</td>
                <td>{{$item->Condiciones_de_pago}}</td>
                <td>{{$item->Moneda}}</td>
                <td>{{$item->Cliente}}</td>
                <td>{{$item->alta_almacen}}</td>
                <td>{{$item->fecha_almacen}}</td>
                <td>{{$item->alta_pago}}</td>
                @if($item->dias >= 30 && $item->alta_pago == 'PENDIENTE')
                <td style="background:#d91821;">
                  {{$item->dias}}
                </td>
                @else
                <td>
                  {{$item->dias}}
                </td>
                @endif
                <td>{{$item->Disponibilidad}}</td>
              </tr>
              @else
              <tr>
                <td style="text-align: -moz-center;">
                  <div style="width: -moz-max-content;">
                    <a href="{{route('pdf_orden_compra', $item)}}" class="btn btn-info btn-sm"><i class="fas fa-file-upload"></i></a>
                    <a href="{{route('ver_ocompra',$item)}}" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
                    <a href="{{route('liberacion_oc',$item)}}" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                    <form action="{{route('baja_ocompra',$item)}}" method="post" class="d-inline" id="miFormulario">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                    </form>
                    <script type="text/javascript">
                      (function() {
                        var form = document.getElementById('miFormulario');
                        form.addEventListener('submit', function(event) {
                          // si es false entonces que no haga el submit
                          if (!confirm('¿Realmente deseas eliminar?')) {
                            event.preventDefault();
                          }
                        }, false);
                      })();
                    </script>
                  </div>
                </td>
                <td>
                  <a href="../storage/app/public/Ordenes_de_compras/{{$item->Codigo}}.pdf">{{$item->Codigo}}</a>
                </td>
                <td>{{$item->Entrega}}</td>
                <td>{{$item->Condiciones_de_pago}}</td>
                <td>{{$item->Moneda}}</td>
                <td>{{$item->Cliente}}</td>
                <td>{{$item->alta_almacen}}</td>
                <td>{{$item->fecha_almacen}}</td>
                <td>{{$item->alta_pago}}</td>
                @if($item->dias >= 30 && $item->alta_pago == 'PENDIENTE')
                <td style="background:#d91821;">
                  {{$item->dias}}
                </td>
                @else
                <td>
                  {{$item->dias}}
                </td>
                @endif
                <td>{{$item->Disponibilidad}}</td>
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="../template/js/sb-admin-2.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#dtBasicExample').DataTable();
      });
    </script>
</body>

</html>