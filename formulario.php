<!DOCTYPE html>
<html>
    <head>
        <title>Electoral</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript"   src="https://maps.google.com/maps/api/js?sensor=false"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script>
            function busca() {    
                var municipio= "<?php session_start(); echo $_SESSION['municipio'];?>";
                var colonia="<?php echo $_SESSION['colonia'];?>";
                var calle="<?php echo $_SESSION['calle'];?>";

                if(municipio != null && colonia !=null && calle !=null){
                    var address=municipio+", "+colonia+", "+calle;
                   
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
                <form action="registro.php" method="POST">
                    <table>
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
                            <td>NOMBRES:</td>
                            <td><input type="text" data-type="input-textbox" id="nombre" name="nombre" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>TELEFONO:</td>
                            <td><input type="text" data-type="input-textbox" id="tel" name="tel" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>EMAIL:</td>
                            <td><input type="text" data-type="input-textbox" id="email" name="email" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>CODIGO POSTAL:</td>
                            <td><input type="text" data-type="input-textbox" id="cp" name="cp" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>CALLE:</td>
                            <td><input type="text" data-type="input-textbox" id="calle" name="calle"  size="18" required /></td>
                        </tr>
                        <tr>
                            <td>COLONIA:</td>
                            <td><input type="text" data-type="input-textbox" id="colonia" name="colonia" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>MUNICIPIO:</td>
                            <td><input type="text" data-type="input-textbox" id="municipio" name="municipio" size="18" required />
                        </tr>
                        <tr>
                            <td>SECCION ELECTORAL:</td>
                            <td><input type="text" data-type="input-textbox" id="sElectoral" name="sElectoral" size="18" required /></td>
                        </tr>
                        <tr>
                            <td>CARGO:</td>
                            <td><input type="text" data-type="input-textbox" id="cargo" name="cargo" size="18" required /></td>
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
                        <tr>
                            <td colspan="2">
                                <?php 
                                    if($_GET["registrado"])
                                        echo "<br/><b>Registro con éxito</b>";
                                    else
                                        echo "<br/><p>No registrado :(</p>";
                                ?>
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
