<?php
session_start();
require_once('../../NoCSRF/nocsrf.php');
if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
	include '../../conexion.php';
	$email = $_POST['correo'];
	if (is_valid_email($email)) {
	if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
		$sql="SELECT email FROM usuarios WHERE email=?";
		$statement=$conn->prepare($sql);
		$statement->bind_param("s",$_POST['correo']);
		$statement->execute();
		$result=$statement->get_result();
		foreach ($result as $raw);
			if(empty($raw['email'])){
				$nombre = $_POST['nombre'];
				$apellido = $_POST['apellido'];
				$password = password_hash($_POST['contrasena'],PASSWORD_DEFAULT, ['cost' => 12]);
				$nivel = $_POST['nivel'];
				$query = "INSERT INTO usuarios (nombre, apellido, email, contrasena, nivel) VALUES (?,?,?,?,?)";
				$statement = $conn->prepare($query);
				$statement->bind_param("sssss",$nombre,$apellido,$email,$password,$nivel);
				$statement->execute();
				header("location: adduser.php?error=0");
			}else{
				header("location: adduser.php?error=1");
			}
		}else{
			die(header("location: adduser.php?error=2"));
		}
	}else{
		header("location: adduser.php?error=3");
	}
}else {
	header("location: ../../");
}
?>