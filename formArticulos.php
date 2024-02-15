<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<?php 
		
		//Vinculación con archivo php de funciones
		include "funciones.php";
	
	?>
	
	<?php
		
		//Inicializa variables de mensaje y estilo boton de formulario
		$mensaje = "";
		$styleAttribute='';
	
		//Verifica la cookie para tener permisos de acceso
		if (isset($_COOKIE['session']) && ($_COOKIE['session'] == "autorizado")) {
			
			//Condicionales para extraer datos del producto o vaciar formulario
			if (isset($_GET["editarProducto"]) || isset($_GET["borrarProducto"])) {
				$datosProducto = mysqli_fetch_array(getProducto(isset($_GET["editarProducto"]) ? $_GET["editarProducto"] : $_GET["borrarProducto"]));
			} else {
				$datosProducto = [
					"ProductID" => "",
					"Name" => "",
					"Cost" => "",
					"Price" => "",
					"CategoryID" => ""
				];
			}
		} else {
			
			//Sin permiso, enlace de salida
			echo "<br>&emsp;Actualmente no tienes permiso para acceder. Por favor, vuelve a inicio e inténtalo de nuevo.";
			echo "<br><br>&emsp;<span>Para volver al inicio pulsa en el enlace: <a href=\"index.php\">Salir</a></span><br><br>";
		}
	?>

	<?php if (isset($_COOKIE['session']) && ($_COOKIE['session'] == "autorizado")): ?>
	
		<!--Formulario de gestión de productos-->
		<form action="formArticulos.php" method="POST">
			<br>
			&emsp;<label><b>ID:</b> </label>
			&emsp;<input type="text" value="<?= $datosProducto["ProductID"]; ?>" readonly>
			&emsp;<input type="hidden" name="id" value="<?= $datosProducto["ProductID"]; ?>">
			<br><br>
			
			&emsp;<label><b>Nombre:</b> </label>
			&emsp;<input type="text" name="nombre" value="<?= $datosProducto["Name"]; ?>">
			<br><br>
			
			&emsp;<label><b>Coste:</b> </label>
			&emsp;<input type="number" name="coste" value="<?= $datosProducto["Cost"]; ?>">
			<br><br>
			
			&emsp;<label><b>Precio:</b> </label>
			&emsp;<input type="number" name="precio" value="<?= $datosProducto["Price"]; ?>">
			<br><br>
			
			&emsp;<label><b>Categoría:</b> </label>
			&emsp;<select name="categoria">
				<?php pintaCategorias($datosProducto["CategoryID"]); ?>
			</select>
			<br><br>
			
			<?php
			
				//Procesa formulario para obtener mensajes
				if (isset($_POST["gestorProductos"], $_POST["id"], $_POST["nombre"], $_POST["coste"], $_POST["precio"], $_POST["categoria"])) {
					extract($_POST);

					if ($gestorProductos == 'Editar') {
						$mensaje = (editarProducto($id, $nombre, $coste, $precio, $categoria)) ? "&emsp;<i>--Artículo editado--</i>" : "&emsp;<i>--El artículo no se ha podido editar--</i>";
					} elseif ($gestorProductos == 'Borrar') {
						$mensaje = (borrarProducto($id)) ? "&emsp;<i>--Artículo borrado--</i>" : "&emsp;<i>--El artículo no se ha podido borrar--</i>";
					} elseif ($gestorProductos == 'Añadir Producto') {
						$mensaje = (anadirProducto($nombre, $coste, $precio, $categoria)) ? "&emsp;<i>--Artículo añadido--</i>" : "&emsp;<i>--El artículo no se ha podido añadir--</i>";
					}

					echo $mensaje;
					
					//Oculta el boton
					$styleAttribute = isset($_POST["gestorProductos"]) ? 'style="display: none;"' : '';
				}	
			?>
			<br><br>
			
			<!--Boton para enviar formulario-->
			&emsp;<input type="submit" name="gestorProductos" value="<?= (isset($_GET["editarProducto"]) ? 'Editar' : (isset($_GET["borrarProducto"]) ? 'Borrar' : 'Añadir Producto')); ?>"<?= $styleAttribute; ?>>
			<br>
			
			<!--Enlace para volver a la tabla de artículos-->
			<br><br>&emsp;<span>Para volver a la lista de artículos pulsa en el enlace: <a href="articulos.php">Lista de artículos</a></span><br><br>
		</form>
	<?php endif; ?>
</body>
</html>