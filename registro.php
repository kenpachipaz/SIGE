<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 
  include("acceso.php");
    $movilidad="Movilidad";
    $redes="Redes";
    $municipio="CUERNAVACA";

    $cvElectoral=$_POST["clave"];
    $ap=$_POST["ap"];
    $am=$_POST["am"];
    $nombre=$_POST["nombre"];
    $telefono=$_POST["tel"];
    $cel=$_POST["cel"];
    $email=$_POST["email"];
    $cp=$_POST["cp"];
    $calle=$_POST["calle"];
    $numero=$_POST["numero"];
    $colonia=$_POST["colonia"];
    $seccion=$_POST["sElectoral"];
    $cargo=$_POST["cargo"];
    $observaciones=$_POST["obs"];
    $area=$_POST["area"];

    $cargoElectoral=$_POST["cargoElectoral"];
    $cargoRedes=$_POST["cargoRedes"];
    $cargoMovilidad=$_POST["cargoMovilidad"];

    $clavePerElectoral=$_POST["personaElectoral"];
    $claveCoordMov=$_POST["coordinadorMov"];
    $claveCoordRed=$_POST["coordinadorRed"];

    settype($cvElectoral, "string");
    settype($ap, "string");
    settype($am, "string");
    settype($nombre, "string");
    settype($telefono, "string");
    settype($email, "string");
    settype($cp, "string");
    settype($calle, "string");
    settype($colonia, "string");
    settype($seccion, "string");
    settype($cargo, "string");
    settype($observaciones, "string");
    settype($cel, "string");
    settype($numero, "string");


    switch($area){
      case 0:
        $query=mysql_query("CALL electoral('$cvElectoral', '$cargoElectoral', '$seccion', '$ap',".
              "'$am', '$nombre', '$telefono', '$cel', '$email', '$calle', '$numero',".
              "'$colonia', '$municipio', '$cp','$observaciones')");
        if($query){
           header('Location:formulario.php?registrado=true');
           $_SESSION["colonia"]=$colonia;
           $_SESSION["calle"]=$calle;
           $_SESSION["numero"]=$numero;
        }
        else{
            header('Location:formulario.php?registrado=false');
        }        
      break;
      case 1:
        if(strcmp($cvElectoral, $clavePerElectoral) == 0){
          header('Location:formMovilidad.php?registrado=false');
        }
        else{
          if(strcmp($cargoMovilidad, "Coordinador") == 0){
              $query=mysql_query("CALL coordinadores('$cvElectoral', '$movilidad', '$cargoMovilidad', '$seccion',".
                "'$clavePerElectoral', '$ap', '$am', '$nombre', '$telefono', '$cel','$email', '$calle', '$numero',".
                "'$colonia', '$municipio', '$cp', '$observaciones')") or die("Error---> ".mysql_error());
           }
           else if(strcmp($cvElectoral, $claveCoordMov)== 0){
                header('Location:formMovilidad.php?registrado=false');
           }
           else{
              $query=mysql_query("CALL intdet('$cvElectoral', '$cargoMovilidad', '$seccion', '$claveCoordMov',".
                      "'$ap', '$am', '$nombre', '$telefono', '$cel', '$email', '$calle', '$numero', '$colonia',".
                      "'$municipio', '$cp', '$observaciones')") or die("ERROR---> ".mysql_error());
           }
        }
        if($query){
           header('Location:formMovilidad.php?registrado=true');
           $_SESSION["colonia"]=$colonia;
           $_SESSION["calle"]=$calle;
           $_SESSION["numero"]=$numero;
        }
        else{
          header('Location:formMovilidad.php?registrado=false');
        }

      break;
      case 2:
        if(strcmp($cvElectoral, $clavePerElectoral) == 0){
          header('Location:formRedes.php?registrado=false');
        }
        else{
          if(strcmp($cargoRedes, "Coordinador") == 0){
              $query=mysql_query("CALL coordinadores('$cvElectoral', '$redes', '$cargoRedes', '$seccion',".
                "'$clavePerElectoral', '$ap', '$am', '$nombre', '$telefono', '$cel','$email', '$calle', '$numero',".
                "'$colonia', '$municipio', '$cp', '$observaciones')") or die("Error---> ".mysql_error());
           }
           else if(strcmp($cvElectoral, $claveCoordRed)== 0){
                header('Location:formRedes.php?registrado=false');
           }
           else{
              $query=mysql_query("CALL intdet('$cvElectoral', '$cargoRedes', '$seccion', '$claveCoordRed',".
                      "'$ap', '$am', '$nombre', '$telefono', '$cel', '$email', '$calle', '$numero', '$colonia',".
                      "'$municipio', '$cp', '$observaciones')") or die("ERROR---> ".mysql_error());
           }
        }
         if($query){
           header('Location:formRedes.php?registrado=true');
           $_SESSION["colonia"]=$colonia;
           $_SESSION["calle"]=$calle;
           $_SESSION["numero"]=$numero;
        }
        else
          header('Location:formRedes.php?registrado=false');
      break;
    }
  
  
  