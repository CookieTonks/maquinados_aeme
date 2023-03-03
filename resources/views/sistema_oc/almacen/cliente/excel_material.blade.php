<style>
  .table {
    border: 1px solid #000;
  }
</style>

<h4>Material recibido del cliente</h4>
<table>
  <thead>
    <tr>
      <th><strong>CLIENTE</strong></th>
      <th><strong>FOLIO</strong></th>
      <th><strong>PARTIDA</strong></th>
      <th><strong>DESCRIPCION</strong></th>
      <th><strong>CANTIDAD</strong></th>
      <th><strong>USUARIO ENTRADA</strong></th>
      <th><strong>ENTRADA FECHA</strong></th>
      <th><strong>USUARIO ENTREGA</strong></th>
      <th><strong>ENTREGA FECHA</strong></th>
      <th><strong>ESTATUS</strong></th>
    </tr>
  </thead>
  <tbody>
    @foreach($material_cliente as $material)
    <tr>
      <td>{{$material->cliente}}</td>
      <td>{{$material->folio}}</td>
      <td>{{$material->partida}}</td>
      <td>{{$material->descripcion}}</td>
      <td>{{$material->cantidad}}</td>
      <td>{{$material->usuario_recepcion}}</td>
      <td>{{$material->fecha_recepcion}}</td>
      <td>{{$material->usuario_salida}}</td>
      <td>{{$material->fecha_salida}}</td>
      <td>{{$material->estatus}}</td>
    </tr>
    @endforeach
  </tbody>
</table>