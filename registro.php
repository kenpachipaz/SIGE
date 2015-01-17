<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 
  include("acceso.php");
  $cvElectoral=$_POST["clave"];
  $ap=$_POST["ap"];
  $am=$_POST["am"];
  $nombre=$_POST["nombre"];
  $telefono=$_POST["tel"];
  $email=$_POST["email"];
  $cp=$_POST["cp"];
  $calle=$_POST["calle"];
  $colonia=$_POST["colonia"];
  $municipio=$_POST["municipio"];
  $seccion=$_POST["sElectoral"];
  $cargo=$_POST["cargo"];
  $observaciones=$_POST["obs"];

  settype($cvElectoral, "string");
  settype($ap, "string");
  settype($am, "string");
  settype($nombre, "string");
  settype($telefono, "int");
  settype($email, "string");
  settype($cp, "int");
  settype($calle, "string");
  settype($colonia, "string");
  settype($municipio, "string");
  settype($seccion, "int");
  settype($cargo, "string");
  settype($observaciones, "string");

  $_SESSION["municipio"]=$municipio;
  $_SESSION["colonia"]=$colonia;
  $_SESSION["calle"]=$calle;
  
  $query=mysql_query("CALL insertarDatos('$cvElectoral', '$ap', '$am', '$nombre', '$telefono', '$email', '$seccion', '$cargo', '$observaciones', '$cp', '$calle', '$colonia', '$municipio')") or die ("No se pude registrar".mysql_error());

  if($query)
  	header('Location:formulario.php?registrado=true');
  else
  	header('Location:formulaio.php?registrado=false');