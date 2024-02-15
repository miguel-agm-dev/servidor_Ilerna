<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>
<body>

	<?php 
		
		//Vinculación con archivo php de funciones
		include "funciones.php";
		
		//Condicional de cambio de valor de permisos según verificación de cookie
		if (isset($_COOKIE['session']) && $_COOKIE['session'] === "superadmin") {
			if (isset($_GET['cambioValor'])) {
				cambiarPermisos();
			}

			//Mostrar valor actual de permisos con función getPermisos
			echo "<br>&emsp;<span>El valor de los permisos actuales es: <b>" . getPermisos() . "</b></span>";

			?>
			
			<!--Formulario para cambio de valor de permisos-->
			<form action="usuarios.php" method="GET">
				<br>&emsp;<input type="submit" name="cambioValor" value="Cambiar valor permisos">
			</form>
			<br><br>
			
			<!--Llamada a función pintaTablaUsuarios para mostrar tabla de usuarios-->
			<?php
			pintaTablaUsuarios();
			?>
			
			<!--Enlace de salida-->
			<br><br>
			&emsp;<span>Para volver al inicio pulsa en el enlace: <a href="index.php">Salir</a></span><br><br>
			<?php
			
		} else {
			echo "<br>&emsp;Actualmente no tienes permiso para acceder. Por favor, vuelve a inicio e inténtalo de nuevo.
			<br><br>&emsp;<span>Para volver al inicio pulsa en el enlace: <a href=\"index.php\">Salir</a></span><br><br>";
		}
		?>
			
</body>
</html>