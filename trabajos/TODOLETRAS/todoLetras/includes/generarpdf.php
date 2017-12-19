<?php
//cogemos las variables que nos interesan
$titulo = $_GET['titulo'];
$precio = $_GET['precio'];
$id = $_GET['id'];
$usuario = $_GET['usuario'];
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$anio = $_GET['anio'];

 //Fpdf necesita que llames a su funcion para empezar a usarlo 
ob_end_clean();
require('../fpdf/fpdf.php');
//con esto creamos un nuevo pdf 
$pdf = new FPDF();
//añadimos una pagina
$pdf->AddPage();
//le indicamos las fuentes, en este caso es Arial, negrita y subrayado, tamaño 16
$pdf->SetFont('Arial','BU',16);
// ln es un salto de lineas de 35 lineas 
$pdf->ln(35);
//Indicamos los margenes
$pdf->SetRightMargin(40);
$pdf->SetLeftMargin(30);
//empezamos a escribir nuestro codigo, utilizamos MULTICELL, para texto largo, siendo 160 los caracteres de derecha a izquierda y el 7 no se lo que es
//con esta linea metemos el logo en la pagina, siendo el 20 y 19 la posicion en x e y en la pagina 
//Y el 100 es el ancho que le hemos dado para que el programa solo calcule su alto
$pdf->Image('../imagenes/logotipo.png','20', '19', '100');
$pdf->MultiCell(160,7,'FACTURA',0,'C');
$pdf->ln();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(160,7,'Numero de pedido: ['.$id.']',0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(160,7,'Nombre de usuario: '.$usuario.'',0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(160,7,'Articulo: ',0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(160,7,''.$titulo.'',0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(160,7,'Precio: ',0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(160,7,''.$precio.'',0,'L');
$pdf->ln();
$pdf->ln();
$pdf->MultiCell(160,7,'IVA: 16% (ya incluido)',0,'R');
$pdf->ln();
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(160,7,'TOTAL: '.$precio.'',0,'R');
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(160,7,'Factura emitida el dia: '.$dia.'-'.$mes.'-'.$anio.'',0,'R');
$pdf->MultiCell(160,7,'Articulo enviado a traves de la direccion de paypal',0,'R');
$pdf->ln();
$pdf->ln();
$pdf->MultiCell(160,7,'Gracias por confiar en nosotros',0,'R');
$pdf->ln();
$pdf->Image('../imagenes/firma.jpg','150', '190', '30');
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->ln();
//esta es la salida por pantaya
$pdf->Output();
//esta es la salida
$pdf->Output("factura.pdf","F");
?>