<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Correo AEME</title>
  </head>
  <body>
    <h2>Orden de Trabajo: #{{$info->ot}}</h2>
    <ul>
      <li>Cliente: {{$info->cliente}}</li>
      <li>Descripcion: {{$info->comentario}}</li>
      <li>Cantida de Piezas: {{$info->cantidad}}</li>
      <li>Fecha de Inicio: {{$info->f_inicio}}</li>
      <li>Fecha de Entrega: {{$info->f_entrega}}</li>
      <li>Orden de Compra: {{$info->oc}}</li>
      <li>Fuente: {{$info->fuente}}</li>
      <li>Gerente: {{$info->supervisor}}</li>
      <li>Estatus: {{$info->estatus}}</li>
      <li>Codigo de Pieza: {{$info->cod_pieza}}</li>
      <li>Vendedor: {{$info->vendedor}}</li>
      <li>Proceso:
        <ul>
          <?php foreach ($info->proceso as $key): ?>
            <li>{{$key}}</li>
          <?php endforeach; ?>
        </ul>
      </li>
      <li>Usuario: {{$info->usuario}}</li>
      <li>Dibujo: {{$info->dibujo}}</li>
    </ul>
  </body>
</html>
