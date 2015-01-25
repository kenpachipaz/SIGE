<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Inicio</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="shortcut icon" href="imagenes/logo.ico" type="image/x-icon" />
		<script src="js/sha1-min.js"></script>
		<script>
			function encriptaSHA1(){
				var input_pass = document.getElementById("password");
            	input_pass.value = hex_sha1(input_pass.value);
			}
		</script>
	</head>
	<body>
		<div id="contenedor">
			<header>
				<div id="marca"></div>
			</header>
			<section id="acceso">
				<h1>Acceso</h1>
				<form action="prueba.php" method="POST" class="formulario">
					<table cellspacing="10px">
						<tr>
							<td>Usuario:</td>
							<td><input type="text" name="usuario" placeholder="usuario" required /></td>
						</tr>
						<tr>
							<td>Contraseña:</td>
							<td><input type="password" id="password" name="contrasena" placeholder="contraseña" required /></td>
						</tr>
						<tr>
							<td colspan="2">
								<center><input type="submit" onclick="encriptaSHA1()" name="acceso" value="Acceder"/></center>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<?php 
									if($_GET['fallo_autentificacion'])
										echo "<p>Usuario y/o contraseña incorrecta :(</p>";
								?>	
							</td>
						</tr>
					</table>	
					<img src="imagenes/SIGE.png" id="img"/>							
				</form>
				<?php echo $_POST["usuario"]."----".$_POST["contrasena"]; ?>
			</section>	
			<footer>
				<center>
					<h3 id="pie" class="pieIndex">Copyright&copySIGE|sige.co</h3>
				</center>
			</footer>	
		</div>
	</body>
</html>