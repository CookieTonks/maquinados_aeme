<style>
  .table {
    border: 1px solid #000;
  }
</style>
<table>
  <thead>
    <tr>
      <th><strong>CLIENTE</strong></th>
      <th><strong>FOLIO</strong></th>
      <th><strong>OC</strong></th>
      <th><strong>FECHA</strong></th>
      <th><strong>DESCRIPCION</strong></th>
      <th><strong>SUBTOTAL</strong></th>
      <th><strong>IVA</strong></th>
      <th><strong>TOTAL</strong></th>
      <th><strong>MONEDA</strong></th>
      <th><strong>ENTRADA</strong></th>
      <th><strong>VENCE</strong></th>
      <th><strong>ESTATUS</strong></th>
      <th><strong>USUARIO</strong></th>
      <th><strong>VENDEDOR</strong></th>
      <th><strong>OBSERVACIONES</strong></th>
    </tr>
  </thead>
  <tbody>
    @foreach($Facturacion as $datos)
    @if($datos->estatus=='PAGADA')
    <tr>
      <td style="background-color: #57c470;">{{$datos->cliente}}</td>
      <td style="background-color: #57c470;">{{$datos->folio}}</td>
      <td style="background-color: #57c470;">{{$datos->oc}}</td>
      <td style="background-color: #57c470;">{{$datos->fecha_registro}}</td>
      <td style="background-color: #57c470;">{{$datos->descripcion}}</td>
      <td style="background-color: #57c470;">{{$datos->subtotal}}</td>
      <td style="background-color: #57c470;">{{$datos->iva}}</td>
      <td style="background-color: #57c470;">{{$datos->total}}</td>
      <td style="background-color: #57c470;">{{$datos->moneda}}</td>
      <td style="background-color: #57c470;">{{$datos->fecha_entrada}}</td>
      <td style="background-color: #57c470;">{{$datos->vence}}</td>
      <td style="background-color: #57c470;">{{$datos->estatus}}</td>
      <td style="background-color: #57c470;">{{$datos->usuario}}</td>
      <td style="background-color: #57c470;">{{$datos->vendedor}}</td>
      <td style="background-color: #57c470;">{{$datos->observaciones}}</td>
    </tr>
    @elseif($datos->estatus=="CANCELADA")
    <tr>
      <td style="background-color: #ff4554;">{{$datos->cliente}}</td>
      <td style="background-color: #ff4554;">{{$datos->folio}}</td>
      <td style="background-color: #ff4554;">{{$datos->oc}}</td>
      <td style="background-color: #ff4554;">{{$datos->fecha_registro}}</td>
      <td style="background-color: #ff4554;">{{$datos->descripcion}}</td>
      <td style="background-color: #ff4554;">{{$datos->subtotal}}</td>
      <td style="background-color: #ff4554;">{{$datos->iva}}</td>
      <td style="background-color: #ff4554;">{{$datos->total}}</td>
      <td style="background-color: #ff4554;">{{$datos->moneda}}</td>
      <td style="background-color: #ff4554;">{{$datos->fecha_entrada}}</td>
      <td style="background-color: #ff4554;">{{$datos->vence}}</td>
      <td style="background-color: #ff4554;">{{$datos->estatus}}</td>
      <td style="background-color: #ff4554;">{{$datos->usuario}}</td>
      <td style="background-color: #ff4554;">{{$datos->vendedor}}</td>
      <td style="background-color: #ff4554;">{{$datos->observaciones}}</td>
    </tr>
    @elseif($datos->estatus=="REFACTURADA")
    <tr>
      <td style="background-color: #f5f102;">{{$datos->cliente}}</td>
      <td style="background-color: #f5f102;">{{$datos->folio}}</td>
      <td style="background-color: #f5f102;">{{$datos->oc}}</td>
      <td style="background-color: #f5f102;">{{$datos->fecha_registro}}</td>
      <td style="background-color: #f5f102;">{{$datos->descripcion}}</td>
      <td style="background-color: #f5f102;">{{$datos->subtotal}}</td>
      <td style="background-color: #f5f102;">{{$datos->iva}}</td>
      <td style="background-color: #f5f102;">{{$datos->total}}</td>
      <td style="background-color: #f5f102;">{{$datos->moneda}}</td>
      <td style="background-color: #f5f102;">{{$datos->fecha_entrada}}</td>
      <td style="background-color: #f5f102;">{{$datos->vence}}</td>
      <td style="background-color: #f5f102;">{{$datos->estatus}}</td>
      <td style="background-color: #f5f102;">{{$datos->usuario}}</td>
      <td style="background-color: #f5f102;">{{$datos->vendedor}}</td>
      <td style="background-color: #f5f102;">{{$datos->observaciones}}</td>

    </tr>
    @else
    <tr>
      <td>{{$datos->cliente}}</td>
      <td>{{$datos->folio}}</td>
      <td>{{$datos->oc}}</td>
      <td>{{$datos->fecha_registro}}</td>
      <td>{{$datos->descripcion}}</td>
      <td>{{$datos->subtotal}}</td>
      <td>{{$datos->iva}}</td>
      <td>{{$datos->total}}</td>
      <td>{{$datos->moneda}}</td>
      <td>{{$datos->fecha_entrada}}</td>
      <td>{{$datos->vence}}</td>
      <td>{{$datos->estatus}}</td>
      <td>{{$datos->usuario}}</td>
      <td>{{$datos->vendedor}}</td>
      <td>{{$datos->observaciones}}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>