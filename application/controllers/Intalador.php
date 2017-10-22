<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Intalador extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		 $this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('Intalador/Intalar');
	}
	function Create()
	{
      $cn = mysqli_connect($_POST['txtservidor'],$_POST['txtUsuario'],$_POST['txtPassword']);
      if($_POST && $cn==true)
      {
       $informacion2 = "<?php
       if (!defined('BASEPATH')) exit('No direct script access allowed');";
	   $informacion2.="\n";
       $informacion2.="$"."active_group = 'default';";
	   $informacion2.="\n";
       $informacion2.="$"."active_record = TRUE;";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['hostname'] = '{$_POST['txtservidor']}';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['username'] = '{$_POST['txtUsuario']}';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['password'] = '{$_POST['txtPassword']}';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['database'] = '{$_POST['txtdb']}';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['dbdriver'] = 'mysql';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['dbprefix'] = '';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['pconnect'] = TRUE;";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['db_debug'] = TRUE;";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['cache_on'] = FALSE;";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['cachedir'] = '';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['char_set'] = 'utf8';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['dbcollat'] = 'utf8_general_ci';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['swap_pre'] = '';";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['autoinit'] = TRUE;";
	   $informacion2.="\n";
       $informacion2.="$"."db['default']['stricton'] = FALSE; ";"";
      file_put_contents('application/config/database.php', $informacion2);
	
	  $sql = "CREATE DATABASE IF NOT EXISTS {$_POST['txtdb']};";
	  mysqli_query($cn,$sql);
	
	  $sql1 = "use {$_POST['txtdb']};";
	  mysqli_query($cn,$sql1);

	
		 
		 	$sql3 = "Create table factura
                    (
                      codigo int auto_increment not null,
                      cliente varchar(50) not null,
                      rnc varchar(9) not null,
                      fecha date not null,
                      descripcion varchar(100),
                      primary key(codigo)
                    );"; 
           mysqli_query($cn,$sql3);
           $sql4 = "Create table detalle_factura
                   (
                      id int auto_increment not null,
                      codigo_factura int not null,
                      codigo_articulo int not null,
                      nombre_articulo varchar(50) not null,
                      precio_articulo int not null,
                      cantidad_articulo int not null,

                      comentario varchar(200),
                      primary key(id)
                   );"; 
           mysqli_query($cn,$sql4);
$_POST = null;
    $this->load->view('factura/Inicio');
 
  } 
 else if(!$cn)
 {
	 echo "<h2>No hubo conexion</h2><a href='<?php echo base_url('index.php?/Intalador/Create') ?>'>
	 Ir a Intalador</a>";
 }
 else
 {
   echo "<h2>No hubo post</h2> <a href='<?php echo base_url('index.php?/Intalador/Create') ?>'>
	 Ir a Intalador</a>";
 }


 }


}

 ?>