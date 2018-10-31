<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		if (NoCSRF::check('_token', $_POST, false, 60*10, false)) {
			$telefono=$_POST["telefono"];
			$expresion='/^(\+?[0-9]{9,13})$/';
			echo $telefono;
			if (preg_match($expresion,$telefono)) {
				echo "aqui";
				include '../../conexion.php';
				$nombre=$_POST["nombre"];
				$direccion=$_POST["adress"];
				$sql="INSERT INTO fincas (nombre,telefono,direccion) VALUES (?,?,?)";
				$statement=$conn->prepare($sql);
				$statement->bind_param("sss",$nombre,$telefono,$direccion);
				$statement->execute();
				header("location: addfinca.php?error=0");
			}else{
				header("location: addfinca.php?error=1");
			}
		}else{
			die(header("location: addfinca.php?error=2"));
		}
	}else{
		header("location: ../../");
	}

 ?>
