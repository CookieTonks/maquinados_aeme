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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
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

          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Produccion</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Barra de tareas</h6>
                      <a class="collapse-item" href="{{ route('home_produccion')}}">En produccion</a>
                      <a class="collapse-item" href="{{ route('home_produccion_programacion')}}">Programacion OT's</a>
                  </div>
              </div>
          </li>

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
                              <span class="badge badge-danger badge-counter">{{$contador_notificaciones}}</span>
                          </a>
                          <!-- Dropdown - Alerts -->
                          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                              aria-labelledby="alertsDropdown" style="height:220px; width:150px; overflow:scroll;">
                              <h6 class="dropdown-header">
                                  Notificaciones
                              </h6>
                              @foreach($notificaciones as $notificacion)
                              @if($notificacion->seen == "NO")
                                <a class="dropdown-item d-flex align-items-center" href="{{route('inbox', $notificacion)}}" target="_blank">
                                    <div class="mr-4">
                                        <div class="icon-circle bg-primary">
                                            <i class=" fas fa-bell text-white"></i>
                                        </div>
                                    </div>
                                    <div >
                                        <span class="font-weight-bold">{{$notificacion->asunto}}</span>
                                    </div>
                                </a>
                              @else
                                <a style="background-color:#e0ded7;" class="dropdown-item d-flex align-items-center" href="{{route('inbox', $notificacion)}}" target="_blank">
                                    <div class="mr-4">
                                        <div class="icon-circle bg-primary">
                                            <i class=" fas fa-bell text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                      <span   class="font-weight-bold">{{$notificacion->asunto}}</span>
                                    </div>
                                </a>
                              @endif
                              @endforeach
                          </div>
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
                <!-- End of Topbar -->

                <!-- Modal -->

                <!-- Begin Page Content -->
                 <div class="card-body">
                   <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h1 class="h3 mb-0 text-gray-800">SISTEMA PRODUCCION</h1>
                     <a href="{{route('exportar_produccion')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                       class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
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
                    <div class="table-responsive">

                      <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                        <thead>
                          <tr style="text-align: center;">
                            <th class="th-sm">Acciones</th>
                            <th class="th-sm">OT</th>
                            <th class="th-sm">Descripcion</th>
                            <th class="th-sm">Cantidad</th>
                            <th class="th-sm">Estatus</th>
                            <th class="th-sm">Disponiblidad</th>
                            <th class="th-sm">Tratamiento</th>
                            <th class="th-sm">Proceso</th>
                            <th class="th-sm">Area</th>
                            <th class="th-sm">Comentario</th>
                            <th class="th-sm">Cliente</th>
                            <th class="th-sm">Fecha de entrega</th>
                            <th class="th-sm">Maquina</th>
                            <th>Dias  OT/OC </th>
                            <th class="th-sm">Vendedor</th>
                          </tr>
                        </thead>
                        <tbody style="text-align: center;text-align: -webkit-center;">
                    @foreach($mostrar as $item)
                      @if($item->estatus==100 or $item->estatus=='Liberado por calidad')
                      <tr style="background-color: #57c470;">
                        @if($item->material == 'CLIENTE')
                        <td style="text-align:-moz-center;">
                          <div style="width: max-content;">
                            <a href="{{ver_produccion_ot}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                            <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{route('entrada_material_cliente',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                          </td>
                          @else
                          <td style="text-align:-moz-center;">
                            <div style="width: max-content;">
                              <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                              <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            </td>
                          @endif
                          <td><a style="color:black !important;" href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                        <td>{{$item->descrip}}</td>
                        <td>{{$item->cant}}</td>
                        <td>
                          <?php
                          if ($item->estatus=='Liberado por calidad') {
                            echo "$item->estatus";
                          }else {
                            echo "$item->estatus%";
                          }
                          ?>
                        </td>
                        <td>{{$item->disponibilidad}}</td>
                        <td>{{$item->tt}}</td>
                        <td>{{$item->proceso}}</td>
                        <td>{{$item->area}}</td>
                        <td>{{$item->comentario}}</td>
                        <td>{{$item->cliente}}</td>
                        <td> {{$item->fecha_entrega}}</td>
                        <td>{{$item->maquina}}</td>
                        <td>{{$item->dias}}</td>
                        <td>{{$item->vendedor}}</td>
                    </tr>
                    @elseif($item->estatus=='Urgente' && $item->entrada_material=='RECIBIDA')
                    <tr style="background-color: #3194eb;">
                      @if($item->material == 'CLIENTE')
                      <td style="text-align:-moz-center;">
                        <div style="width: max-content;">
                          <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                          <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                          <a href="{{route('entrada_material_cliente',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                        </td>
                        @else
                        <td style="text-align:-moz-center;">
                          <div style="width: max-content;">
                            <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                            <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                          </td>
                        @endif
                           <td><a style="color:black !important;" href="../../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                      <td>{{$item->descrip}}</td>
                      <td>{{$item->cant}}</td>
                      <td>
                        <?php
                        if ($item->estatus=='Urgente')
                        {
                          echo "$item->estatus";
                        }
                        else
                        {
                          echo "$item->estatus%";
                        }
                        ?>
                      </td>
                      <td>{{$item->disponibilidad}}</td>
                      <td>{{$item->tt}}</td>
                      <td>{{$item->proceso}}</td>
                      <td>{{$item->area}}</td>
                      <td>{{$item->comentario}}</td>
                      <td>{{$item->cliente}}</td>
                      <td> {{$item->fecha_entrega}}</td>
                      <td>{{$item->maquina}}</td>
                      <td>{{$item->dias}}</td>
                      <td>{{$item->vendedor}}</td>
                  </tr>
                      @elseif($item->estatus=='Urgente')
                      <tr style="background-color: #dcc975;">
                        @if($item->material == 'CLIENTE')
                        <td style="text-align:-moz-center;">
                          <div style="width: max-content;">
                            <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                            <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{route('entrada_material_cliente',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                          </td>
                          @else
                          <td style="text-align:-moz-center;">
                            <div style="width: max-content;">
                              <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                              <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            </td>
                          @endif
                             <td><a style="color:black !important;" href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                        <td>{{$item->descrip}}</td>
                        <td>{{$item->cant}}</td>
                        <td>
                          <?php
                          if ($item->estatus=='Urgente')
                          {
                            echo "$item->estatus";
                          }
                          else {
                            echo "$item->estatus%";
                          }
                          ?>
                        </td>
                        <td>{{$item->disponibilidad}}</td>
                        <td>{{$item->tt}}</td>
                        <td>{{$item->proceso}}</td>
                        <td>{{$item->area}}</td>
                        <td>{{$item->comentario}}</td>
                        <td>{{$item->cliente}}</td>
                        <td> {{$item->fecha_entrega}}</td>
                        <td>{{$item->maquina}}</td>
                        <td>{{$item->dias}}</td>
                        <td>{{$item->vendedor}}</td>
                    </tr>

                    @elseif($item->disponibilidad=='Cancelada')
                    <tr style="background-color: #FA5858;">
                      @if($item->material == 'CLIENTE')
                      <td style="text-align:-moz-center;">
                        <div style="width: max-content;">
                          <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                          <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                          <a href="{{route('entrada_material_cliente',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                        </td>
                        @else
                        <td style="text-align:-moz-center;">
                          <div style="width: max-content;">
                            <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                            <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                          </td>
                        @endif
                           <td><a style="color:black !important;" href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                      <td>{{$item->descrip}}</td>
                      <td>{{$item->cant}}</td>
                      <td>
                        <?php
                        if ($item->estatus=='CANCELADA')
                        {
                          echo "$item->estatus";
                        }
                        else
                        {
                          echo "$item->estatus%";
                        }
                        ?>
                      </td>
                      <td>{{$item->disponibilidad}}</td>
                      <td>{{$item->tt}}</td>
                      <td>{{$item->proceso}}</td>
                      <td>{{$item->area}}</td>
                      <td>{{$item->comentario}}</td>
                      <td>{{$item->cliente}}</td>
                      <td> {{$item->fecha_entrega}}</td>
                      <td>{{$item->maquina}}</td>
                      <td>{{$item->dias}}</td>
                      <td>{{$item->vendedor}}</td>
                  </tr>
                     @elseif($item->entrada_material=='RECIBIDA')
                     <tr style="background-color: #3194eb;">
                       @if($item->material == 'CLIENTE')
                       <td style="text-align:-moz-center;">
                         <div style="width: max-content;">
                           <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                           <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                           <a href="{{route('entrada_material_cliente',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                         </td>
                         @else
                         <td style="text-align:-moz-center;">
                           <div style="width: max-content;">
                             <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                             <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                           </td>
                         @endif
                            <td><a style="color:black !important;" href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                       <td>{{$item->descrip}}</td>
                       <td>{{$item->cant}}</td>
                       <td>
                         <?php
                         if ($item->estatus=='RECIBIDA')
                         {
                           echo "$item->estatus";
                         }
                         else
                         {
                           echo "$item->estatus%";
                         }
                         ?>
                       </td>
                       <td>{{$item->disponibilidad}}</td>
                       <td>{{$item->tt}}</td>
                       <td>{{$item->proceso}}</td>
                       <td>{{$item->area}}</td>
                       <td>{{$item->comentario}}</td>
                       <td>{{$item->cliente}}</td>
                       <td>{{$item->fecha_entrega}}</td>
                       <td>{{$item->maquina}}</td>
                       <td>{{$item->dias}}</td>
                       <td>{{$item->vendedor}}</td>
                   </tr>
                   @else
                      <tr>
                        @if($item->material == 'CLIENTE')
                        <td style="text-align:-moz-center;">
                          <div style="width: max-content;">
                            <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                            <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{route('entrada_material_cliente',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                          </td>
                          @else
                          <td style="text-align:-moz-center;">
                            <div style="width: max-content;">
                              <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></a>
                              <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            </td>
                          @endif
                             <td><a style="color:black !important;" href="../storage/Dibujo_OT/{{$item->ot}}/{{$item->ot}}.pdf"> {{$item->ot}}</a></td>
                        <td>{{$item->descrip}}</td>
                        <td>{{$item->cant}}</td>
                        <td>
                          <?php
                          if ($item->estatus=='RECIBIDA')
                          {
                            echo "$item->estatus";
                          }
                          else
                          {
                            echo "$item->estatus%";
                          }
                          ?>
                        </td>
                        <td>{{$item->disponibilidad}}</td>
                        <td>{{$item->tt}}</td>
                        <td>{{$item->proceso}}</td>
                        <td>{{$item->area}}</td>
                        <td>{{$item->comentario}}</td>
                        <td>{{$item->cliente}}</td>
                        <td> {{$item->fecha_entrega}}</td>
                        <td>{{$item->maquina}}</td>
                        <td>{{$item->dias}}</td>
                        <td>{{$item->vendedor}}</td>
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
    <script>
        $(document).ready(function(){
            $('#dtBasicExample').DataTable();
        });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="template/js/sb-admin-2.min.js"></script>
</body>

</html>
