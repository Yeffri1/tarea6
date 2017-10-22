<?php 
  $CI =& get_instance();
  $CI->load->helper('url');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Intalar Servidor</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	
<div class="container">
	<center>
<div class="col col-md-6">
<form method="post" action="<?php echo base_url('index.php?/Intalador/Create') ?>" >
<br><br><br>
<div class="row">
<br><br><br>
<h2>Instalador de Servidor</h2>

<div class="input-group form-group">
<span class="input-group-addon">Servidor:</span>
<input type="text" name="txtservidor" autofocus required placeholder="Escribe tu Servidor" class="form-control" alt="Escribir tu Servidor" />
</div>

<div class="input-group form-group">
<span class="input-group-addon">Usuario:</span>
<input type="text" name="txtUsuario"  required placeholder="Escribe tu Usuario" class="form-control" alt="Escribir tu Usuario" />
</div>

<div class="input-group form-group">
<span class="input-group-addon">Password:</span>
<input type="text" name="txtPassword"  placeholder="Escribe tu Password" class="form-control" alt="Escribir tu Password" />
</div>

<div class="input-group form-group">
<span class="input-group-addon">Base de datos:</span>
<input type="text" name="txtdb"  required placeholder="Escribe tu Base de datos" class="form-control" alt="Escribir tu Base de datos" />
</div>

</div>

<input type="submit" value="Intalar" class="btn btn-primary">

</form>
</div>
</center>
</div>

</body>
</html>

