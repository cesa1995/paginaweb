<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
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
                <li class="item"><a href="../../index.php"><span class="flaticon-inicio"></span>Inicio</a></li>
                <li class="item"><a href="#"><span class="flaticon-usuario"></span>Usuario</a>
                    <ul class="submenu" id="usuario">
                        <li class="subitem"><a href="../usuario/adduser.php"><span class="flaticon-addusuario"></span>Agregar</a></li>
                        <li class="subitem"><a href="../usuario/edituser.php"><span class="flaticon-ediusuario"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="#"><span class="flaticon-finca select"></span>Finca</a>
                    <ul class="submenu" id="finca">
                        <li class="subitem"><a href="#"><span class="flaticon-agregar"></span>Agregar</a></li>
                        <li class="subitem"><a href="editfinca.php"><span class="flaticon-editar"></span>Editar</a></li>
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
		<h1 class="titulo">Agregar Finca</h1>
		<?php if (isset($_GET["error"])) {
				if ($_GET["error"]==0) {
                    echo "<h4 class=\"error\">Finca creada con exito</h4>";
                }elseif($_GET["error"]==1){
                    echo "<h4 class=\"error\">Numero de telefono no valido</h4>";
				}elseif($_GET["error"]==2){
					echo "<h4 class=\"error\">Token Incorrecto</h4>";
				}
		} ?>
		<div class="formulario">
			<form action="addfincaV.php" method="post">
                <input type="text" name="nombre" placeholder="Nombre" autofocus required>
                <input type="tel" name="telefono" placeholder="telefono" required>
				<textarea type="text" name="adress" placeholder="Direccion" required></textarea>
				<input type="hidden" name="_token" value="<?php echo NoCSRF::generate('_token'); ?>">
				<input type="submit" value="Agregar">
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
?>