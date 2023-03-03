<table>
    <thead>
    <tr>
      <th><strong>CODIGO</strong></th>
      <th><strong>ENTREGA</strong></th>
      <th><strong>CONDICIONES DE PAGO</strong></th>
      <th><strong>MONEDA</strong></th>
      <th><strong>CLIENTE</strong></th>
      <th><strong>ESTATUS PAGO</strong></th>
      <th><strong>ESTATUS ALMACEN</strong></th>
      <th><strong>FECHA ENTRADA ALMACEN</strong></th>
      <th><strong>DIAS SIN PAGO</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($ocompra as $datos)
        <tr style="text-align: center;">
          <td style="text-align: center;"> {{$datos->Codigo}}</td>
          <td style="text-align: center;"> {{$datos->Entrega}}</td>
          <td style="text-align: center;"> {{$datos->Condiciones_de_pago}}</td>
          <td style="text-align: center;"> {{$datos->Moneda}}</td>
          <td style="text-align: center;"> {{$datos->Cliente}}</td>
          <td style="text-align: center;"> {{$datos->alta_pago}}</td>
          <td style="text-align: center;"> {{$datos->alta_almacen}}</td>
          <td style="text-align: center;"> {{$datos->fecha_almacen}}</td>
          @if($datos->dias > 30)
          <td style="background-color: #f08185; text-align: center;"> {{$datos->dias}}</td>
          @else
          <td style="text-align: center;"> {{$datos->dias}}</td>
          @endif
        </tr>
    @endforeach
    </tbody>
</table>
