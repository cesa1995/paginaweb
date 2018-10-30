<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		if (NoCSRF::check('_token', $_POST, false, 60*10, false)) {
			include '../../conexion.php';
			$nombre=$_POST["nombre"];
			$direccion=$_POST["adress"];
			$sql="INSERT INTO fincas (nombre,direccion) VALUES (?,?)";
			$statement=$conn->prepare($sql);
			$statement->bind_param("ss",$nombre,$direccion);
			$statement->execute();
			header("location: addfinca.php?error=0");
		}else{
			die(header("location: addfinca.php?error=2"));
		}
	}else{
		header("location: ../../");
	}

 ?>
