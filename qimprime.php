<!DOCTYPE html>
<?php
  session_start();
  if ($_SESSION["sesionOK"]!="si"){
    header('Location:index.php');
    exit;
  } 
  if($_SESSION["tipo"]){
    header("Location:resgistro.php");
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Búsqueda</title>
    <link rel="stylesheet" type="text/css" href="css/buscar-en-tabla.css" />
  </head>
  <body>
    <form action="imprimir.php" method="POST">
      <table>
        <tr>
          <td>Imprimir</td>
          <td>
             <select name="imprime">
                <option value="nada">---Seleccione impresión---</option>
                <option value="1">Electoral</option>
                <option value="2">Coordinadores</option>
                <option value="3">Integrantes/Detectados</option>
                </select>
          </td>
          <td>
            <input type="submit" value="Imprimir" name="imprimir">
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <?php 
              if($_GET["nada"]==1)
                echo "<p style='color:red;'>Seleccione que es lo que quiere imprimir</p>";
            ?>
          </td>
        </tr> 
      </table>
    </form>
  </body>
</html>
