<?php 
session_start();
require_once('../../NoCSRF/nocsrf.php');
if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
	include '../../conexion.php';
	if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$nivel = $_POST['nivel'];
			$id = $_POST['id'];
			$query = "UPDATE usuarios SET nombre=?, apellido=?, nivel=? WHERE id=?";
			$statement = $conn->prepare($query);
			$statement->bind_param("ssss",$nombre,$apellido,$nivel,$id);
			$statement->execute();
			header("location: modifuser.php?id=$id&error=0");
	}else{
		die(header("location: modifuser.php?id=$id&error=2"));
	}
}else {
	header("location: ../../");
}
?>