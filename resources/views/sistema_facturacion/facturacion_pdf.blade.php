<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title></title>
  <link rel="stylesheet" href="../../cssbs/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style type="text/css">
    thead:before,
    thead:after {
      display: none;
    }

    tbody:before,
    tbody:after {
      display: none;
    }
  </style>

</head>

<body>
  <table class="table table-borderless">
    <thead>
      <tr>
        <td scope="col" style="font-size:xx-small;"><img src="maquinadosaeme.png" width="250px">
          <p>MAQUINADOS AEME SA. DE CV. <br>
            MAQUINADOS Y PAILERIA INDUSTRIAL <br>
            Blvd. Julián Treviño Elizondo #410 D-7<br>
            Parque Industrial Regio, Apodaca, 66633<br>
            RFC: MAE130216B33</p>
        </td>
        <td scope="col" style="text-align: right; font-size:xx-small;">
          <p>Telefono: 83-02-58-99 <br>
          </p>
          <br>
          <br>
          <br>
          <p class="h7" style="text-align: right;">Fecha: {{$fecha}}</p>
        </td>
      </tr>
    </thead>
  </table>

  <table class="table table-sm" style="text-align:center;font-size:xx-small;" width="100%">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th colspan="1" style="text-align:left">VENDEDOR</th>
        <th colspan="1" style="text-align:left">MES DE CORTE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td  style="text-align:left">{{$vendedor}}</td>
        <td  style="text-align:left">{{$mes}}</td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered" style="text-align: center;font-size:x-small;">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th style="width:10px !important;">FOLIO</th>
        <th>CLIENTE</th>
        <th>DESCRIPCION</th>
        <th>SUBTOTAL</th>
        <th>MONEDA</th>
        <th>USUARIO</th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      @foreach($facturaciones as $facturacion)
      <tr>
        <td>{{$facturacion->folio}}</td>
        <td>{{$facturacion->cliente}}</td>
        <td>{{$facturacion->descripcion}}</td>
        <td>{{$facturacion->subtotal}}</td>
        <td>{{$facturacion->moneda}}</td>
        <td>{{$facturacion->usuario}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <table class="table table-striped" style="text-align: center; font-size:xx-small;">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th style="width:58% !important;">NOMBRE Y FIRMA DE CONFORMIDAD</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      <tr>
        <td><br><br><br><br><br>__________________________________________ <br>{{$vendedor}}</td>
        <td>
          <p style="text-align:left">FACTURACION MXN: </p>
          <p style="text-align:left">FACTURACION USD:</p>
          <p style="text-align:left">FACTURACION TOTAL: </p>
          <p style="text-align:left"> COMISION:</p>
        </td>
        <td>
          <p style="text-align:left"> <?php echo '$' . number_format($facturado_mxn, 2); ?>
          </p>
          <p style="text-align:left"> <?php echo '$' . number_format($facturado_usd, 2); ?> </p>
          <p style="text-align:left"> <?php echo '$' . number_format($facturado_total, 2); ?></p>
          <p style="text-align:left"><b> <?php echo '$' . number_format($comision_total, 2); ?></b> </p>
        </td>
      </tr>
    </tbody>
  </table>

  <p style="font-size:xx-small; text-align:right;;">Empresa certificada ISO 9001:2015</p>

</html>