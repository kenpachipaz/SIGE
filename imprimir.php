<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 
  require_once('PDF/class.ezpdf.php');
  include("acceso.php");
  $imprimirPDF=new Cezpdf('A3', 'landscape');
  $imprimirPDF->selectFont('fonts/Helvetica.afm');
  $query=mysql_query("SELECT * FROM datosperson INNER JOIN datoselector INNER JOIN domicilio where domicilio.idcveelectoral= datosperson.idcveelectoral and domicilio.idseccion=datoselector.idseccion") or die 
  					("<br>Error de consulta </br>".mysql_error());
 $options = array('showBgCol'=>1,'shadeCol'=>array(0,1,41), 'shadeCol2'=>array(255,0,0));
  while($row=mysql_fetch_row($query)){
       $data[]=array('Clave electoral'=>$row[0], 
       				 'Nombre Completo'=>$row[1]." ".$row[2]." ".$row[3],
       				 'Domicilio'=>$row[10].",".$row[11].",".$row[12],
       				 'Código postal'=>$row[9],
       				 'Sección'=>$row[6],
       				 'Teléfono'=>$row[4],
       				 'Email'=>$row[5],
       				 'Cargo'=>$row[7],
       				 'Observaciones'=>$row[8]);
   }
  //$titles=array('Clave electoral'=>'idcveelectoral', 'nom'=>'app','Apellido Materno'=>'apm','Nombre'=>'Nombre');
  $tituloPDF="Personas registradas en el Sistema Integral de Gestión Electoral (SIGE) Fecha:".date("d.m.y");
 // $imprimirPDF->ezText($tituloPDF, 14);
  $imprimirPDF->ezText($tituloPDF."\n",20,array('justification'=>'center'));
  $imprimirPDF->ezTable($data,'','',$options);
  $imprimirPDF->ezStream();
	
?>
