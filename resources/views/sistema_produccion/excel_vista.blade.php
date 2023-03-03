<table>
    <thead>
    <tr>
      <th><strong>OT</strong></th>
      <th><strong>DESCRIPCION</strong></th>
      <th><strong>VENDEDOR</strong></th>
      <th><strong>AREA</strong></th>
      <th><strong>CLIENTE</strong></th>
      <th><strong>FECHA INICIO</strong></th>
      <th><strong>FECHA ENTREGA</strong></th>
      <th><strong>PROCESO</strong></th>
      <th><strong>VENDEDOR</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($Produccion as $datos)
        <tr>
          <td>{{$datos->ot}}</td>
          <td>{{$datos->descrip}}</td>
          <td>{{$datos->vendedor}}</td>
          <td>{{$datos->area}}</td>
          <td>{{$datos->cliente}}</td>
          <td>{{$datos->created_at}}</td>
          <td>{{$datos->fecha_entrega}}</td>
          <td>{{$datos->proceso}}</td>
          <td>{{$datos->vendedor}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
