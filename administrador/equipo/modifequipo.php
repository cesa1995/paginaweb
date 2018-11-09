<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
		if (isset($_GET["id"])) {
			include '../../conexion.php';
			$sql="SELECT * FROM equipos WHERE id=?";
			$statement=$conn->prepare($sql);
			$statement->bind_param("s",$_GET["id"]);
			$statement->execute();
			$result=$statement->get_result();
			foreach ($result as $row);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="../../img/logo.ico" type="image/x-icon">
	<title>Agregar</title>
	<link rel="stylesheet" href="../../css/administrador.css">
	<link rel="stylesheet" href="../../iconos/font/flaticon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<header>
        <label for="check" class="flaticon-menu iconmenu"></label>
        <input type="checkbox" id="check" name="check">
        <div class="logo">
            <img src="../../img/logo.png">
            <a>Smart Agroindustry</a>
        </div>
        <nav>
            <div class="item"><a href="../../"><span class="flaticon-inicio"></span>Inicio</a></div>
            <div class="item"><a href="#"><span class="flaticon-usuario"></span>Usuario</a>
            <div class="submenu">
                <a href="../usuario/adduser.php"><span class="flaticon-addusuario"></span>Agregar</a>
                <a href="../usuario/edituser.php"><span class="flaticon-ediusuario"></span>Editar</a></li>
            </div></div>
            <div class="item"><a href="#"><span class="flaticon-finca"></span>Finca</a>
            <div class="submenu">
                <a href="../finca/addfinca.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                <a href="../finca/editfinca.php"><span class="flaticon-editar"></span>Editar</a></li>
            </div></div>
            <div class="item"><a href="#"><span class="flaticon-sensor select"></span>Equipos</a>
            <div class="submenu">
                <a href="../equipo/addequipo.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                <a href="../equipo/editequipo.php"><span class="flaticon-editar"></span>Editar</a></li>
            </div></div>
            <div class="item"><a href="../asociar/asociar.php"><span class="flaticon-sincronizar"></span>Asociar</a></li></div>
            <div class="item"><a href="../../out.php"><span class="flaticon-salir"></span>Salir</a></li></div>
    	</nav>
	</header>
	<main>
		<h1 class="titulo">Modificar Equipo</h1>
		<?php if (isset($_GET["error"])) {
				if ($_GET["error"]==0) {
					echo "<h4 class=\"error\">Equipo modificada con exito</h4>";
				}elseif($_GET["error"]==2){
					echo "<h4 class=\"error\">Token Incorrecto</h4>";
				}
		} ?>
		<div class="formulario">
			<form action="modifequipoV.php" method="post">
				<input type="text" name="nombre" placeholder="Nombre" value="<?php echo $row["nombre"]; ?>" autofocus required>
				<input type="text" name="tipo" placeholder="Tipo de dispositivo" value="<?php echo $row["devicetype"]; ?>" required>
				<textarea type="text" name="descripcion" placeholder="Descripcion" required><?php echo $row["descripcion"]; ?></textarea>
				<input type="hidden" name="_token" value="<?php echo NoCSRF::generate('_token'); ?>">
				<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
				<input type="submit" value="Modificar">
			</form>
		</div>
	</main>
	<footer>
        <p>Smart Agroindustry &copy; 2018 by <span>Cesar Contreras</span></p>
    </footer>
</body>
</html>
<?php
}else{
	header("location: ../../");
}
}else{
	header("location: ../../");
}
?>