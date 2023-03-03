<style>
     .table {
         border: 2px solid #000;
         border-collapse: collapse;
     }
 </style>
<table>
    <thead>
    <tr>
      <th><strong>OT</strong></th>
      <th><strong>DESCRIPCION</strong></th>
      <th><strong>CLIENTE</strong></th>
      <th><strong>VENDEDOR</strong></th>
      <th><strong>MATERIAL</strong></th>
      <th><strong>CANTIDAD</strong></th>
      <th><strong>ESTATUS</strong></th>
      <th><strong>COMENTARIO</strong></th>
      <th><strong>RESPONSABLE</strong></th>
      <th><strong>FECHA DISEÑO</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($dibujos as $dibujo)
    @if($dibujo->estatus=='PENDIENTE')
    <tr class="table-danger">
      <td style="background-color: #f8ccc8;">{{$dibujo->ot}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->descripcion}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->cliente}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->vendedor}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->material}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->cantidad}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->estatus}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->comentario_diseno}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->responsable}}</td>
      <td style="background-color: #f8ccc8;">{{$dibujo->fecha_diseno}}</td>
    </tr>
      @elseif($dibujo->estatus=="EN PROCESO")
      <tr class="table-info">
        <td style="background-color: #c7ebf1;">{{$dibujo->ot}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->descripcion}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->cliente}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->vendedor}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->material}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->cantidad}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->estatus}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->comentario_diseno}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->responsable}}</td>
        <td style="background-color: #c7ebf1;">{{$dibujo->fecha_diseno}}</td>
      </tr>
      @elseif($dibujo->estatus=="ASIGNADA")
      <tr class="table-warning">
        <td style="background-color: #fceec9;" >{{$dibujo->ot}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->descripcion}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->cliente}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->vendedor}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->material}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->cantidad}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->estatus}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->comentario_diseno}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->responsable}}</td>
        <td style="background-color: #fceec9;">{{$dibujo->fecha_diseno}}</td>
      </tr>
      @else
      <tr>
        <td>{{$dibujo->ot}}</td>
        <td>{{$dibujo->descripcion}}</td>
        <td>{{$dibujo->cliente}}</td>
        <td>{{$dibujo->vendedor}}</td>
        <td>{{$dibujo->material}}</td>
        <td>{{$dibujo->cantidad}}</td>
        <td>{{$dibujo->estatus}}</td>
        <td>{{$dibujo->comentario_diseno}}</td>
        <td>{{$dibujo->responsable}}</td>
        <td>{{$dibujo->fecha_diseno}}</td>
      </tr>
      @endif
    @endforeach
    </tbody>
</table>
