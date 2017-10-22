<?php 

require 'fpdf/fpdf.php';
class PDF extends FPDF
{
	
	function Header()
	{
		$this->SetFont('Arial','B',15);
		$this->SetTextColor(160,82,45);
		$this->Image('images/supermarket.png');
		$this->Cell(20);
		$this->SetTitle('Casa Comercial YEFFRI DUARTE Inc');
		$this->Cell(120,1, 'Factura de Compra Casa Comercial YEFFRI DUARTE Inc',0,0,'C');
		$this->Ln(10);
		$this->Cell(120,1,'Fecha de Factura: ' . date('d / F / y g:i a'));
		
		$this->Ln(20);
	}
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
	}	
}

/**
* 
*/
class factura extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}
	public function index()
	{
		$this->load->view('Factura/Inicio');
	}
	function Editar($id)
	{
		$codigo = array("Id"=>$id);
    	$this->load->view('Factura/Editar',$codigo);
	}
	function save_factura()
	{
		if($_POST)
		 {
	        $da  = array('cliente' => $_POST['txtcliente'], 'rnc' => $_POST['txtrnc'],
		'fecha' => $_POST['txtfecha'], 'descripcion' => $_POST['txtdescripcion'] );
		echo $da;
		$this->db->insert('factura',$da);

		$id = $this->db->insert_id();
		 	for($i=0; $i<count($_POST['codigo_articulo']); $i++)
		 	{
		 		$dat = array('codigo_factura'=>$id,'codigo_articulo'=>$_POST['codigo_articulo'][$i],'precio_articulo'=>$_POST['precio_articulo'][$i],'nombre_articulo'=>$_POST['nombre_articulo'][$i],
		 			'cantidad_articulo'=>$_POST['cantidad_articulo'][$i]);
		 		$this->db->insert('detalle_factura',$dat);
		 	}
		}

		$this->load->view('Factura/guardado');

	}

	function Crear()
	{
		return $this->load->view('Factura/Crear');
	}
	function actualizar_factura()
	{
		if($_POST)
		{
		 $da  = array('cliente' => $_POST['txtcliente'], 'rnc' => $_POST['txtrnc'],
		'fecha' => $_POST['txtfecha'], 'descripcion' => $_POST['txtdescripcion'] );
		
		$idfactura = $_POST['id_factura'];
		$where = "codigo = $idfactura";
		$this->db->update('factura',$da,$where);

		$this->db->delete('detalle_factura',array('codigo_factura'=>$idfactura));

		 	for($i=0; $i<count($_POST['codigo_articulo']); $i++)
		 	{
		 		$dat = array('codigo_factura'=>$idfactura,'codigo_articulo'=>$_POST['codigo_articulo'][$i],'precio_articulo'=>$_POST['precio_articulo'][$i],'nombre_articulo'=>$_POST['nombre_articulo'][$i],
		 			'cantidad_articulo'=>$_POST['cantidad_articulo'][$i]);
		 		$this->db->insert('detalle_factura',$dat);
		 	}
		}

		$this->load->view('Factura/guardado');
	}

	function imprimir_factura($id)
	{
		$query = $this->db->query("select * from factura where codigo={$id};");
		$resultado = $query->result_array();
   	   $pdf = new PDF();
   	   $pdf->AliasNbPages();
   	   $pdf->AddPage();

   	   //datos del cliente////////////////////////////////////
   	   $codigo = $resultado[0]['codigo'];
   	   $nombre = $resultado[0]['cliente'];
   	   $rnc = $resultado[0]['rnc'];
   	   $descripcion = $resultado[0]['descripcion'];
   	   $fecha = $resultado[0]['fecha'];

   	   $pdf->SetFillColor(232,232,232);
   	   $pdf->SetFont('Arial','B',12);
   	    $pdf->SetTextColor(87,177,255);

   	   $pdf->Cell(15,6,'Codigo:',0,0,'C');
       $pdf->Cell(5,6,$codigo,0,0,'C');
   	   $pdf->Cell(20,6,'Cliente:',0,0,'C');
       $pdf->Cell(10,6,$nombre,0,0,'C');
	   $pdf->Cell(20,6,'RNC: ',0,0,'C');
   	   $pdf->Cell(10,6,$rnc,0,0,'C');
   	   $pdf->Ln(6);
   	   $pdf->Cell(25,6,'Descripcion: ',0,0,'C');
       $pdf->Cell(16,6,$descripcion,0,0,'C');    
       $pdf->Ln(6);   
	   $pdf->Cell(33,6,'Fecha Compra:',0,0,'C');
   	   $pdf->Cell(20,6,$fecha,0,0,'C');
   	   $pdf->Ln(10);
      ///////////////////////////////////////////////////////

   	   //datos de la compra
   	   $query1 = $this->db->query("select * from detalle_factura where codigo_factura={$id};");
		$resultado1 = $query1->result_array();

   	   /////////////////////////////////

		$subtotal = 0;
		$impuesto = 0;
		$total = 0;
   	   /////////////////////////////////////////////////////
		$pdf->SetTextColor(159,169,169);
		
   	   //salida delos productos comprados
       $pdf->Cell(125,1, 'Productos Facturados',0,0,'C');
       $pdf->SetTextColor(0,128,0);
       $pdf->Ln(8);
   	   $pdf->Cell(20,6,'Codigo',1,0,'C',1);
   	   $pdf->Cell(40,6,'Producto',1,0,'C',1);
   	   $pdf->Cell(40,6,'Precio',1,0,'C',1);
   	   $pdf->Cell(40,6,'Cantidad',1,1,'C',1);
   	   $pdf->SetTextColor(160,82,45);
       foreach($resultado1 as $row)
   	   {
   	   	 $pdf->Cell(20,6,utf8_decode($row['codigo_articulo']),1,0,'C');
   	   	 $pdf->Cell(40,6,utf8_decode($row['nombre_articulo']),1,0,'C');
   	   	 $pdf->Cell(40,6,utf8_decode($row['precio_articulo']),1,0,'C');
   	   	 $pdf->Cell(40,6,utf8_decode($row['cantidad_articulo']),1,1,'C');
   	   	 $subtotal += $row['precio_articulo']*$row['cantidad_articulo'];
   	   }
   	   $pdf->Ln(10);

   	   $impuesto = round($subtotal*0.18);
   	   $total = $subtotal+$impuesto;
       //salida gastos////////////////////////////
       $pdf->SetTextColor(210,105,30);
   	    $pdf->Cell(10,6,'Subtotal: ',0,0,'C');
       $pdf->Cell(20,6,$subtotal. "$",0,0,'C');
   	   $pdf->Cell(10,6,'ITBIS: ',0,0,'C');
       $pdf->Cell(15,6,$impuesto. "$",0,0,'C');
	   $pdf->Cell(12,6,'Total: ',0,0,'C');
   	   $pdf->Cell(10,6,$total . "$",0,0,'C');
   	   ///////////////////////////////

	   $pdf->Output();


	}
}

 ?>