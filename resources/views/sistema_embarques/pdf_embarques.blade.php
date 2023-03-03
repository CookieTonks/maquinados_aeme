<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="gb18030">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<style media="screen">
  .table {
    margin-bottom: 0rem !important;
  }

  .table th,
  .table td {
    padding: 0rem !important;
  }
</style>

<body>
  <br>
  <table class="table table-borderless">
    <thead>
      <tr>
        <th scope="col"><img src="maquinadosaeme.png" width="250px"></th>
        <th scope="col" style="text-align-last: right;">
          <p>Folio de salida: SC-{{$datos->folio}}</p>
          <p>Revision: F-AL-02, Rev.04</p>
        </th>
      </tr>
    </thead>
  </table>

  <!--Primer cuadro-->
  <div class="card bg-primary" style="font-size:x-small;">
    <div style="    text-align:center;" class="card-header">SALIDA DE EMBARQUES</div>
  </div>

  <table class="table table-borderless">
    <tr>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">OT</label>
          <input type="text" value=" {{$ot->orden_trabajo}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Cant. Piezas</label>
          <input type="text" value="{{$ot->cant_pieza}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Tipo de material</label>
          <input type="text" value="{{$ot->tipo_material}}" }}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
    </tr>
  </table>
  <!--Primer cuadro-->
  <div class="card bg-primary" style="font-size:x-small;">
    <div style="    text-align:center;" class="card-header">Datos de salida</div>
  </div>
  <table class="table table-borderless">
    <tr>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Tipo de salida</label>
          <input type="text" value="{{$datos->tipo_salida}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Dureza</label>
          <input type="text" value="{{$datos->dureza}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Fecha de salida</label>
          <input type="text" value="{{$datos->created_at}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
    </tr>
  </table>
  <table class="table table-borderless">
    <tr>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Cant. Piezas</label>
          <input type="text" value="{{$datos->cant_pieza}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Proveedor</label>
          <input type="text" value="{{$datos->proveedor}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
    </tr>
    <tr>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Solicito</label>
          <input type="text" value="{{$datos->solicito}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
      <td style="width: 50%;">
        <div class="form-group">
          <label style="font-size:x-small;">Chofer</label>
          <input type="text" value="{{$datos->chofer}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
    </tr>
  </table>
  <table class="table table-borderless">
    <tr>
      <td>
        <div class="form-group">
          <label style="font-size:x-small;">Observaciones</label>
          <input type="text" value=" {{$datos->observaciones}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
        </div>
      </td>
    </tr>
  </table>

  <div class="card bg-primary" style="font-size:xx-small;">
    <div style="text-align:center;" class="card-header">Firmas</div>
  </div>
  <br>
  <table class="table table-borderless">
    <tr style="text-align: center;">
      <td scope="col" style="font-size:xx-small;;">
        <br>
        <br>
        <br>
        <br> ____________________________
        <br> Entrega (Nombre y Firma)
      </td>s
      <td scope="col" style="font-size:xx-small;;">
        <br>
        <br>
        <br>
        <br> ____________________________
        <br> Recibe (Nombre y Firma)
      </td>
    </tr>
  </table>
  <br>
  <br>

  <center>
    <p style="font-size:xx-small;">DOCUMENTO INTERNO DE MAQUINADOS AEME</p>
  </center>
</body>

</html>
<style>
  .square {
    border-style: solid;
    border-width: 2px;
    border-color: black;
    border-radius: 10px;
    position: relative;
    width: 100px;
    height: 50px;

  }

  .square:after {
    content: "";
    display: block;
    padding-bottom: 100%;
  }

  .content {
    position: absolute;
    width: 100px;
    height: 50px;
  }
</style>