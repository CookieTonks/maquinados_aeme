<html lang="en">
   <head>
      <!-- Meta tags -->
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
      <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <title>Maquinados AEME - Dashboard</title>
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
                   <div class="card-body">
                     <div class="table-responsive">
                     <div class="container">
                       <table id="dtBasicExample" class="table table-striped table-bordered table-lg" width="100%">
                     <thead>
                       <tr style="text-align: center;">
                         <th class="th-sm">Acciones</th>
                         <th class="th-sm">OT</th>
                         <th class="th-sm">Descripcion</th>
                         <th class="th-sm">Estatus</th>
                         <th class="th-sm">Disponiblidad</th>
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
                           <td style="text-align:-moz-center;">
                             <div style="width: max-content;">
                               <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                               <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                 <form action="{{route('bajaproduccion',$item->id)}}" method="post" class="d-inline" id="miFormulario">
                                   @method('DELETE')
                                   @csrf
                                   <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                                 </form>
                                 <script type="text/javascript">
                             (function() {
                               var form = document.getElementById('miFormulario');
                               form.addEventListener('submit', function(event)
                               {
                                 // si es false entonces que no haga el submit
                                 if (!confirm('¿Realmente deseas eliminarlo?'))
                                 {
                                   event.preventDefault();
                                 }
                               }, false);
                             })();
                           </script>

                             </div>
                             </td>
                           <td><a style="color:white !important;" href="{{route('ver_produccion_ot',$item->id)}}"> {{$item->ot}}</a></td>
                           <td>{{$item->descripcion}}</td>
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
                         <td style="text-align:-moz-center;">
                           <div style="width: max-content;">
                             <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                             <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                               <form action="{{route('bajaproduccion',$item->id)}}" method="post" class="d-inline" id="miFormulario">
                                 @method('DELETE')
                                 @csrf
                                 <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                               </form>
                               <script type="text/javascript">
                           (function()
                           {
                             var form = document.getElementById('miFormulario');
                             form.addEventListener('submit', function(event)
                             {
                               // si es false entonces que no haga el submit
                               if (!confirm('¿Realmente deseas eliminarlo?'))
                               {
                                 event.preventDefault();
                               }
                             }, false);
                           })();
                         </script>

                           </div>
                           </td>
                         <td><a style="color:white !important;" href="{{route('ver_produccion_ot',$item->id)}}"> {{$item->ot}}</a></td>
                         <td>{{$item->descripcion}}</td>
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
                           <td style="text-align:-moz-center;">
                             <div style="width: max-content;">
                               <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                               <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                 <form action="{{route('bajaproduccion',$item->id)}}" method="post" class="d-inline" id="miFormulario">
                                   @method('DELETE')
                                   @csrf
                                   <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                                 </form>
                                 <script type="text/javascript">
                             (function() {
                               var form = document.getElementById('miFormulario');
                               form.addEventListener('submit', function(event)
                               {
                                 // si es false entonces que no haga el submit
                                 if (!confirm('¿Realmente deseas eliminarlo?'))
                                 {
                                   event.preventDefault();
                                 }
                               }, false);
                             })();
                           </script>
                             </div>
                             </td>
                           <td><a style="color:white !important;" href="{{route('ver_produccion_ot',$item->id)}}"> {{$item->ot}}</a></td>
                           <td>{{$item->descripcion}}</td>
                           <td>
                             <?php
                             if ($item->estatus=='Urgente') {
                               echo "$item->estatus";
                             }else {
                               echo "$item->estatus%";
                             }
                             ?>
                           </td>
                           <td>{{$item->disponibilidad}}</td>
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
                         <td style="text-align:-moz-center;">
                           <div style="width: max-content;">
                             <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                             <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                               <form action="{{route('bajaproduccion',$item->id)}}" method="post" class="d-inline" id="miFormulario">
                                 @method('DELETE')
                                 @csrf
                                 <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                               </form>
                               <script type="text/javascript">
                           (function() {
                             var form = document.getElementById('miFormulario');
                             form.addEventListener('submit', function(event)
                             {
                               // si es false entonces que no haga el submit
                               if (!confirm('¿Realmente deseas eliminarlo?'))
                               {
                                 event.preventDefault();
                               }
                             }, false);
                           })();
                         </script>
                           </div>
                           </td>
                         <td><a style="color:white !important;" href="{{route('ver_produccion_ot',$item->id)}}"> {{$item->ot}}</a></td>
                         <td>{{$item->descripcion}}</td>
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
                          <td style="text-align:-moz-center;">
                            <div style="width: max-content;">
                              <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                              <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                <form action="{{route('bajaproduccion',$item->id)}}" method="post" class="d-inline" id="miFormulario">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="far fa-trash-alt"></i></button>
                                </form>
                                <script type="text/javascript">
                            (function() {
                              var form = document.getElementById('miFormulario');
                              form.addEventListener('submit', function(event)
                              {
                                // si es false entonces que no haga el submit
                                if (!confirm('¿Realmente deseas eliminarlo?'))
                                {
                                  event.preventDefault();
                                }
                              }, false);
                            })();
                          </script>
                            </div>
                            </td>
                          <td><a style="color:white !important;" href="{{route('ver_produccion_ot',$item->id)}}"> {{$item->ot}}</a></td>
                          <td>{{$item->descripcion}}</td>
                          <td>
                            <?php
                            if ($item->estatus=='RECIBIDA') {
                              echo "$item->estatus";
                            }else {
                              echo "$item->estatus%";
                            }
                            ?>
                          </td>
                          <td>{{$item->disponibilidad}}</td>
                          <td>{{$item->proceso}}</td>
                          <td>{{$item->area}}</td>
                          <td>{{$item->comentario}}</td>
                         <td>{{$item->cliente}}</td>
                          <td> {{$item->fecha_entrega}}</td>
                          <td>{{$item->maquina}}</td>
                          <td>{{$item->dias}}</td>
                          <td>{{$item->vendedor}}</td>
                      </tr>
                      @else
                         <tr>
                           <td style="text-align:-moz-center;">
                             <div style="width: max-content;">
                               <a href="{{route('liberacion_ot',$item->id)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                               <a href="{{route('edit_produccion',$item->id)}}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleVaryingModal1" data-whatever="{{$item->id}}">{{$item->id}}</button>
                       </td>
                           <td><a style="color:black !important;" href="{{route('ver_produccion_ot',$item->id)}}"> {{$item->ot}}</a></td>
                           <td>{{$item->descripcion}}</td>
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
     <div class="modal fade" id="exampleVaryingModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                 <form>
                    <div class="form-group">
                       <label for="recipient-name" class="col-form-label">Recipient:</label>
                       <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                       <label for="message-text" class="col-form-label">Message:</label>
                       <textarea class="form-control" id="message-text"></textarea>
                    </div>
                 </form>
              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-success">Send</button>
              </div>
           </div>
        </div>
     </div>
  </div>
  </div>
  </div>

      <script>
         $(document).ready(function(){
              $('#exampleVaryingModal1').on('show.bs.modal', function (event) {
           var button = $(event.relatedTarget) // Button that triggered the modal
           var recipient = button.data('whatever') // Extract info from data-* attributes
           // We are jquery here to update the modal's content
           var modal = $(this)
           modal.find('.modal-title').text('New message to ' + recipient)
           modal.find('.modal-body input').val(recipient)
         })
         });
      </script>
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
