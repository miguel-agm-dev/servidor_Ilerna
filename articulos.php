<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<?php 
		
		//Vinculación con archivo php de funciones
		include "funciones.php";

	?>

	<h1>&emsp;Lista de artículos</h1>
	
	<?php
	
		//Verificación de cookie para acceder a tabla de productos
		if (isset($_COOKIE['session']) && ($_COOKIE['session'] == "autorizado")){
			
			//Orden de productos por columnas seleccionadas
			$orden=$_GET["ordenarColum"]??"ProductID";
			pintaProductos($orden);
			
			//Condicional para añadir producto por autorización activa
			if (getPermisos()==1){
				echo "<br>&emsp;<a href='formArticulos.php?anadirProduct'>Añadir nuevo producto</a>";
			}
			
			//Enlace de salida
			echo "<br><br>&emsp;<span>Para volver al inicio pulsa en el enlace: <a href=\"index.php\">Salir</a></span><br><br>";
			
		} else{
			
			//Sin permiso, enlace de salida
			echo "<br>&emsp;Actualmente no tienes permiso para acceder. Por favor, vuelve a inicio e inténtalo de nuevo.
			<br><br>&emsp;<span>Para volver al inicio pulsa en el enlace: <a href=\"index.php\">Salir</a></span><br><br>";
		}
	?>

</body>
</html>