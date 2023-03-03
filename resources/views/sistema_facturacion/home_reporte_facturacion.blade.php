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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home_facturacion')}}">
                  <i class="fas fa-coins"></i>
                    <span>Facturacion</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home_facturacion_buscador')}}">
                  <i class="fas fa-search-dollar"></i>

                    <span>Buscardor</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home_reporte_facturacion')}}">
                  <i class="fas fa-chart-pie"></i>
                    <span>Reporte</span></a>
            </li>
            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                                  <div >
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

                    <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                      <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">FACTURACION - CLIENTES</a>
                      <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">FACTURACION - VENDEDOR</a>
                      <a class="nav-link" id="nav-pagada-tab" data-toggle="tab" href="#nav-pagada" role="tab" aria-controls="nav-pagada" aria-selected="false">FACTURACION - PAGO</a>
                      <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">FACTURACION - ESTATUS</a>
                    </div>

                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                        <div class="col-lg-6">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION CLIENTES (MXN)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart" width="350" height="250"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart').getContext('2d');

                                  var myChart = new Chart(ctx, {

                                      type: 'bar',
                                      data: {
                                          labels: [<?php foreach ($facturacion_cliente_mxn as $key) {
                                            echo "'$key->cliente'" . ',';
                                          } ?>],
                                          datasets: [{
                                              label: 'FACTURACION ',
                                              data: [<?php foreach ($facturacion_cliente_mxn as $key) {
                                                echo "$key->total" . ',';
                                              } ?>],


                                              backgroundColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                              ],
                                              borderColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                              ],
                                              borderWidth: 1
                                          }]
                                      },
                                      options: {
                                          scales: {
                                              yAxes: [{
                                                  ticks: {
                                                      beginAtZero: true
                                                  }
                                              }]
                                          }
                                      }
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION CLIENTES (USD)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart2" width="350" height="250"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart2').getContext('2d');

                                  var myChart = new Chart(ctx, {

                                      type: 'bar',
                                      data: {
                                          labels: [<?php foreach ($facturacion_cliente_usd as $key) {
                                            echo "'$key->cliente'" . ',';
                                          } ?>],
                                          datasets: [{
                                              label: 'FACTURACION ',
                                              data: [<?php foreach ($facturacion_cliente_usd as $key) {
                                                echo "$key->total" . ',';
                                              } ?>],


                                              backgroundColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                              ],
                                              borderColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                              ],
                                              borderWidth: 1
                                          }]
                                      },
                                      options: {
                                          scales: {
                                              yAxes: [{
                                                  ticks: {
                                                      beginAtZero: true
                                                  }
                                              }]
                                          }
                                      }
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                        <div class="col-lg-6">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION VENDEDORES (MXN)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart3" width="350" height="250"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart3').getContext('2d');

                                  var myChart = new Chart(ctx, {

                                      type: 'bar',
                                      data: {
                                          labels: [<?php foreach ($facturacion_vendedores_mxn as $key) {
                                            echo "'$key->vendedor'" . ',';
                                          } ?>],
                                          datasets: [{
                                              label: 'FACTURACION ',
                                              data: [<?php foreach ($facturacion_vendedores_mxn as $key) {
                                                echo "$key->total" . ',';
                                              } ?>],


                                              backgroundColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',



                                              ],
                                              borderColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',


                                              ],
                                              borderWidth: 1
                                          }]
                                      },
                                      options: {
                                          scales: {
                                              yAxes: [{
                                                  ticks: {
                                                      beginAtZero: true
                                                  }
                                              }]
                                          }
                                      }
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION VENDEDORES (USD)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart4" width="350" height="250"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart4').getContext('2d');

                                  var myChart = new Chart(ctx, {

                                      type: 'bar',
                                      data: {
                                          labels: [<?php foreach ($facturacion_vendedores_usd as $key) {
                                            echo "'$key->vendedor'" . ',';
                                          } ?>],
                                          datasets: [{
                                              label: 'FACTURACION ',
                                              data: [<?php foreach ($facturacion_vendedores_usd as $key) {
                                                echo "$key->total" . ',';
                                              } ?>],
                                              backgroundColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                              ],
                                              borderColor: [
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                                'rgba(73, 100, 201)',
                                                'rgba(116, 176, 56)',
                                                'rgba(217, 128, 76)',
                                                'rgba(140, 56, 209)',
                                              ],
                                              borderWidth: 1
                                          }]
                                      },
                                      options: {
                                          scales: {
                                              yAxes: [{
                                                  ticks: {
                                                      beginAtZero: true
                                                  }
                                              }]
                                          }
                                      }
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                        <div class="col-lg-6">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION ESTATUS (MXN)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart6" width="300" height="150"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart6').getContext('2d');
                                  var chart = new Chart(ctx, {
                                      // The type of chart we want to create
                                      type: 'doughnut',
                                      // The data for our dataset
                                      data: {
                                          labels: [<?php foreach ($facturacion_estatus_mxn as $key) {
                                            echo "'$key->estatus'" . ',';
                                          } ?>],
                                          datasets: [{
                                              label: 'My First dataset',
                                              backgroundColor: [
                                                'rgba(217, 83, 79)',
                                                'rgba(215, 215, 215)',
                                                'rgba(92, 184, 92)',
                                                'rgba(240, 173, 78)',
                                              ],
                                              borderColor: 'rgb(255, 255, 255)',
                                              data: [<?php foreach ($facturacion_estatus_mxn as $key) {
                                                echo "$key->total" . ',';
                                              } ?>]
                                          }]
                                      },
                                      // Configuration options go here
                                      options: {}
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION ESTATUS (USD)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart5" width="300" height="150"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart5').getContext('2d');
                                  var chart = new Chart(ctx, {
                                      // The type of chart we want to create
                                      type: 'doughnut',
                                      // The data for our dataset
                                      data: {
                                          labels: [<?php foreach ($facturacion_estatus_usd as $key) {
                                            echo "'$key->estatus'" . ',';
                                          } ?>],
                                          datasets: [{
                                              label: 'My First dataset',
                                              backgroundColor: [
                                                'rgba(217, 83, 79)',
                                                'rgba(215, 215, 215)',
                                                'rgba(92, 184, 92)',
                                                'rgba(240, 173, 78)',
                                              ],
                                              borderColor: 'rgb(255, 255, 255)',
                                              data: [<?php foreach ($facturacion_estatus_usd as $key) {
                                                echo "$key->total" . ',';
                                              } ?>]
                                          }]
                                      },
                                      // Configuration options go here
                                      options: {}
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="nav-pagada" role="tabpanel" aria-labelledby="nav-pagada-tab">
                        <div class="row">
                        <div class="col-lg-6">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION PAGO (MXN)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart7" width="300" height="150"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart7').getContext('2d');
                                  var chart = new Chart(ctx, {
                                      // The type of chart we want to create
                                      type: 'doughnut',
                                      // The data for our dataset
                                      data: {
                                          labels: ['% RESTANTE ','% PAGADO', ],
                                          datasets: [{
                                              label: 'My First dataset',
                                              backgroundColor: [
                                                'rgba(162, 163, 162)',
                                                'rgba(73, 100, 201)',
                                              ],
                                              borderColor: 'rgb(255, 255, 255)',
                                              data: [{{$porcentaje_restante_mxn}},{{$porcentaje_pagada_mxn}}, ]
                                          }]
                                      },
                                      // Configuration options go here
                                      options: {}
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">FACTURACION PAGO (USD)</h6>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart8" width="300" height="150"></canvas>
                                  <script>
                                  var ctx = document.getElementById('myChart8').getContext('2d');
                                  var chart = new Chart(ctx, {
                                      // The type of chart we want to create
                                      type: 'doughnut',
                                      // The data for our dataset
                                      data: {
                                          labels: ['% RESTANTE ','% PAGADO', ],
                                          datasets: [{
                                              label: 'My First dataset',
                                              backgroundColor: [

                                                'rgba(162, 163, 162)',
                                                'rgba(73, 100, 201)',


                                              ],
                                              borderColor: 'rgb(255, 255, 255)',
                                              data: [{{$porcentaje_restante_usd}},{{$porcentaje_pagada_usd}}, ]
                                          }]
                                      },
                                      // Configuration options go here
                                      options: {}
                                  });
                                  </script>
                                </div>
                            </div>
                        </div>
                        </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="template/js/sb-admin-2.min.js"></script>

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function(){
            $('#dtBasicExample').DataTable();
        });
    </script>
</body>

</html>
