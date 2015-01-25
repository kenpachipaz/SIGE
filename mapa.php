<!DOCTYPE html>
<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 

?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicación</title>
    <link rel="shortcut icon" href="imagenes/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/mostrarSeccion.js"></script>
    <script type="text/javascript"   src="https://maps.google.com/maps/api/js?sensor=false"></script>
       
     <?php 
      $domicilio=$_GET["domicilio"];
      $idMapa="mapa";
      $array=explode(",", $domicilio);
    ?>

  </head>
  <body>
    <div id="container">
      <?php 
        echo "<script>mapa('$domicilio', '$idMapa');</script>";
      ?>
      <h1>Ubicación: <?php echo $_GET["nombre"];?><h1>
      <h2>Domicilio: <?php echo "Municipio: ".$array[0].", Colonia: ".$array[1].", Calle: ".$array[2];?></h2>
      <div id="mapa" style="width:500px;height:380px;"></div>
    </div>
    <br/>
    <button  onclick="window.print();">Imprimir Mapa</button>
  </body>
</html>