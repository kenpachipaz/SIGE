<html>
 <head>
   <title>Acceso a la BD</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 </head>
 <body>
  <?php
  $dp = mysql_connect('localhost', 'root', 'paz13')or die ('No se pudo conectar: '.mysql_error());
	mysql_select_db('sige',$dp)or die('No se pudo seleccionar la base de datos ');
  ?>
 </body>
</html>
