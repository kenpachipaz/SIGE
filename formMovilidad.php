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
  include("acceso.php");
?>
<html>
    <head>
        <title>Movilidad</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/mostrarSeccion.js"></script>
        <script type="text/javascript"   src="https://maps.google.com/maps/api/js?sensor=false"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script>
            function busca() {    
                var municipio= "Cuernavaca";
                var colonia="<?php echo $_SESSION['colonia'];?>";
                var calle="<?php echo $_SESSION['calle'];?>";
                var numero="<?php echo $_SESSION['numero'];?>";

                if(municipio != null && colonia !=null && calle !=null){
                    var address=municipio+", "+colonia+", "+calle+" "+numero;
                   
                    var geoCoder = new google.maps.Geocoder(address)
                    
                    var request = {address: address};

                    geoCoder.geocode(request, function (result, status) {

                        var latlng = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());

                        var myOptions = {
                            zoom: 15,
                            center: latlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                        var marker = new google.maps.Marker({position: latlng, map: map, title: 'title'});

                    })
                }
            }

        </script>

    </head>
    <body>
        <div id="principal">
            <div id="fomulario">
                <form name="formulario" action="registro.php" method="POST" onSubmit="return validaSelect(this, 1);">
                    <table>
                        <tr>
                            <td colspan="2">
                                <?php 
                                    if($_GET["registrado"]=="true")
                                        echo "<br/><b>Registro con éxito</b>";
                                    else if($_GET["registrado"]==null)
                                        echo "<br/><b>Esperando registro</b>";
                                    else
                                        echo "<br/><p>Ya existe una persona registrada con la misma <b>clave electoral</b></p>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>ELECTORAL---></td>
                            <td>
                                <select name="personaElectoral"> 
                                <option value="nada">---Seleccione persona Electoral---</option>
                                <?php 
                                    $query="SELECT claveelectoral, app, apm, nombre FROM dtperselect";
                                    $resultado=mysql_query($query);
                                    while($row=mysql_fetch_array($resultado)){
                                        echo '<option value="'.$row['claveelectoral'].'">'.$row['nombre']." ".$row['app']." ".$row['apm'].'</option>';
                                    }
                                ?>                                  
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>CLAVE ELECTORAL:</td>
                            <td><input type="text" data-type="input-textbox" id="clave" name="clave" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>APELLIDO PATERNO:</td>
                            <td><input type="text" data-type="input-textbox" id="aPaterno" name="ap" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>APELLIDO MATERNO:</td>
                            <td><input type="text" data-type="input-textbox" id="aMaterno" name="am" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>NOMBRE (S):</td>
                            <td><input type="text" data-type="input-textbox" id="nombre" name="nombre" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>TÉLEFONO FIJO:</td>
                            <td><input type="text" data-type="input-textbox" id="tel" name="tel" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>TÉLEFONO CELULAR:</td>
                            <td><input type="text" data-type="input-textbox" id="cel" name="cel" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>EMAIL:</td>
                            <td><input type="email" data-type="input-textbox" id="email" name="email" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>CALLE:</td>
                            <td><input type="text" data-type="input-textbox" id="calle" name="calle"  size="18" required /></td>
                        </tr>
                         <tr>
                            <td>NÚMERO:</td>
                            <td><input type="number" min="0" data-type="input-textbox" id="numero" name="numero"  size="18" required /></td>
                        </tr>
                        <tr>
                            <td>COLONIA:</td>
                            <td><input type="text" data-type="input-textbox" id="colonia" name="colonia" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>MUNICIPIO:</td>
                            <td><input type="text" data-type="input-textbox" value="Cuernavaca" id="municipio" name="municipio" size="18" required disabled />
                        </tr>
                        <tr>
                            <td>CÓDIGO POSTAL:</td>
                            <td><input type="text" data-type="input-textbox" id="cp" name="cp" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>SECCIÓN ELECTORAL:</td>
                            <td><input type="text" data-type="input-textbox" id="sElectoral" name="sElectoral" size="18" required /></td>
                        </tr>
                        <tr style="display:none;">
                            <td><input type="text" data-type="input-textbox" id="area" name="area" size="18" value="1"/></td>
                        </tr>
                        <tr>
                            <td>CARGO:</td>
                            <td>
                                <select name="cargoMovilidad" onChange="verCoordinadores(this.form,0);">
                                    <option value="nada">---Seleccione cargo---</option>
                                    <option value="Coordinador">Coordinador</option>
                                    <option value="Integrante">Integrante</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>COORDINADOR: </td>
                            <td>
                                <select id="coordiSelect" name="coordinadorMov" disabled>
                                    <option value="nada">---Seleccione coordinador---</option>
                                    <?php 
                                        $query="SELECT cvecoord, capp, capm, cnombre FROM dtperscoor WHERE cvecoord=(SELECT cvecoord FROM coordinadores WHERE carea='Movilidad')";
                                        $resultado=mysql_query($query);
                                        while($row=mysql_fetch_array($resultado)){
                                            echo '<option value="'.$row['cvecoord'].'">'.$row['cnombre']." ".$row['capp']." ".$row['capm'].'</option>';
                                        }
                                    ?>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>OBSERVACIONES:</td>
                            <td><textarea rows="8" cols="40" name="obs" required ></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <input id="boton" type="submit" value="Registrar"/>
                                </center>
                            </td>
                        </tr>
                    </table>
                </from>
            </div>
            <div id="mapa">
                <?php
                     echo "<script> busca(); </script>";
                ?>
                <div id="map_canvas" style="width:500px;height:380px;"></div>
            </div>
        </div>
    </body>
</html>
