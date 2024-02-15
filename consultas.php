<?php 
	
	//Vinculación con archivo php de conexion
	include "conexion.php";

	//Funcion para saber tipo de usuario y permisos
	function tipoUsuario($nombre, $correo){
		if (esSuperadmin($nombre, $correo)) {
			return "superadmin";
		}

		$connect = crearConexion();
		
		$consulta = "SELECT FullName, Email, Enabled FROM user WHERE FullName='$nombre' AND Email='$correo'";
		
		$res = mysqli_query($connect, $consulta);
		

		if ($datos = mysqli_fetch_array($res)) {
			cerrarConexion($connect);
			return ($datos["Enabled"] == 0) ? "registrado" : "autorizado";
		}
		
		cerrarConexion($connect);
		return "no registrado";
	}

	//Función para comprobar si es superadmin
	function esSuperadmin($nombre, $correo){
		$connect = crearConexion();
		
		$consulta = "SELECT user.UserID FROM user INNER JOIN setup ON user.UserID=setup.SuperAdmin WHERE user.FullName='$nombre' AND user.Email='$correo'";
		
		$res = mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);

		return (mysqli_fetch_array($res)) ? true : false;
		
	}

	//Función para devolver permisos de Autenticación
	function getPermisos() {
		$connect=crearConexion();
		
		$consulta="SELECT Autenticación FROM setup";
		
		$res=mysqli_fetch_assoc(mysqli_query($connect, $consulta));
		
		cerrarConexion($connect);
		
		return $res["Autenticación"];
	}

	//Función para cambiar pemiso de Autenticación
	function cambiarPermisos() {
		$connect=crearConexion();
		
		$permisosActual=getPermisos();
		
		$cambioPermisos=($permisosActual==1)? 0:1;
		
		$consulta="UPDATE setup SET Autenticación=$cambioPermisos";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
	}

	//Función que devuelve tabla de categorías
	function getCategorias() {
		$connect=crearConexion();
		
		$consulta="SELECT CategoryID, Name FROM category";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
		
		return $res;
	}

	//Función para retornar lista de usuarios
	function getListaUsuarios() {
		$connect=crearConexion();
		
		$consulta="SELECT FullName, Email, Enabled FROM user";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
		
		return $res;
	}

	//Función para obtener datos del producto
	function getProducto($ID) {
		$connect=crearConexion();
		
		$consulta="SELECT*FROM product WHERE ProductID=$ID";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
		
		return $res;
	}

	//Función para ordenar productos
	function getProductos($orden) {
		$connect=crearConexion();
		
		$consulta="SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name
		as CategoryID FROM product INNER JOIN category WHERE product.CategoryID=category.CategoryID ORDER BY
		$orden";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
		
		return $res;
	}

	//Función para añadir un producto, teniendo en cuenta el ultimo ID
	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$connect=crearConexion();
		
		//Consulta ultimo id en tabla
		$consultaUltimoID = "SELECT MAX(ProductID) as ultimoID FROM product";
		
		$resultadoUltimoID = mysqli_query($connect, $consultaUltimoID);
		
		//Añade producto con id siguiente al último
		 if ($filaUltimoID = mysqli_fetch_assoc($resultadoUltimoID)) {
			 
			$nuevoID = $filaUltimoID['ultimoID'] + 1;
			
			$consulta="INSERT INTO product (ProductID, Name, Cost, Price, CategoryID) 
						VALUES ($nuevoID, '$nombre', $coste, $precio, $categoria)";
						
			$res=mysqli_query($connect, $consulta);
		
			cerrarConexion($connect);
		
			return $res;
		 }
		 
		 cerrarConexion($connect);
		 
		 return false;
	}

	//Función para borrar un producto
	function borrarProducto($id) {
		$connect=crearConexion();
		
		$consulta="DELETE FROM product WHERE ProductID=$id";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
		
		return $res;
	}

	//Función para actualizar un producto
	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$connect=crearConexion();
		
		$consulta="UPDATE product SET Name='$nombre', Cost=$coste, Price=$precio, CategoryID=$categoria WHERE ProductID=$id";
		
		$res=mysqli_query($connect, $consulta);
		
		cerrarConexion($connect);
		
		return $res;
	}

?>