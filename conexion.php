<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac3_daw";
		
		//Crea conexión con base de datos
		$conexion=mysqli_connect($host, $user, $pass, $baseDatos);
		
		return $conexion;
	}

	//Función que cierra conexión con base de datos
	function cerrarConexion($conexion) {
		mysqli_close($conexion);
	}


?>