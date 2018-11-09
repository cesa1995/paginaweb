<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		include '../../conexion.php';
		if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
            $tipo = $_POST['tipo'];
            $descripcion = $_POST['descripcion'];
			$query = "UPDATE equipos SET nombre=?, devicetype=?, descripcion=? WHERE id=?";
			$statement = $conn->prepare($query);
			$statement->bind_param("ssss",$nombre, $tipo, $descripcion, $id);
			$statement->execute();
			header("location: modifequipo.php?id=$id&error=0");
		}else{
			die(header("location: modifequipo.php?id=$id&error=2"));
		}
	}else {
		header("location: ../../");
	}
?>