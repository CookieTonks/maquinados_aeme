<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><meta charset="gb18030">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>

<style media="screen">
.table
{
  margin-bottom: 0rem !important;
}
.table th,
.table td 
{
  padding: 0rem !important;
}
</style>
  <body>
<table class="table table-borderless">
  <thead>
    <tr>
      <th ><img src="maquinadosaeme.png" width="250px"></th>
      <th  style="text-align-last: right;"><p>Orden de Trabajo: {{$datos->orden_trabajo}}</p><p>Revision: FPR 03, Rev - 08</p></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG( $datos->orden_trabajo,'C39') }}" height="30" width="220" /><br/></td>
    </tr>
  </tbody>
</table>
<p><p>


<!--Primer cuadro-->
		<div class="card bg-primary" style="font-size:x-small;">
		  <div style="    text-align:center;" class="card-header">Datos Generales</div>
		</div>
		<table class="table table-borderless">
				<tr>
					<td scope="col">
						<div class="form-group">
				      <label style="font-size:x-small;">Cliente</label>
							<input type="text" value="{{$datos->cliente}}" style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
				    </div>
					</td>
					<td scope="col">
						<div class="form-group">
				      <label style="font-size:x-small;">Cantidad de Piezas</label>
							<input type="text" value="{{$datos->cant_pieza}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
				    </div>
					</td>
				</tr>
				<tr>
					<td scope="col">
						<div class="form-group">
				      <label style="font-size:x-small;">Fecha de Expedicion</label>
				      <input type="text" value="{{$datos->fecha_inicio}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
				    </div>
					</td>
					<td scope="col">
						<div class="form-group">
				      <label style="font-size:x-small;">Fecha de Entrega</label>
							<input type="text" value="{{$datos->fecha_entrega}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
				    </div>
					</td>
				</tr>
		</table>

    <!--Primer cuadro-->
		<div class="card bg-primary" style="font-size:x-small;">
		  <div style="    text-align:center;" class="card-header">Datos Tecnicos</div>
		</div>
		<table class="table table-borderless">
      <tr>
        <td style="width="33%";">
          <div class="form-group">
            <label style="font-size:x-small;">Orden de Compra</label>
            <input type="text" value="{{$datos->orden_compra}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
          </div>
        </td>
        <td style="width="34%";">
          <div class="form-group">
            <label style="font-size:x-small;">Proyecto</label>
            <input type="text" value="{{$datos->fuente}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
          </div>
        </td>
        <td style="width="33%";">
          <div class="form-group">
            <label style="font-size:x-small;">Codigo de Pieza</label>
            <input type="text" value="{{$datos->codigo_pieza}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
          </div>
        </td>
      </tr>
		</table>

    <table class="table table-borderless">
<tr>
<td scope="col">
<div class="form-group">
  <label style="font-size:x-small;">Tratamiento termico</label>
  <input type="text" value="{{$datos->tt}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
</div>
</td>
<td scope="col">
<div class="form-group">
  <label style="font-size:x-small;">Tipo de material</label>
  <input type="text" value="{{$datos->tipo_material}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
</div>
</td>
<td scope="col">
<div class="form-group">
  <label style="font-size:x-small;">Número de serie</label>
  <input type="text" value="{{$datos->numero_serie}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
</div>
</td>
</tr>
</table>

<table class="table table-borderless">
  <tr>
    <td scope="col">
      <div class="form-group">
        <label style="font-size:x-small;">Usuario</label>
        <input type="text" value="{{$datos->usuario}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
      </div>
    </td>
    <td scope="col">
      <div class="form-group">
        <label style="font-size:x-small;">Dibujo</label>
        <input type="text" value="{{$datos->dibujo}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">
      </div>
    </td>
  </tr>
</table>

<table class="table table-borderless">
  <tr>
    <td scope="col">
      <div class="form-group">
        <label style="font-size:x-small;">Descripcion</label>
        <input type="text" value="{{$datos->descripcion}}"  style="font-size:xx-small;padding: 0.375rem 0.75rem;width: 100%;display: block;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: 0.25rem;">


      </div>
    </td>
  </tr>
</table>

    <div class="card bg-primary" style="font-size:xx-small;">
    <div style="text-align:center;" class="card-header">Proceso de OT</div>
  </div>
