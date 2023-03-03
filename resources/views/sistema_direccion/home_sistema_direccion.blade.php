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
                <a class="nav-link" href="{{ route('home_sistema_ot')}}">
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
                    <i class="fas fa-file-contract"></i>
                    <span>Ordenes de trabajo</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Barra de tareas</h6>
                        <a class="collapse-item" href="{{ route('home_sistema_ot')}}">Inicio</a>
                        <a class="collapse-item" href="{{ route('home_buscador_sistema_ot')}}">Buscardor de OT</a>
                        <a class="collapse-item" href="cards.html">Remision</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home_comisiones')}}">
                    <i class="fas fa-chart-line"></i> <span>Comision</span></a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{route('home_facturacion')}}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Facturacion</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home_direccion_proceso')}}">
                    <i class="fas fa-chart-line"></i> <span>Proceso</span></a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{route('home_produccion')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Produccion</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{route('home_ordenes_compras')}}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Ordenes de compras</span></a>
            </li>




            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home_embarques')}}">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Embarques</span></a>
            </li>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SISTEMA PRODUCCION</h1>
                        <a href="{{route('exportar_produccion')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
                    </div>

                    <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">OT'S CLIENTES</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">AVANCE DE LAS OT'S</a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">OT'S POR AREA</a>
                        <a class="nav-link" id="nav-people-tab" data-toggle="tab" href="#nav-people" role="tab" aria-controls="nav-contact" aria-selected="false">AVANCE POR AREA</a>
                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <canvas id="myChart" width="400" height="150"></canvas>
                            <script>
                                var ctx = document.getElementById('myChart').getContext('2d');

                                var myChart = new Chart(ctx, {

                                    type: 'horizontalBar',
                                    data: {
                                        labels: [<?php foreach ($mostrar as $key) {
                                                        echo "'$key->cliente'" . ',';
                                                    } ?>],
                                        datasets: [{
                                            label: 'OT´S ',
                                            data: [<?php foreach ($mostrar as $key) {
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
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <canvas id="myChart2" width="400" height="150"></canvas>
                            <script>
                                var ctx = document.getElementById('myChart2').getContext('2d');
                                var chart = new Chart(ctx, {
                                    // The type of chart we want to create
                                    type: 'doughnut',
                                    // The data for our dataset
                                    data: {
                                        labels: ['% RESTANTE ', ' % AVANCE', ],
                                        datasets: [{
                                            label: 'My First dataset',
                                            backgroundColor: [

                                                'rgba(162, 163, 162)',
                                                'rgba(73, 100, 201)',


                                            ],
                                            borderColor: 'rgb(255, 255, 255)',
                                            data: [{
                                                {
                                                    $avance_ot_real
                                                }
                                            }, {
                                                {
                                                    $avance_ot_totales
                                                }
                                            }, ]
                                        }]
                                    },
                                    // Configuration options go here
                                    options: {}
                                });
                            </script>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <canvas id="myChart3" width="400" height="150"></canvas>
                            <script>
                                var ctx = document.getElementById('myChart3').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [<?php foreach ($ot as $key) {
                                                        echo "'$key->area'" . ',';
                                                    } ?>],
                                        datasets: [{
                                            label: 'OT´S ',
                                            data: [<?php foreach ($ot as $key) {
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
                        <div class="tab-pane fade" id="nav-people" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <canvas id="myChart4" width="400" height="150"></canvas>
                            <script>
                                var ctx = document.getElementById('myChart4').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'horizontalBar',
                                    data: {
                                        labels: [<?php foreach ($values as $key) {
                                                        echo "'$key'" . ',';
                                                    } ?>],
                                        datasets: [{
                                            label: '% AVANCE AREA ',
                                            data: [<?php foreach ($ok as $key) {
                                                        echo "'$key'" . ',';
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
                            </main>
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
            $(document).ready(function() {
                $('#dtBasicExample').DataTable();
            });
        </script>
</body>

</html>