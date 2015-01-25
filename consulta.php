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
    
    <script>
      function verDomicilio(ID){
        var domicilio= document.getElementById(ID).innerHTML;
        var nombre=document.getElementById("nombre"+ID).innerHTML;
        
        window.open("mapa.php?domicilio="+domicilio+"&nombre="+nombre+"","Mapa Ubicación","width=610,height=510");
      }
    </script>
  </head>
  <body>
    <form action="consulta.php" method="POST">
      <table>
        <tr>
          <td>Consultar</td>
          <td>
             <select name="consulta">
                <option value="nada">---Seleccione consulta---</option>
                <option value="1">Electoral</option>
                <option value="2">Coordinadores</option>
                <option value="3">Integrantes/Detectados</option>
                </select>
          </td>
          <td>
            <input type="submit" value="Consultar" name="consultar">
          </td>
        </tr>
      </table>
    </form>
    <?php 
        $con=$_POST["consulta"];
        if($con==1){
          $query="SELECT * FROM electoral INNER JOIN dtperselect INNER JOIN domelect WHERE electoral.claveelectoral= dtperselect.claveelectoral AND electoral.claveelectoral= domelect.claveelectoral AND domelect.claveelectoral= dtperselect.claveelectoral";
          $tabla=1;
        }
        else if($con==2){
          $query="SELECT * FROM coordinadores INNER JOIN dtperscoor INNER JOIN domcoord WHERE coordinadores.cvecoord= dtperscoor.cvecoord AND coordinadores.cvecoord= domcoord.cvecoord AND domcoord.cvecoord= dtperscoor.cvecoord";
          $tabla=2;
        }          
        else if($con==3){
          $query="SELECT * FROM intdet INNER JOIN dtpersintdet INNER JOIN domintdet WHERE intdet.claveindt = dtpersintdet.claveindt AND intdet.claveindt = domintdet.claveindt AND dtpersintdet.claveindt = domintdet.claveindt";
          $tabla=3;
        }
        else{
          echo "<p style='color:red;'>Eliga consulta</p>";
        }
          
    ?>
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
             <th>Telefóno(s)</th>
             <th>Email</th>
             <th>Cargo</th>
             <th>Observaciones</th>
             <th>Ubicación</th>
          </thead>
          <tbody>
            <tr>
              <?php
                include("acceso.php");
                mysql_query("SET NAMES 'UTF-8'");
                $consulta = mysql_query($query);
                $contador=0;
                switch($tabla){
                  case 1:
                
                   while($row = mysql_fetch_array($consulta)) {   
                    ?>
                        <td><?php echo $row["claveelectoral"]; ?></td>        
                        <td id="nombre<?php echo $contador;?>"><?php echo $row["app"]." ".$row["apm"]." ".$row["nombre"]; ?></td>            
                        <td id="<?php echo $contador;?>"><?php echo $row["municipio"].", ".$row["colonia"].", ".$row["calle"]." ".$row["numero"];?></td>          
                        <td><?php echo $row["cp"]?></td>
                        <td><?php echo $row["seccion"]?></td>
                        <td><?php echo "Fijo: ".$row["telefono"].", Celular:".$row["celular"]?></td>
                        <td><?php echo $row["email"]?></td>
                        <td><?php echo $row["cargo"]?></td>
                        <td><?php echo $row["observaciones"]?></td>   
                        <td><img src="imagenes/mapa.png" onclick="verDomicilio(<?php echo $contador;?>);"></td>          
                  </tr>                                        
                  <?php
                       $contador++;
                    } 
                    break;
                  case 2:
                      while($row = mysql_fetch_array($consulta)) {  
                        ?>
                        <td><?php echo $row["cvecoord"]; ?></td>        
                        <td id="nombre<?php echo $contador;?>"><?php echo $row["capp"]." ".$row["capm"]." ".$row["cnombre"]; ?></td>            
                        <td id="<?php echo $contador;?>"><?php echo $row["cmunicipio"].", ".$row["ccolonia"].", ".$row["ccalle"]." ".$row["cnumero"];?></td>          
                        <td><?php echo $row["ccp"]?></td>
                        <td><?php echo $row["cseccion"]?></td>
                        <td><?php echo "Fijo: ".$row["ctelefono"].", Celular:".$row["ccelular"]?></td>
                        <td><?php echo $row["cemail"]?></td>
                        <td><?php echo $row["ccargo"]?></td>
                        <td><?php echo $row["cobservaciones"]?></td>   
                        <td><img src="imagenes/mapa.png" onclick="verDomicilio(<?php echo $contador;?>);"></td>          
                  </tr>                                        
                  <?php
                       $contador++;
                    } 
                    break;
                  case 3:
                      while($row = mysql_fetch_array($consulta)) {  
                        ?>
                        <td><?php echo $row["claveindt"]; ?></td>        
                        <td id="nombre<?php echo $contador;?>"><?php echo $row["iapp"]." ".$row["iapm"]." ".$row["inombre"]; ?></td>            
                        <td id="<?php echo $contador;?>"><?php echo $row["imunicipio"].", ".$row["icolonia"].", ".$row["icalle"]." ".$row["inumero"];?></td>          
                        <td><?php echo $row["icp"]?></td>
                        <td><?php echo $row["iseccion"]?></td>
                        <td><?php echo "Fijo: ".$row["itelefono"].", Celular:".$row["icelular"]?></td>
                        <td><?php echo $row["iemail"]?></td>
                        <td><?php echo $row["icargo"]?></td>
                        <td><?php echo $row["iobservaciones"]?></td>   
                        <td><img src="imagenes/mapa.png" onclick="verDomicilio(<?php echo $contador;?>);"></td>          
                  </tr>                                        
                  <?php
                       $contador++;
                    } 
                    break;
                }
                  ?>
          </tbody>          
        </table>
      </div>
    </div>
  </body>
</html>