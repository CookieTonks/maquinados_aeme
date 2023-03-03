<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="gb18030">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PDF REMISION</title>
  <link rel="stylesheet" href="../../cssbs/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<style media="screen">
  .table {
    margin-bottom: 0rem !important;
  }

  .table th,
  .table td {
    padding: 0rem !important;
  }
</style>

<body>
  <table class="table table-borderless">
    <thead>
      <tr>
        <th scope="col"><img src="maquinadosaeme.png" width="350px"></th>
        <th scope="col"><img src="" style="float:right" width="250px"></th>
      </tr>
    </thead>
  </table>
  <br>
  <br>
  <center>
    <p style="font-size:x-small;"> Maquinado| Erosionado | Rectificado | Soldadura y Pailera <br> Julian Trevi単o Elizondo No. 410 D-7, Col. Regio Parque Indl. Apodaca, N.L. <br> Oficinas tel 81.26820208</p>
  </center>
  <br>
  <!--Primer cuadro-->
  <table class="table table-sm" style="text-align:center;font-size:xx-small;" width="100%">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
      <th colspan="1" style="text-align:left">OT</th>
        <th colspan="1" style="text-align:left">REMISION</th>
        <th colspan="1" style="text-align:left">ORDEN DE COMPRA</th>
        <th colspan="1" style="text-align:left">FECHA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td colspan="1">
          <div style="font-size:x-small; text-align:left">
            <p>{{$orden_trabajo->id}}</p>
          </div>
        </td>
        <td colspan="1">
          <div style="font-size:x-small; text-align:left">
            <p>{{$numero_remision}}</p>
          </div>
        </td>
        <td colspan="1">
          <div style="font-size:x-small; text-align:left">
            <p>{{$orden_trabajo->orden_compra}}</p>
          </div>
        </td>
        <td colspan="1">
          <div style="font-size:x-small; text-align:left">
            <p>{{$fecha_salida}}</p>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <!--Segundo cuadro cliete-->
  <table class="table table-sm" style="text-align:center;font-size:xx-small;" width="100%">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th colspan="1" style="text-align:center">CLIENTE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="1">
          <div style="font-size:xx-small; text-align:left">
            {{$cliente->nombre}} <br> {{$cliente->direccion}}
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <p style="text-align: right; font-size:x-small;">F VE 02, REV.05 </p>
  <table class="table table-striped" style="text-align: center; font-size:xx-small;">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th style="width:20px !important;">CANTIDAD</th>
        <th style="width:20px !important;">DESCRIPCION</th>
        <th style="width:50px;">PRECIO UNIT</th>
        <th style="width:60px;">TOTAL</th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      <tr>
        <td>{{$alta_salida->cant_pieza}}</td>
        <td>{{$orden_trabajo->descripcion}}</td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-striped" style="text-align: center; font-size:xx-small;">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th style="width:58% !important;">FECHA, NOMBRE Y FIRMA DE CONFORMIDAD</th>
        <th></th>
        <th></th> 
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      <tr>
        <td><br><br><br><br><br>__________________________________________</td>
        <td>
          <p style="text-align:left">SUBTOTOTAL </p>
          <p style="text-align:left">IMPUESTO </p>
          <p style="text-align:left">IVA: </p>
          <p style="text-align:left"> TOTAL</p>
        </td>
        <td>
          <p style="text-align:left">$ </p>
          <p style="text-align:left">$ 16.00 % </p>
          <p style="text-align:left">$ </p>
          <p style="text-align:left">$ </p>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="table table-striped" style="text-align: center; font-size:xx-small;">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th style="width:20px !important;">OBSERVACIONES</th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      <tr>
        <td>{{$datos_salida->observaciones}}</td>
      </tr>
    </tbody>
  </table>
</body>

</html>