<!DOCTYPE html>
<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 
  if(!$_SESSION["tipo"]){
    header("Location:admin.php");
  }

?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="shortcut icon" href="imagenes/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/mostrarSeccion.js"></script>
  </head>
  <body>
    <header>
      <div id="cabecera">
        <img src="imagenes/SIGE.png" />
      </div>
    </header>
    <div>
    <nav class="container">
      <ul id="menu" >
        <li><a href="#" style="color:red;" id="textoElec" onclick="mostrarSeccion(3);">Electoral</a></li>
        <li><a href="#" id="textoMov" onclick="mostrarSeccion(4);">Movilidad</a></li>
        <li><a href="#" id="textoRed" onclick="mostrarSeccion(5);">Redes</a></li>
        <li><a href="#" id="textoBus" onclick="mostrarSeccion(2);" >Buscar</a></li>        
        <li><a href="cerrarSesion.php">Salir</a></li>
      </ul>
    </nav>
    <section class="cuerpo">
      <iframe id="registro" src="formulario.php">Tu navegador no soporta iframe</iframe>
      <iframe id="consulta" src="consulta.php" style="display:none;">Tu navegador no soporta iframe</iframe>
      <iframe id="movilidad" src="formMovilidad.php" style="display:none;">Tu navegador no soporta iframe</iframe>
      <iframe id="redes" src="formRedes.php" style="display:none;">Tu navegador no soporta iframe</iframe>
    </section>
    <footer>
        <center>
          <h3 id="pie">Copyright&copySIGE|sige.co</h3>
        </center>
    </footer> 
  </body>
</html>