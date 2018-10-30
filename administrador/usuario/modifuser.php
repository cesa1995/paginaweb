<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
		if (isset($_GET['id'])){
			include '../../conexion.php';
			$sql="SELECT id, nombre, apellido FROM usuarios WHERE id=?";
			$statement=$conn->prepare($sql);
			$statement->bind_param("s",$_GET['id']);
			$statement->execute();
			$result=$statement->get_result();
			foreach ($result as $row);
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar</title>
	<link rel="stylesheet" href="../../css/administrador.css">
	<link rel="stylesheet" href="../../iconos/font/flaticon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
        <label for="check" class="flaticon-menu iconmenu"></label>
        <input type="checkbox" id="check" name="check">
        <img src="../../img/logo.png">
        <nav>
            <ul>
                <li class="item"><a href="../../"><span class="flaticon-inicio"></span>Inicio</a></li>
                <li class="item"><a href="#"><span class="flaticon-usuario select"></span>Usuario</a>
                    <ul class="submenu" id="usuario">
                        <li class="subitem"><a href="adduser.php"><span class="flaticon-addusuario"></span>Agregar</a></li>
                        <li class="subitem"><a href="edituser.php"><span class="flaticon-ediusuario"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="#"><span class="flaticon-finca"></span>Finca</a>
                    <ul class="submenu" id="finca">
                        <li class="subitem"><a href="../finca/addfinca.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                        <li class="subitem"><a href="../finca/editfinca.php"><span class="flaticon-editar"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="#"><span class="flaticon-sensor"></span>Equipos</a>
					<ul class="submenu" id="equipos">
                        <li class="subitem"><a href="../equipo/addequipo.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                        <li class="subitem"><a href="../equipo/editequipo.php"><span class="flaticon-editar"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="../../out.php"><span class="flaticon-salir"></span>Salir</a></li>
            </ul>
        </nav>
    </header>
	<main>
		<h1 class="titulo">Modificar Usuario</h1>
		<?php if (isset($_GET["error"])) {
			if ($_GET["error"]==0) {
				echo "<h4 class=\"error\">Modificado con exito</h4>";
			}elseif ($_GET["error"]==2) {
				echo "<h4 class=\"error\">Intentar de Nuevo</h4>";
			}
		} ?>
		<div class="formulario">
			<form action="modifuserV.php" method="post">
				<input type="text" name="nombre" placeholder="Nombre" required value="<?php echo $row['nombre']; ?>">
				<input type="text" name="apellido" placeholder="Apellido" required value="<?php echo $row['apellido']; ?>">
				<select name="nivel" >
					<option value="2">Cliente</option>
					<option value="0">Administrador</option>
					<option value="1">Agronomo</option>
				</select>
				<input type="hidden" name="_token" value="<?php echo NoCSRF::generate('_token'); ?>">
				<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
				<input type="submit" value="Guardar">
			</form>
		</div>
		<div class="reset"><a href="resetpass.php?id=<?php echo $_GET['id']; ?>">Reestablecer Contraseña</a></div>
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