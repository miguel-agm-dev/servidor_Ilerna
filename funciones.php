<?php 
	
	//Vinculación con archivo php de consultas
	include "consultas.php";

	//Función para representar las categorías en el seleccionable
	function pintaCategorias($defecto) {
		
		$opcionesCateg = getCategorias();

		//Contenido con nombre de categorías a su valor asociado
		foreach ($opcionesCateg as $fila) {
			
			$selected = ($fila["CategoryID"] == $defecto) ? "selected" : "";
			
			echo "<option value='{$fila["CategoryID"]}' {$selected}>{$fila["Name"]}</option>";
		}
	}
	
	//Función para representar la lista de usuarios
	function pintaTablaUsuarios(){
		
		$listaUsuarios=getListaUsuarios();
		
		echo "<table>\n
				<tr>\n
					<th>&emsp;Nombre</th>\n
					<th>&emsp;Email</th>\n
					<th>&emsp;Autorizado</th>\n
				</tr>\n";
				
		while ($fila=mysqli_fetch_assoc($listaUsuarios)){
			echo "<tr>\n
					<td>&emsp;".$fila['FullName']."</td>\n
					<td>&emsp;".$fila['Email']."</td>\n";
			
			//Relleno campo de autorizados en rojo
			$esAutorizado = ($fila['Enabled'] == 1) ? "<td class='rojo'>&emsp;{$fila['Enabled']}</td>" : "<td>&emsp;{$fila['Enabled']}</td>";
			
			echo $esAutorizado;
		
		}echo "</tr></table>";
	}

	//Función para representar tabla de artículos
	function pintaProductos($orden) {
		
		$articulos=getProductos($orden);
		
		echo "<table>\n
				<tr>\n
					<th>&emsp;<a href='articulos.php?ordenarColum=ProductID'>ID</a></th>\n
					<th><a href='articulos.php?ordenarColum=Name'>Nombre</a></th>\n
					<th>&emsp;<a href='articulos.php?ordenarColum=Cost'>Coste</a></th>\n
					<th>&emsp;<a href='articulos.php?ordenarColum=Price'>Precio</a></th>\n
					<th>&emsp;<a href='articulos.php?ordenarColum=CategoryID'>Categoría</a></th>\n
					<th>&emsp;Acciones</th>
				</tr>\n";
		
		while ($fila=mysqli_fetch_assoc($articulos)){
			
			echo "<tr>\n
					<td>&emsp;".$fila['ProductID']."</td>\n
					<td>&emsp;".$fila['Name']."</td>\n
					<td>&emsp;".$fila['Cost']."</td>\n
					<td>&emsp;".$fila['Price']."</td>\n
					<td>&emsp;".$fila['CategoryID']."</td>\n";
			
			//Enlaces de gestión de articulos si tiene permisos
			echo (getPermisos() == 1) ? "<td>&emsp;<a href='formArticulos.php?editarProducto={$fila['ProductID']}'>Editar</a> | <a href='formArticulos.php?borrarProducto={$fila['ProductID']}'>Borrar</a></tr>\n" : "";
		}
		
		echo "</table>";
				
	}

?>