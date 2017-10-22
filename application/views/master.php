<?php 
  if (!defined('BASEPATH')) exit('No direct script access allowed');
class plantilla 
{
	static $instancia = null;
	public static function inicio()
	{
		if(self::$instancia==null)
		{
			self::$instancia = new plantilla();
		}
	}
	function __construct()
	{
		
		?>
	<!doctype html>
	<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tarea6</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">


<script type="text/javascript">

function calcular()
{
    td_subtotal = document.getElementById('subtotal');
    td_impuesto = document.getElementById('itbis');
    td_total = document.getElementById('total');

    precios = document.getElementsByName('precio_articulo[]');
    cantidades = document.getElementsByName('cantidad_articulo[]');
    misubtotal = 0;
    miimpuesto = 0;
    mitotal = 0;
    for (i = 0; i<precios.length;i++)
    {
         misubtotal += Number(precios[i].value) * Number(cantidades[i].value);

    }

    miimpuesto = Math.round(misubtotal*0.18);
    mitotal = misubtotal+miimpuesto;

    td_subtotal.innerHTML = 'Subtotal:' + misubtotal+ '$';  
    td_subtotal.setAttribute('value',misubtotal);

    td_impuesto.innerHTML = 'ITBIS:' + miimpuesto + '$';  
    td_impuesto.setAttribute('value',miimpuesto);

    td_total.innerHTML = 'Total:' + mitotal+ '$';  
    td_total.setAttribute('value',mitotal);


}

  function crearCampo(nombre) {
    td = document.createElement('td');
    txt = document.createElement('input');
    txt.type='text';
    txt.setAttribute('name',nombre);
    txt.setAttribute('required','required');
    txt.setAttribute('onChange',calcular());
    td.appendChild(txt);
    return td;
  }

  function crearCampoNumerico(nombre)
  {
    td = document.createElement('td');
    txt = document.createElement('input');
    txt.type='number';
    txt.setAttribute('name',nombre);
    txt.setAttribute('onChange',calcular());
    txt.setAttribute('required','required');
    td.appendChild(txt);
    return td;
  }



   
  function agregarfila()
  {
    destino = document.getElementById('tbl_articulos');
    tr = document.createElement('tr');
    tr.appendChild(crearCampoNumerico('codigo_articulo[]'));
    tr.appendChild(crearCampo('nombre_articulo[]'));
    tr.appendChild(crearCampoNumerico('precio_articulo[]'));
    tr.appendChild(crearCampoNumerico('cantidad_articulo[]'));
    td = document.createElement('td');
    btn = document.createElement('button');
    btn.type='button';
    btn.setAttribute('onclick','removefila(this)');
    btn.innerHTML='Quitar';
    td.appendChild(btn);
    tr.appendChild(td);
    destino.appendChild(tr);

  }


  function agregarfila_editar()
  {
    destino = document.getElementById('tbl_articulos_editar');
    tr = document.createElement('tr');
    tr.appendChild(crearCampo('codigo_articulo[]'));
    tr.appendChild(crearCampo('nombre_articulo[]'));
    tr.appendChild(crearCampoNumerico('precio_articulo[]'));
    tr.appendChild(crearCampoNumerico('cantidad_articulo[]'));
    td = document.createElement('td');
    btn = document.createElement('button');
    btn.type='button';
    btn.setAttribute('class','btn btn-danger');
    btn.setAttribute('onclick','removefila(this)');
    btn.innerHTML='X';
    td.appendChild(btn);
    tr.appendChild(td);
    destino.appendChild(tr);

  }

 
  function removefila(t)
  {
    var td = t.parentNode;
    var tr = td.parentNode;
    var tabla = tr.parentNode;
    tabla.removeChild(tr);
    calcular();

  }

</script>




  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url('index.php?/Factura/index'); ?>">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url('index.php?/Factura/index'); ?>">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('index.php?/Factura/Crear'); ?>">Crear Factura</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav> <br> <br> <br> <hr>
		<?php
	}
	function __destruct()
	{
		?>
		<br><br>
	 <br>  <br>  <br>  <br>
		  <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Tarea6 web 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



  </body>

</html>
<?php
	}
}