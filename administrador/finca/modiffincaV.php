<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		include '../../conexion.php';
		if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
				$nombre = $_POST['nombre'];
				$direccion = $_POST['adress'];
				$id = $_POST['id'];
				$query = "UPDATE fincas SET nombre=?, direccion=? WHERE id=?";
				$statement = $conn->prepare($query);
				$statement->bind_param("sss",$nombre,$direccion,$id);
				$statement->execute();
				header("location: modiffinca.php?id=$id&error=0");
		}else{
			die(header("location: modiffinca.php?id=$id&error=2"));
		}
	}else {
		header("location: ../../");
	}
?>
