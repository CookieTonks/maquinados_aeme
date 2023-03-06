<!-- Actualizada -->
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
                <!-- Cuerpo de la pagina -->
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
                                    <th class="th-sm">Material</th>
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
                                            <a href="{{route('home_rutas_ot', $item)}}" class="btn btn-info btn-sm"><i class="fas fa-route"></i></a>
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
                                    <td>{{$item->material}}</td>
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
                <!-- Fin del contenido principal -->

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
                <div>
                </div>
            </div>
        </div>

        <!-- Modals seccion -->

        <!-- Modal alta de ordenes de trabajo -->

        <div class="modal fade" id="exampleModal" tabindex="10" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nueva orden de trabajo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('alta_ot')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label>F. Inicio</label>
                                    <input type="text" class="form-control" name="f_inicio" value="{{$date_ot}}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>F. Entrega</label>
                                    <input type="date" class="form-control" name="f_entrega" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">Cliente</label>
                                    <select required name="cliente" id="Cliente_id" class="form-control">
                                        <option value="" class="form-control"></option>
                                        @foreach($cliente as $item)
                                        <option value="{{$item->nombre}}" class="form-control" name="no_oc"> {{$item->nombre}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Usuario</label>
                                    <select required name="usuario" id="Cliente_id" class="form-control">
                                        <option value="" class="form-control"></option>
                                        @foreach($usuarios as $usuario => $cliente)
                                        <optgroup label="{{$usuario}}">
                                            @foreach($cliente as $us)
                                            <option value="{{$us->usuario}}" class="form-control" name="usuario"> {{$us->usuario}} </option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label>Descripcion</label>
                                    <input type="text" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase()" name="comentario" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label>Proceso</label>
                                    <select class="js-example-basic-multiple" name="proceso[]" multiple="MultipleSelection" style="width:100%;" required>
                                        <option value="Torno">TORNO</option>
                                        <option value="Soldadura">SOLDADURA</option>
                                        <option value="C.Maq">C.MAQ</option>
                                        <option value="Diseño">DISEÑO</option>
                                        <option value="Templado">TEMPLADO</option>
                                        <option value="Tripocalizado">TRIPOCALIZADO</option>
                                        <option value="Nitrurado">NITRURADO</option>
                                        <option value="Cromado">CROMADO</option>
                                        <option value="Pavonado">PAVONADO</option>
                                        <option value="Niquelado">NIQUELADO</option>
                                        <option value="Rectificado">RECTIFICADO</option>
                                        <option value="Generado">GENERADO</option>
                                        <option value="Convecional">CONVENCIONAL</option>
                                        <option value="Doblado">DOBLADO</option>
                                        <option value="CNC">CNC</option>
                                        <option value="Fresadora">FRESADORA</option>
                                        <option value="Ensamble">ENSAMBLE</option>
                                        <option value="Hilo">HILO</option>
                                        <option value="Hilo">EROSIONADO</option>
                                        <option value="Pulido">PULIDO</option>
                                        <option value="Paileria">PAILERIA</option>
                                        <option value="Penetracion">PENETRACION</option>
                                        <option value="Rectificado">RECTIFICADO</option>
                                        <option value="Rolado">ROLADO</option>
                                        <option value="Reparacion">REPARACION</option>
                                        <option value="Corte con laser">CORTE CON LASER</option>
                                        <option value="Proveedor externo">PROVEEDOR EXTERNO</option>
                                        <option value="Anodizado">ANODIZADO</option>
                                        <option value="Pintura">PINTURA</option>
                                        <option value="Corte">CORTE</option>
                                        <option value="Corte con agua ">CORTE CON AGUA</option>
                                        <option value="Galvanizado">GALVANIZADO</option>
                                        <option value="Lumena">Lumena</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-5 mb-3">
                                    <label>Orden de compra</label>
                                    <input type="text" class="form-control" id="oc" name="oc" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Moneda</label>
                                    <select class="form-control" id="moneda" name="moneda" required>
                                        <option value="" class="form-control"></option>
                                        <option>MXN</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Monto</label>
                                    <input type="number" id="monto" class="form-control" name="monto" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">Estatus</label>
                                    <select class="custom-select" name="estatus" required>
                                        <option value="" class="form-control"></option>
                                        <option>-</option>
                                        <option>0 </option>
                                        <option>100 </option>
                                        <option>URGENTE</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">Vendedor</label>
                                    <select class="custom-select" name="vendedor" required>
                                        <option value="" class="form-control"></option>
                                        <option>-</option>
                                        <option> ABRAHAM PADILLA </option>
                                        <option> ALEXIS HERNANDEZ </option>
                                        <option> ANACLETO ISAGUIRRE </option>
                                        <option> EDUARDO GARZA </option>
                                        <option> ELIAS MORALES </option>
                                        <option> IVAN TREVIÑO </option>
                                        <option> JOEL RODRIGUEZ </option>
                                        <option> MARIO RODRIGUEZ </option>
                                        <option> MARKO SAN MIGUEL </option>
                                        <option> REYNALDO GARZA </option>
                                        <option> MAURICIO THOMAS </option>
                                        <option> WENDY ESCOBEDO </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">Fuente</label>
                                    <select id="fuente" class="custom-select" name="fuente" required>
                                        <option value="" class="form-control"></option>
                                        <option>-</option>
                                        <option value="Dibujo del cliente">DIBUJO DEL CLIENTE</option>
                                        <option value="Fabricacion">FABRICACION</option>
                                        <option value="Reparacion">REPARACION</option>
                                        <option value="Pieza Muestra">PIEZA MUESTRA</option>
                                        <option value="Suministros">SUMINISTROS</option>
                                        <option value="Modificacion">MODIFICACION</option>
                                        <option value="Mantenimiento">MANTENIMIENTO</option>
                                        <option value="Servicio">SERVICIO</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">Area</label>
                                    <select class="custom-select" name="supervisor" required>
                                        <option value="" class="form-control"></option>
                                        <option>-</option>
                                        <option>TORNO</option>
                                        <option>SOLDADURA</option>
                                        <option>C.MAQ</option>
                                        <option>DISEÑO</option>
                                        <option>TEMPLADO</option>
                                        <option>TRIPOCALIZADO</option>
                                        <option>NITRURADO</option>
                                        <option>CROMADO</option>
                                        <option>PAVONADO</option>
                                        <option>NIQUELADO</option>
                                        <option>RECTIFICADO</option>
                                        <option>GENERADO</option>
                                        <option>CONVENCIONAL</option>
                                        <option>DOBLADO</option>
                                        <option>CNC</option>
                                        <option>FRESADORA</option>
                                        <option>ENSAMBLE</option>
                                        <option>HILO</option>
                                        <option>EROSIONADO</option>
                                        <option>PULIDO</option>
                                        <option>PAILERIA</option>
                                        <option>PENETRACION</option>
                                        <option>RECTIFICADO</option>
                                        <option>REPARACION</option>
                                        <option>CORTE CON LASER</option>
                                        <option>PROVEEDOR EXTERNO</option>
                                        <option>SALINAS</option>
                                        <option>PROVEEDOR EXTERNO</option>
                                        <option>AEME</option>
                                        <option>MARCAJE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Dibujo</label>
                                    <input type="text" class="form-control" id="dibujo" name="dibujo" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Fecha Diseño</label>
                                    <input type="date" class="form-control" id="fecha_diseno" name="fecha_diseno" required>
                                </div>
                                <div class="col-md-4  mb-3">
                                    <label>Comentario Diseño</label>
                                    <input onkeyup="javascript:this.value=this.value.toUpperCase()" type="text" class="form-control" id="comentario_diseno" name="comentario_diseno" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label>Archivo</label>
                                    <input type="file" placeholder="Solo archivos en PDF" class="form-control" name="dibujo_archivo" accept="application/pdf" id="dibujo_archivo" only required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label>Codigo de pieza</label>
                                    <input type="text" class="form-control" name="cod_pieza" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Cantidad de piezas</label>
                                    <input type="number" class="form-control" name="cantidad" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Material</label>
                                    <select class="custom-select" name="material" required>
                                        <option value="" class="form-control"></option>
                                        <option>AEME</option>
                                        <option>CLIENTE</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Tipo de material</label>
                                    <input onkeyup="javascript:this.value=this.value.toUpperCase()" type="text" class="form-control" name="tipo_material" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Tratamiento térmico</label>
                                    <select class="custom-select" name="tt" required>
                                        <option value="" class="form-control"></option>
                                        <option value="TRATAMIENTO">APLICA</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin modal alta de ordenes de trabajo -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Script -->
        <script>
            $(".js-example-basic-multiple").on("select2:select", function(evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });

            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

            $(document).ready(function() {
                $('#dtBasicExample').DataTable();
            });
        </script>

        <script>
            $(function() {
                $("#fuente").change(function() {
                    if ($(this).val() == "Dibujo del cliente") {
                        $("#dibujo_archivo").prop("disabled", false);
                        $("#fecha_diseno").prop("disabled", true);
                        $("#comentario_diseno").prop("disabled", true);

                    } else {
                        $("#dibujo_archivo").prop("disabled", true);
                        $("#fecha_diseno").prop("disabled", false);
                        $("#comentario_diseno").prop("disabled", false);
                    }
                });
            });

            $(function() {
                $("#oc").change(function() {
                    if ($(this).val() == "-") {
                        $("#moneda").prop("disabled", true);
                        $("#monto").prop("disabled", true);

                    } else {
                        $("#moneda").prop("disabled", false);
                        $("#monto").prop("disabled", false);
                    }
                });
            });
        </script>
</body>

</html>