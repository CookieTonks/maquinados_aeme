<style>
    .table {
        border: 1px solid #000;
    }
</style>

<h4>Material recibido del cliente</h4>
<table>
    <thead>
        <tr>
            <th><strong>FOLIO</strong></th>
            <th><strong>OT</strong></th>
            <th><strong>DESCRIPCION</strong></th>
            <th><strong>DESTINO</strong></th>
            <th><strong>CANTIDAD</strong></th>
            <th><strong>TIPO SALIDA</strong></th>
            <th><strong>SALIDA FECHA</strong></th>
            <th><strong>ESTATUS</strong></th>
            <th><strong>CHOFERS</strong></th>
            <th><strong>OBSERVACIONES</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($salidas as $salida)
        <tr>
            <td>SC-{{$salida->id}}</td>
            <td>{{$salida->ot}}</td>
            <td>{{$salida->descripcion}}</td>
            <td>{{$salida->destino}}</td>
            <td>{{$salida->cant_pieza}}</td>
            <td>{{$salida->tipo_salida}}</td>
            <td>{{$salida->fecha_salida}}</td>
            <td>{{$salida->estatus}}</td>
            <td>{{$salida->chofer}}</td>
            <td>{{$salida->observaciones}}</td>
        </tr>
        @endforeach
    </tbody>
</table>