<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
		include '../../conexion.php';
		if (isset($_GET["id"])) {
			echo $_GET["id"];
			$sql="DELETE FROM fincas WHERE id=?";
			$statement=$conn->prepare($sql);
			$statement->bind_param("s",$_GET["id"]);
			$statement->execute();
			header("location: editfinca.php");
		}else{
			header("location: editfinca.php");
		}
	}else{
		header("location: ../../");
	}

 ?>