<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
  <link rel="stylesheet" href="../../cssbs/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style type="text/css"> thead:before, thead:after { display: none; } tbody:before, tbody:after { display: none; } </style>

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
            <p class="h6" style="text-align: right;">COTIZACION: {{$cotizacion->numero_cotizacion}} </p>
            <p class="h7" style="text-align: right;">Fecha: {{$fecha}}  </p>
            <p>F VE 01, Rev. 05 <br>

          </td>
         </tr>
		  </thead>
		</table>

    <table class="table table-sm" style="text-align:center;font-size:xx-small;" width="100%">
        <thead style="background-color:rgb(18, 77, 143); color:white;">
          <tr>
            <th colspan="1" style="text-align:left">CLIENTE</th>
            <th colspan="1"style="text-align:left">USUARIO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="1">
              <div  style="font-size:xx-small; text-align:left">
                <p>{{$cliente->nombre}} <br>
                {{$cliente->direccion}}
                </p>
             </div>
            </td>
            <td colspan="1">
              <div style="font-size:xx-small; text-align:left">
                <p>{{$usuario->usuario}} <br>
                </p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <table  class="table table-bordered" style="text-align: center;font-size:x-small;">
        <thead>
        <tr>
            <th>CONDICIONES DE PAGO</th>
            <th>FECHA DE ENTREGA</th>
            <th>MONEDA</th>
        </tr>
      </thead>
      <tbody style="font-size:xx-small;">
        <tr>
          <td>{{$cotizacion->condiciones}}</td>
          <td>{{$cotizacion->entrega}}</td>
          <td>{{$cotizacion->moneda}}</td>
     </tr>
      </tbody>
      </table>



<table class="table table-bordered" style="text-align: center;font-size:x-small;">
          <thead style="background-color:rgb(18, 77, 143); color:white;">
            <tr>
              <th style="width:10px !important;">Partida</th>
              <th>Descripcion</th>
              <th># parte</th>
              <th>Rev</th>
              <th>Acero</th>
              <th>Cantidad</th>
              <th>Vigencia (dias)</th>
              <th>P/U</th>
              <th>Precio Total</th>
            </tr>
        </thead>
        <tbody style="font-size:xx-small;">
    @foreach($datos_partidas_cotizacion as $cotizaciones)
          <tr>
            <td>{{$cotizaciones->numero_cotizacion_partida}}</td>
            <td>
                <div style = "width:80px; word-wrap: break-word">
                {{$cotizaciones->descripcion}}
                </div>
                </td>
            <td>{{$cotizaciones->numero_parte}}</td>
            <td>{{$cotizaciones->revision}}</td>
            <td>{{$cotizaciones->tipo_acero}}</td>
            <td>{{$cotizaciones->cantidad}}</td>
            <td>{{$cotizaciones->vigencia}}</td>
            <td>
              <?php
                $total = $cotizaciones->precio_unitario;
                $total = number_format($total,2);
                echo "$". $total;
              ?>
            </td>
            <td>
              <?php
                $total = $cotizaciones->partida_total;
                $total = number_format($total,2);
                echo "$". $total;
              ?>
            </td>
          </tr>
          @endforeach
     </tbody>
   </table>

           <table class="table table-bordered" style="text-align: center;font-size:x-small;">
          <thead style="background-color:rgb(18, 77, 143); color:white;">
            <tr>
              <th>IMPORTE</th>
              <th>I.V.A</th>
              <th style="width:210px;">TOTAL</th>
          </tr>
        </thead>
        <tbody style="font-size:xx-small;">
          <tr>
            <td>
              <?php
                $importe = $cotizacion->importe;
                $importe = number_format($importe,2);
                echo "$". $importe;
              ?>
            </td>
            <td>
              <?php
                $iva = $cotizacion->iva;
                $iva = number_format($iva,2);
                echo "$". $iva;
              ?>
            </td>
            <td>
              <?php
                $total = $cotizacion->total;
                $total = number_format($total,2);
                echo "$". $total;
              ?>
            </td>
       </tr>
     </tbody>
   </table>

   <table class="table table-bordered" style="text-align: center;font-size:x-small;">
     <thead style="background-color:rgb(18, 77, 143); color:white;">
       <tr>
         <th>OBSERVACIONES</th>
     </tr>
   </thead>
   <tbody style="font-size:xx-small;">
     <tr>
       <td>
         {{$cotizacion->observaciones}}
       </td>
  </tr>
</tbody>
</table>

   <p style="font-size:xx-small; text-align:right;;">Empresa certificada ISO 9001:2015</p>
   </html>