<br>
    <table class="table table-borderless" style="width:10px; height:auto;">
      <thead>
        @if($linea_uno == '1')
        <tr style="text-align:left; padding:">
           @for ($i = 0; $i <= 3; $i++)
           <td style="width:auto;">
             <div class="square">
               <div class="content" style="text-align:center">
                 {{$array[$i]}}
               </div>
             </div>
           </td>
           <td style="width:100px;">
             <div align="center">
               <img src="https://img.icons8.com/ios/452/arrow.png" style="width:25px; height:45px;">
             </div>
           </td>
           @endfor
        </tr>
        @endif


        @if($linea_uno == '2')
        <tr style="text-align:left; padding:">
           @for ($i = 0; $i <= 4; $i++)
           <td style="width:auto;">
             <div class="square">
               <div class="content" style="text-align:center">
                 {{$array[$i]}}
               </div>
             </div>
           </td>
           <td style="width:100px;">
             <div align="center">
               <img src="https://img.icons8.com/ios/452/arrow.png" style="width:25px; height:45px;">
             </div>
           </td>
           @endfor
        </tr>
        <tr style="text-align:left; padding:">
           @for ($i = 4; $i <= $contador; $i++)
           <td style="width:100px;">
             <div align="center">
               <img src="https://img.icons8.com/ios/452/arrow.png" style="width:25px; height:45px;">
             </div>
           </td>
           <td style="width:auto;">
             <div class="square">
               <div class="content" style="text-align:center">
                 {{$array[$i]}}
               </div>
             </div>
           </td>
           @endfor
        </tr>
        @endif

        @if($linea_uno == '3')
        <tr style="text-align:left; padding:">
           @for ($i = 0; $i <= 4; $i++)
           <td style="width:auto;">
             <div class="square">
               <div class="content" style="text-align:center">
                 {{$array[$i]}}
               </div>
             </div>
           </td>
           <td style="width:100px;">
             <div align="center">
               <img src="https://img.icons8.com/ios/452/arrow.png" style="width:25px; height:45px;">
             </div>
           </td>
           @endfor
        </tr>
        <tr style="text-align:left; padding:">
           @for ($i = 4; $i <= 6; $i++)
           <td style="width:100px;">
             <div align="center">
               <img src="https://img.icons8.com/ios/452/arrow.png" style="width:25px; height:45px;">
             </div>
           </td>
           <td style="width:auto;">
             <div class="square">
               <div class="content" style="text-align:center">
                 {{$array[$i]}}
               </div>
             </div>
           </td>
           @endfor
        </tr>
        <br>
        <tr style="text-align:left; padding:">
           @for ($i = 7; $i <= $contador; $i++)
           <td style="width:100px;">
             <div align="center">
               <img src="https://img.icons8.com/ios/452/arrow.png" style="width:25px; height:45px;">
             </div>
           </td>
           <td style="width:auto;">
             <div class="square">
               <div class="content" style="text-align:center">
                 {{$array[$i]}}
               </div>
             </div>
           </td>
           @endfor
        </tr>

        @else
        <tr style="text-align:left; padding:">
          <td>
          </td>
        </tr>
          @endif
      </thead>
    </table>
<br>
<br>
    <table class="table table-borderless">
    <tr style="text-align: center;">
          <td scope="col" style="font-size:xx-small;;">
            ____________________________	<br>
            Entrega (Nombre y Firma)
          </td>
          <td scope="col" style="font-size:xx-small;;">
            ____________________________	<br>
            Recibe (Nombre y Firma)
          </td>
        </tr>
    </table>
    <br>
    <table class="table table-borderless">
        <tr style="text-align: center; font-size:xx-small;">
          <td scope="col">
            <p> Fecha de termino: </p>
          </td>
          <td scope="col">
            <p> Recibio en calidad: </p>
          </td>
          <td>
            <p> Fecha de recibido:   </p>
          </td>
        </tr>
    </table>
		<center><p style="font-size:xx-small;">DOCUMENTO INTERNO DE MAQUINADOS AEME</p></center>
	</body>
</html>
<style>
.square
{
  border-style:solid;
  border-width:2px;
  border-color:black;
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
