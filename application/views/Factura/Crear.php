<?php 
include('application\views\master.php');
plantilla::inicio();
 ?>


<div class="container">
<h2>Sistema de Facturacion</h2>
<form action="<?php echo base_url('index.php?/Factura/save_factura')  ?>" method="post">
<div class="row">


<div class="col col-md-4">
<div class="form-group input-group">
<span class="input-group-addon">Cliente:</span>
<input type="text" maxlength="20" pattern="A-Z a-z" title="No se acepta numeros o caracteres extraños" name="txtcliente"  class="form-control" required placeholder="Cliente">
</div>
</div>

<div class=" offset-4 col col-md-4">
<div class="form-group input-group">
<span class="input-group-addon">RNC:</span>
<input type="text" name="txtrnc" pattern="0-9"  class="form-control" required placeholder="RNC" minlength="9" maxlength="9">
</div>
</div>

<div class=" offset-4 col col-md-4">
<div class="form-group input-group">
<span class="input-group-addon">Fecha:</span>
<input type="date" name="txtfecha" class="form-control" required placeholder="Fecha">
</div>
</div>

<div class="col col-md-4">
<div class="form-group input-group">
<span class="input-group-addon">Descripcion:</span>
<input type="text" maxlength="30" name="txtdescripcion" pattern="A-Za-z0-9" class="form-control" required placeholder="Descripcion">
</div>
</div>






</div>

<fieldset>
	<legend>Productos</legend>
	
	<table class="table table-bordered">
		<thead>
			<th>Codigo Articulo</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
		</thead>
		<tbody id="tbl_articulos">
			
		</tbody>

	  <tfoot>
 		<tr>
 			<td id="subtotal"></td>
 			<td id="itbis"></td>
 			<td id="total"></td>
 		</tr>
 	</tfoot>

	</table>

</fieldset>
<input type="submit" class="btn btn-success" value="Guardar">
<a class='btn btn-info' onclick='agregarfila();'>Agregar Productos</a>
</form>
</div>
 