<?php 
include('application\views\master.php');
plantilla::inicio();

$CI =& get_instance();
 $result = $CI->db->query("Select * from factura where codigo='{$Id}'");
 $data = $result->row();
$miid=$data->codigo;

$result = $CI->db->query("Select * from detalle_factura where codigo_factura='{$Id}'");
 $detalle = $result->result_array();
 $nfila = $result->num_rows();

 ?>

<div class="container">
<form action='<?php echo base_url('index.php?/Factura/actualizar_factura')?>' method='post'>

<div class='row'>


<input readonly type='hidden' name='id_factura' value='<?php echo $data->codigo ?>'  class='form-control' >

<div class='form-group input-group'>
<span class='input-group-addon'>Cliente:</span>
<input type='text' name='txtcliente' value='<?php echo $data->cliente ?>'  class='form-control' required placeholder='Cliente'>
</div>

<div class='form-group input-group'>
<span class='input-group-addon'>RNC:</span>
<input type='text' name='txtrnc' value='<?php echo $data->rnc ?>'  class='form-control' required placeholder='RNC' minlength='9' maxlength='9'>
</div>


<div class='form-group input-group'>
<span class='input-group-addon'>Fecha:</span>
<input type='date' name='txtfecha' value='<?php echo $data->fecha ?>'  class='form-control' required placeholder='Fecha'>
</div>


<div class='form-group input-group'>
<span class='input-group-addon'>Descripcion:</span>
<input type='text' name='txtdescripcion' value='<?php echo $data->descripcion ?>'  class='form-control' required placeholder='Descripcion'>
</div>


</div>

<fieldset>
	<legend>Productos</legend>
	
	<table class='table table-bordered'>
		<thead>
			<th>Codigo Articulo</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
		</thead>
		<tbody id='tbl_articulos_editar'>
		<?php
			for($i=0; $i<$nfila; $i++)
			{
			  echo "
			  <tr>
			  <td><input type='text' name='codigo_articulo[]' value='{$detalle[$i]['codigo_articulo']}'></td>
			  <td><input type='text' name='nombre_articulo[]' value='{$detalle[$i]['nombre_articulo']}'></td>
			  <td><input type='text' name='precio_articulo[]' value='{$detalle[$i]['precio_articulo']}'></td>
			  <td><input type='text' name='cantidad_articulo[]' value='{$detalle[$i]['cantidad_articulo']}'></td>

			  <td>
              <a class='btn btn-danger' onclick='removefila(this);'>X</a>

			  </td>
			  </tr>
			  ";
			}
			?>

		</tbody>

		<tfoot>
 		<tr>
 			<td  id="subtotal"></td>
 			<td id="itbis"></td>
 			<td id="total"></td>
 		</tr>
 	</tfoot>

	</table>

</fieldset>
<input type='submit' class='btn btn-success' value='Editar'>
<a class='btn btn-info'  onclick='agregarfila_editar();'>Agregar Productos</a>
</form>


</div>




