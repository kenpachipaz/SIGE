<?php
	$Usuario=$_POST['usuario'];
    $Contrasena=$_POST['contrasena'];
	include('acceso.php');
	settype($Usuario, 'string');
	settype($Contrasena, 'string');
	$querySP=mysql_query("CALL ingresaUsuario('$Usuario', '$Contrasena')");
	$resultado = mysql_fetch_array($querySP);
	
	echo "Resultado--> ".$resultado['tipo'];
	if($resultado['tipo']){
		session_start();
		header('Location:resgistro.php');
		$_SESSION['sesionOK']="si";
	}else if($resultado['tipo']==null){
	
		header('Location:index.php?fallo_autentificacion=1');
	}else{
			session_start();
		header('Location:admin.php');
		$_SESSION['sesionOK']="si";
	}
?>