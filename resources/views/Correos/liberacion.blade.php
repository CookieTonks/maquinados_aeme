<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Correo AEME</title>
</head>

<body>
  <h2>Ordenes de trabajo proximas a entregar:</h2>
  @foreach($info as $orden_trabajo)
  <ul>
    <b>OT: {{$orden_trabajo->ot}}</b>
    <li>Cliente: {{$orden_trabajo->cliente}}</li>
    <li>Fecha de alta: {{$orden_trabajo->created_at}}</li>
    <li>Fecha de entrega: {{$orden_trabajo->fecha_entrega}}</li>
    <li>Dias para entrega: {{$orden_trabajo->dias}}</li>
    <li>Encargado: {{$orden_trabajo->encargado}}</li>
  </ul>
  @endforeach
</body>

</html>