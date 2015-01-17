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
    <title>Búsqueda</title>
    <link rel="stylesheet" type="text/css" href="css/buscar-en-tabla.css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/buscar-en-tabla.js"></script>
  </head>
  <body>
    <div id="divContenedor">
      <div id="divTabla">
        <label for="txtBuscar">Buscar: </label>
        <input type="search" id="txtBuscar" autofocus
        placeholder="Digite el texto que desea encontrar y presione la ENTER. Para cancelar la tecla ESCAPE.">
        
        <table border="1" id="tblTabla" width="100%">
          <thead>
             <th>Clave Electoral</th>
             <th>Nombre Completo</th>
             <th>Domicilio</th>
             <th>Código postal</th>
             <th>Sección</th>
             <th>Telefóno</th>
             <th>Email</th>
             <th>Cargo</th>
             <th>Observaciones</th>
          </thead>
          <tbody>
            <tr>
              <?php
                include("acceso.php");
                mysql_query("SET NAMES 'UTF-8'");
                $consulta = mysql_query("SELECT * FROM datosperson INNER JOIN datoselector INNER JOIN domicilio where domicilio.idcveelectoral= datosperson.idcveelectoral and domicilio.idseccion=datoselector.idseccion");
                while($row = mysql_fetch_array($consulta)) {                            
              ?>
                <td><?php echo $row["idcveelectoral"]; ?></td>        
                <td><?php echo $row["app"]." ".$row["apm"]." ".$row["nombre"]; ?></td>            
                <td><?php echo $row["calle"].",".$row["colonia"].",".$row["municipio"];?></td>          
                <td><?php echo $row["cp"]?></td>
                <td><?php echo $row["idseccion"]?></td>
                <td><?php echo $row["telefono"]?></td>
                <td><?php echo $row["email"]?></td>
                <td><?php echo $row["cargo"]?></td>
                <td><?php echo $row["observaciones"]?></td>             
              </tr>                                        
              <?php } ?>
          </tbody>
          
        </table>
      </div>
    </div>
  </body>
