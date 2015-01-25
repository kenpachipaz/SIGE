<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 
  if($_SESSION["tipo"]){
    header("Location:resgistro.php");
  }
  
	$i=$_POST["imprime"];
  switch ($i) {   
    case 1:
      $q="SELECT * FROM electoral INNER JOIN dtperselect INNER JOIN domelect WHERE electoral.claveelectoral= dtperselect.claveelectoral AND electoral.claveelectoral= domelect.claveelectoral AND domelect.claveelectoral= dtperselect.claveelectoral";
      imprimePDF($q, $i);
    break;
    case 2:
      $q="SELECT * FROM coordinadores INNER JOIN dtperscoor INNER JOIN domcoord WHERE coordinadores.cvecoord= dtperscoor.cvecoord AND coordinadores.cvecoord= domcoord.cvecoord AND domcoord.cvecoord= dtperscoor.cvecoord";
      imprimePDF($q, $i);
    break;
    case 3:
      $q="SELECT * FROM intdet INNER JOIN dtpersintdet INNER JOIN domintdet WHERE intdet.claveindt = dtpersintdet.claveindt AND intdet.claveindt = domintdet.claveindt AND dtpersintdet.claveindt = domintdet.claveindt";
      imprimePDF($q, $i);
    break;
    default:
      header("Location:qimprime.php?nada=1");
    break;
  }

  function imprimePDF($query, $n){
    require_once('PDF/class.ezpdf.php');
    include("acceso.php");
    $imprimirPDF=new Cezpdf('A3', 'landscape');
    $imprimirPDF->selectFont('fonts/Helvetica.afm');
    $query=mysql_query($query) or die 
              ("<br>Error de consulta </br>".mysql_error());
   $options = array('showBgCol'=>1,'shadeCol'=>array(0,1,41), 'shadeCol2'=>array(255,0,0));
    switch ($n) {
      case 1:
        while($row=mysql_fetch_row($query)){
         $data[]=array('Clave electoral'=>$row[0], 
                 'Nombre Completo'=>$row[4]." ".$row[5]." ".$row[6],
                 'Domicilio'=>$row[14].",".$row[13].",".$row[12]." ".$row[11],
                 'Código postal'=>$row[15],
                 'Sección'=>$row[2],
                 'Teléfono'=>"Fijo: ".$row[7]." Celular:".$row[8],
                 'Email'=>$row[9],
                 'Cargo'=>$row[1],
                 'Observaciones'=>$row[16]);
        }
      break;
      case 2:
        while($row=mysql_fetch_row($query)){
         $data[]=array('Clave electoral'=>$row[0], 
                 'Nombre Completo'=>$row[6]." ".$row[7]." ".$row[8],
                 'Domicilio'=>$row[16].",".$row[15].",".$row[14]." ".$row[13],
                 'Código postal'=>$row[17],
                 'Sección'=>$row[3],
                 'Teléfono'=>"Fijo: ".$row[9]." Celular:".$row[10],
                 'Email'=>$row[11],
                 'Area'=>$row[1],
                 'Cargo'=>$row[2],
                 'Observaciones'=>$row[18]);
        }
      break;
      case 3:
         while($row=mysql_fetch_row($query)){
         $data[]=array('Clave electoral'=>$row[0], 
                 'Nombre Completo'=>$row[5]." ".$row[6]." ".$row[7],
                 'Domicilio'=>$row[15].",".$row[14].",".$row[13]." ".$row[12],
                 'Código postal'=>$row[16],
                 'Sección'=>$row[2],
                 'Teléfono'=>"Fijo: ".$row[8]." Celular:".$row[9],
                 'Email'=>$row[10],
                 'Cargo'=>$row[1],
                 'Observaciones'=>$row[17]);
        }
      break;
    }
    
    //$titles=array('Clave electoral'=>'idcveelectoral', 'nom'=>'app','Apellido Materno'=>'apm','Nombre'=>'Nombre');
    $tituloPDF="Personas registradas en el Sistema Integral de Gestión Electoral (SIGE) Fecha:".date("d.m.y");
   // $imprimirPDF->ezText($tituloPDF, 14);
    $imprimirPDF->ezText($tituloPDF."\n",20,array('justification'=>'center'));
    $imprimirPDF->ezTable($data,'','',$options);
    $imprimirPDF->ezStream();
  }
?>
