<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Correo AEME</title>
  </head>
  <body>
    <h2>RECEPCION DE MATERIAL
      <br>
      Llegada material de OT: {{$info->ot}} </h2>
    <ul>
      <li>Material: {{$info->descripcion}}</li>
      <li>Cantidad: {{$info->cantidad}}</li>
      <li>Fecha: {{$info->updated_at}}</li>
    </ul>
  </body>
</html>
