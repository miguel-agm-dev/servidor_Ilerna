<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>

	<?php
		
		//Vinculación con archivo php de consultas
		include "consultas.php";

	?>
	
	<!--Formulario de acceso de usuarios-->
	<form action="index.php" method="POST">
		<br>
		&emsp;<label for="nombreUsuario"><b>Nombre de usuario:</b> </label>
		&emsp;<input type="text" name="nombreUsuario">
		<br><br>
		
		&emsp;<label for="dirCorreo"><b>Dirección de correo:</b> </label>
		&emsp;<input type="email" name="dirCorreo">
		<br><br>
		
		&emsp;<input type="submit" name="enviar">
		<br><br><br>
	</form>
	
	<?php
	
		//Asignación de variables de tipo de usuario tras enviar formulario
		if (isset($_POST['enviar'])){
			$nombre=$_POST['nombreUsuario'];
			$correo=$_POST['dirCorreo'];
			$tipoUsuario=tipoUsuario($nombre,$correo);
			
			//Almacenamiento de cookie equivalente a 15 minutos
			setcookie("session", $tipoUsuario, time()+900);
			
			//Condicionales de impresión de mensajes para cada tipo de usuario
			if ($tipoUsuario === 'superadmin') {
				echo "&emsp;Has accedido como <b>superadmin</b>: <i>$nombre</i>. <br><br>
					&emsp;Para acceder a la lista de usuarios pulsa en el enlace: <a href='usuarios.php'>Lista de usuarios</a>";
			} elseif ($tipoUsuario === 'autorizado') {
				echo "&emsp;Has accedido como <b>usuario autorizado</b>: <i>$nombre</i>. <br><br>
					&emsp;Para acceder a la lista de artículos pulsa en el enlace: <a href='articulos.php'>Lista de artículos</a>";
			} elseif ($tipoUsuario === 'registrado') {
				echo "&emsp;Has accedido como <b>usuario registrado</b>: <i>$nombre</i>. <br><br>
					&emsp;Actualmente <u>no estás autorizado</u> para acceder a la lista de artículos.";
			} else {
				echo "&emsp;<b>Usuario sin acceso</b>: <u>no registrado o datos incorrectos</u>.";
			}

		}
	?>
	
</body>
</html>