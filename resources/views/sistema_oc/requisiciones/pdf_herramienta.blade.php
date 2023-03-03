<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title></title>
  <link rel="stylesheet" href="../../cssbs/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
            Correo: compras@maquinadosaeme.com <br> compras.2@maquinadosaeme.com
          </p>
          <br>
          <br>
          <br>
          <p class="h6" style="text-align: right;">ORDEN DE COMPRA: {{$requisicion->orden_compra}} </p>
          <p class="h7" style="text-align: right;">Fecha: {{$date}} </p>
        </td>
      </tr>
    </thead>
  </table>
  <table class="table table-sm" style="text-align:center;font-size:xx-small;" width="100%">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th colspan="1" style="text-align:left">PROVEEDOR</th>
        <th colspan="1" style="text-align:left">A FACTURAR</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="1">
          <div style="font-size:xx-small; text-align:left">
            <p>{{$proveedor->Rsocial}}
              <br>{{$proveedor->Direccion}}
              <br>RFC: {{$proveedor->RFC}}
              <br>{{$proveedor->Vendedor}}
              <br>
              {{$proveedor->Telefono}} -
              {{$proveedor->Correo}}
            </p>
          </div>
        </td>
        <td colspan="1">
          <div style="font-size:xx-small; text-align:left">
            <p>MAQUINADOS AEME SA. DE CV. <br>
              Blvd. Julián Treviño Elizondo #410 D-7<br>
              Parque Industrial Regio, Apodaca, 66633<br>
              RFC: MAE130216B33</p>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="table table-striped" style="text-align: center; font-size:xx-small;">
    <thead style="background-color:rgb(18, 77, 143); color:white;">
      <tr>
        <th style="width:20px !important;">Cant.</th>
        <th style="width:30px;">Unidad</th>
        <th>Descripción</th>
        <th style="width:50px;">OT</th>
        <th style="width:50px;">Cliente</th>
        <th style="width:50px;">P/U</th>
        <th style="width:60px;">Precio Total</th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      @foreach($partida as $item)
      <tr>
        <td style="width:20px !important;">{{$item->cantidad}}</td>
        <td style="width:30px;">{{$item->unidad}}</td>
        <td>{{$item->descripcion}}</td>
        <td style="width:50px;">{{$item->ot}}</td>
        <td style="width:50px;">
          <?php
          $cliente = substr($item->cliente, 0, 3);
          echo "$cliente" . "001";
          ?>
        </td>
        <td style="width:50px;">${{$item->precio_unitario}}</td>
        <td style="width:60px;">$
          <?php
          $subs = $item->precio_unitario * $item->cantidad;
          $subs = bcdiv($subs, '1', 2);
          echo "$subs";
          ?>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <table class="table table-bordered" style="text-align: center;font-size:x-small;">
    <thead>
      <tr>
        <th>Moneda</th>
        <th>Condiciones de pago</th>
        <th>Entrega</th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      <tr>
        <td>{{$orden_compra->Moneda}}</td>
        <td>{{$orden_compra->Condiciones_de_pago}}</td>
        <td>{{$orden_compra->Entrega}}</td>
      </tr>
    </tbody>
  </table>

  <table class="table table-borderless table-sm" style="text-align: center;font-size:x-small;">
    <thead>
      <tr>
        <th style="width:350px; text-align:center;">Observaciones</th>
        <th> </th>
        <th style="text-align:left;">Cantidad</th>
      </tr>
    </thead>
    <tbody>
      <td style="width:400px; text-align:center;">
        {{$orden_compra->Observaciones}}
      </td>
      <td style="text-align:right;">SUBTOTAL: <br>IVA: <br>TOTAL: </td>
      <td style="text-align:left;"><?php echo '$' . number_format($subtotal, 2); ?><br> <?php echo '$' . number_format($subtotal * 0.16, 2); ?><br> <?php echo '$' . number_format($subtotal + ($subtotal * .16), 2); ?></td>
    </tbody>
  </table>

  <table class="table table-borderless table-sm" style="text-align: center; font-size:xx-small;">
    <thead>
      <tr>
        <th>NOTA:</th>
      </tr>
    </thead>
    <tbody style="font-size:xx-small;">
      <tr>
        <td>
          <p style="font-size:x-small; text-align: center;">No se recibirá material si no cuenta con la siguiente papeleria impresa:
            <u> <b>ORDEN DE COMPRA Y FACTURA. </b></u>
          </p>
          <p style="font-size:x-small;"> Comprador: <u> {{Auth::user()->name}} </u> </p>
          <p style="font-size:medium; text-align: right;"> <strong> FC0 03, rev 01 </strong></p>
        </td>
      </tr>
    </tbody>
  </table>
</html>