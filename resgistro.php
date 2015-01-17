<!DOCTYPE html>
<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:login.html');
    exit;
  } 

?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Administrador</title>
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
        <li><a href="#" onclick="mostrarSeccion(3);">Registro</a></li>
        <li><a href="#" onclick="mostrarSeccion(2);" >Buscar</a></li>        
        <li><a href="cerrarSesion.php">Salir</a></li>
      </ul>
    </nav>
    <section class="cuerpo">
      <iframe id="registro" src="formulario.php">Tu navegador no soporta iframe</iframe>
      <iframe id="consulta" src="consulta.php" style="display:none;">Tu navegador no soporta iframe</iframe>
    </section>
    <footer>
        <center>
          <h3 id="pie">Copyright&copySIGE|sige.co</h3>
        </center>
    </footer> 
  </body>
</html>