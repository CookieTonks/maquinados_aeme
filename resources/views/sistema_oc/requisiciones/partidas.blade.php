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

      <!-- Sidebar Message
                       <div class="sidebar-card d-none d-lg-flex">
                            <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                            <p class="text-center mb-2"><strong>Maquinados AEME</strong></p>
                            <a class="btn btn-success btn-sm" h ref="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
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
        <div class="modal fade" id="exampleModal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Asignar Orden de compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('asignar_oc')}}" method="get">
                  @method('GET')
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label>Requisicion</label>
                      <input type="text" class="form-control" name="requisicion_oc" value="{{$mostrar->requisicion}}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label>ORDEN DE COMPRA</label>
                      <select name="no_oc" id="Cliente_id" class="form-control">
                        <option value="" class="form-control">Selecciona OC</option>
                        @foreach($oc as $item)
                        <option value="{{$item->Codigo}}" class="form-control" name="no_oc"> {{$item->Codigo}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label>PROVEEDOR</label>
                      <select name="proveedor" id="proveedor_id" class="form-control">
                        <option value="" class="form-control">Selecciona Proveedor</option>
                        @foreach($proveedor as $item)
                        <option value="{{$item->Rsocial}}" class="form-control" name="proveedor"> {{$item->Rsocial}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div>
              <button class="btn btn-primary btn-block" type="submit">Asignar</button>
              </form>
            </div>
          </div>
        </div>
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
          <form action="{{route('alta_partidas', $mostrar)}}" method="post">
            @method('PUT')
            <div class="form-row">
              <div class="col-md-1 mb-3">
                <label>Requisicion</label>
                <input type="text" class="form-control" name="requisicion" value="{{$mostrar->requisicion}}" readonly>
              </div>
              <div class="col-md-1 mb-3">
                <label>Partida</label>
                <input type="text" class="form-control" name="partida" value="{{$partida_nueva}}" readonly>
              </div>
              <div class="col-md-2 mb-3">
                <label>Descripcion</label>
                <input type="text" class="form-control" name="descripcion" value="">
              </div>
              <div class="col-md-1 mb-3">
                <label>Cantidad</label>
                <input type="text" class="form-control" name="cantidad" value="">
              </div>
              <div class="col-md-1 mb-3">
                <label>Unidad</label>
                <input type="text" class="form-control" name="unidad" value="">
              </div>
              <div class="col-md-1 mb-3">
                <label>P/U</label>
                <input type="text" class="form-control" name="precio_unitario" value="">
              </div>
              <div class="col-md-1 mb-3">
                <label for="validationDefault02">Proveedores</label>
                <select name="proveedor" id="proveedor_id" class="form-control">
                  <option value="" class="form-control"></option>
                  @foreach($proveedor as $item)
                  <option value="{{$item->Rsocial}}" class="form-control" name="no_oc"> {{$item->Rsocial}} </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-1 mb-3">
                <label>Material</label>
                <input type="text" class="form-control" name="material" value="">
              </div>
              <div class="col-md-1 mb-3">
                <label>OT</label>
                <input type="text" class="form-control" name="ot" value="">
              </div>
              <div class="col-md-1 mb-3">
                <label>Agregar</label>
                <br>
                <button class="btn btn-success "><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <br>


            <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
              <thead>
                <tr style="text-align: center;">
                  <th class="th-sm">ACCIONES</th>
                  <th class="th-sm">REQUISICION</th>
                  <th class="th-sm">PARTIDA</th>
                  <th class="th-sm">DESCRIPCION</th>
                  <th class="th-sm">CANTIDAD</th>
                  <th class="th-sm">UNIDAD</th>
                  <th class="th-sm">P/U</th>
                  <th class="th-sm">MATERIAL</th>
                  <th class="th-sm">PROVEEDOR</th>
                  <th class="th-sm">CLIENTE</th>
                  <th class="th-sm">OT</th>
                  <th class="th-sm">FACTURA</th>
                  <th class="th-sm">OC</th>
                </tr>
              </thead>
              <tbody style="text-align: center;text-align: -webkit-center;">
                @foreach($partida as $partida)
                <tr>
                  <td>
                    <button type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#delete_partida_requisicion2" data-requisicion="{{$partida->requisicion}}" data-numero_id="{{$partida->id}}" data-partida="{{$partida->partida}}" data-descripcion="{{$partida->descripcion}}" data-material="{{$partida->material}}" data-cantidad="{{$partida->cantidad}}" data-precio_unitario="{{$partida->precio_unitario}}" data-proveedor="{{$partida->proveedor}}" data-cliente="{{$partida->cliente}}" data-ot="{{$partida->ot}}" data-factura="{{$partida->factura}}" data-oc="{{$partida->orden_compra}}" data-tp="{{$partida->tipo_requisicion}}"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_partida_requisicion" data-requisicion="{{$partida->requisicion}}" data-numero_id="{{$partida->id}}" data-partida="{{$partida->partida}}" data-descripcion="{{$partida->descripcion}}" data-cantidad="{{$partida->cantidad}}" data-precio_unitario="{{$partida->precio_unitario}}" data-proveedor="{{$partida->proveedor}}" data-cliente="{{$partida->cliente}}" data-ot="{{$partida->ot}}" data-factura="{{$partida->factura}}" data-oc="{{$partida->orden_compra}}" data-tp="{{$partida->tipo_requisicion}}"><i class="fas fa-minus-circle"></i></button>
                  </td>
                  <td>{{$partida->requisicion}}</td>
                  <td>{{$partida->partida}}</td>
                  <td>{{$partida->descripcion}}</td>
                  <td>{{$partida->cantidad}}</td>
                  <td>{{$partida->unidad}}</td>
                  <td>{{$partida->precio_unitario}}</td>
                  <td>{{$partida->material}}</td>
                  <td>{{$partida->proveedor}}</td>
                  <td>{{$partida->cliente}}</td>
                  <td>{{$partida->ot}}</td>
                  <td>{{$partida->factura}}</td>
                  <td>{{$partida->orden_compra}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="form-row">
              <div class="col-md-3">
                <a href="{{route('home_requisiciones_compras_pendientes')}}" class="btn btn-primary btn-block"> REGRESAR</a>
              </div>
              <div class="col-md-3">
                <a href="{{route('pdf_herramienta', $mostrar)}}" class="btn btn-secondary btn-block"> HERRAMIENTAS</a>
              </div>
              <div class="col-md-3">
                <a href="{{route('pdf_material', $mostrar)}}" class="btn btn-secondary btn-block"> MATERIAL </a>
              </div>
              <div class="col-md-3">
                <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-block"> OC / PROVEEDOR </a>
              </div>
            </div>
            @csrf
          </form>
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


    <div class="modal fade" id="delete_partida_requisicion2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edicion de partidas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('edicion_partida_requisicion')}}" method="post">
              @csrf
              <div class="form-row">
              <div class="col-md-4 mb-3">
                  <label>ID</label>
                  <input id="numero_id" type="text" class="form-control" name="numero_id" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label># REQUISICION</label>
                  <input id="numero_requisicion" type="text" class="form-control" name="numero_cotizacion" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label># PARTIDA</label>
                  <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="descripcion" type="text" class="form-control" name="descripcion">
                </div>
              </div>
               <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>MATERIAL</label>
                                        <input id="material" type="text" class="form-control" name="material" >
                                    </div>
                                </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>CANTIDAD</label>
                  <input id="cantidad" type="text" class="form-control" name="cantidad">
                </div>
                <div class="col-md-6 mb-3">
                  <label>P/U</label>
                  <input id="precio_unitario" type="text" class="form-control" name="precio_unitario">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>PROVEEDOR</label>
                  <select name="proveedor" id="proveedor_id" class="form-control">
                    @foreach($proveedor as $item)
                    <option value="{{$item->Rsocial}}" class="form-control" name="no_oc"> {{$item->Rsocial}} </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label>OT</label>
                  <input id="ot" type="text" class="form-control" name="ot">
                </div>
                <div class="col-md-4 mb-3">
                  <label>FACTURA</label>
                  <input id="factura" type="text" class="form-control" name="factura">
                </div>
                <div class="col-md-4 mb-3">
                  <label>OC</label>
                  <input id="oc" type="text" class="form-control" name="oc">
                </div>
              </div>
              <button class="btn btn-success btn-block" type="submit">Guardar cambios</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="delete_partida_requisicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Eliminacion de partidas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('delete_partida_requisicion')}}" method="post">
              @csrf
              <div class="form-row">
              <div class="col-md-4 mb-3">
                  <label>ID</label>
                  <input id="numero_id" type="text" class="form-control" name="numero_id" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label># REQUISICION</label>
                  <input id="numero_requisicion" type="text" class="form-control" name="numero_cotizacion" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label># PARTIDA</label>
                  <input id="numero_partida" type="text" class="form-control" name="numero_partida" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>DESCRIPCION</label>
                  <input id="descripcion" type="text" class="form-control" name="descripcion" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>CANTIDAD</label>
                  <input id="cantidad" type="text" class="form-control" name="cantidad" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label>P/U</label>
                  <input id="precio_unitario" type="text" class="form-control" name="precio_unitario" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>PROVEEDOR</label>
                  <input id="proveedor" type="text" class="form-control" name="proveedor" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label>CLIENTE</label>
                  <input id="precio_unitario" type="text" class="form-control" name="cliente" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label>OT</label>
                  <input id="ot" type="text" class="form-control" name="ot" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label>FACTURA</label>
                  <input id="factura" type="text" class="form-control" name="factura" readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label>OC</label>
                  <input id="oc" type="text" class="form-control" name="oc" readonly>
                </div>
              </div>
              <button class="btn btn-danger btn-block" type="submit">Eliminar</button>
            </form>
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

    <script>
      $(document).ready(function() {
        $('#delete_partida_requisicion').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_requisicion = button.data('requisicion')
          var numero_id = button.data('numero_id')
          var numero_partida = button.data('partida')
          var descripcion = button.data('descripcion')
          var precio_unitario = button.data('precio_unitario')
          var cantidad = button.data('cantidad')
          var unidad = button.data('unidad')
          var proveedor = button.data('proveedor')
          var cliente = button.data('cliente')
          var ot = button.data('ot')
          var factura = button.data('factura')
          var oc = button.data('oc')
          var tp = button.data('tp')
        var material = button.data('material')


          var modal = $(this)
          modal.find('.modal-title').text('Estas a punto de eliminar esta partidaa : ' + numero_partida)
          modal.find('#numero_requisicion').val(numero_requisicion)
          modal.find('#numero_id').val(numero_id)
          modal.find('#numero_partida').val(numero_partida)
          modal.find('#descripcion').val(descripcion)
          modal.find('#cantidad').val(cantidad)
          modal.find('#precio_unitario').val(precio_unitario)
          modal.find('#unidad').val(unidad)
          modal.find('#proveedor').val(proveedor)
          modal.find('#cliente').val(cliente)
          modal.find('#ot').val(ot)
          modal.find('#factura').val(factura)
          modal.find('#oc').val(oc)
                          modal.find('#material').val(material)

        })
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#delete_partida_requisicion2').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var numero_requisicion = button.data('requisicion')
          var numero_id = button.data('numero_id')
          var numero_partida = button.data('partida')
          var descripcion = button.data('descripcion')
          var precio_unitario = button.data('precio_unitario')
          var cantidad = button.data('cantidad')
          var unidad = button.data('unidad')
          var proveedor = button.data('proveedor')
          var ot = button.data('ot')
          var factura = button.data('factura')
          var oc = button.data('oc')
          var tp = button.data('tp')
                                          var material = button.data('material')


          var modal = $(this)
          modal.find('.modal-title').text('Estas a punto de editar esta partida : ' + numero_partida)
          modal.find('#numero_requisicion').val(numero_requisicion)
          modal.find('#numero_id').val(numero_id)
          modal.find('#numero_partida').val(numero_partida)
          modal.find('#descripcion').val(descripcion)
          modal.find('#cantidad').val(cantidad)
          modal.find('#precio_unitario').val(precio_unitario)
          modal.find('#unidad').val(unidad)
          modal.find('#proveedor').val(proveedor)
          modal.find('#ot').val(ot)
          modal.find('#factura').val(factura)
          modal.find('#oc').val(oc)
        modal.find('#material').val(material)

        })
      });
    </script>

</body>

</html>