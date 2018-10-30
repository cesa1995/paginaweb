<?php 
	session_start();
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include '../conexion.php';
        $sql="SELECT id, nivel FROM usuarios";
        $statement=$conn->prepare($sql);
        $statement->execute();
        $result=$statement->get_result();
        foreach ($result as $row){
           $iusuarios=$iusuarios+1;
           if ($row['nivel']==0) {
               $iadmin=$iadmin+1;
           }
           if ($row['nivel']==1) {
               $iagro=$iagro+1;
           }
           if ($row['nivel']==2) {
               $icli=$icli+1;
           }
        }
        $sql="SELECT id FROM fincas";
        $statement=$conn->prepare($sql);
        $statement->execute();
        $result=$statement->get_result();
        foreach ($result as $row) {
            $ifincas = $ifincas+1;
        }
        $sql="SELECT id FROM equipos";
        $statement=$conn->prepare($sql);
        $statement->execute();
        $result=$statement->get_result();
        foreach ($result as $row) {
            $iequipos=$iequipos+1;
        }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrador</title>
	<link rel="stylesheet" href="../css/administrador.css">
	<link rel="stylesheet" href="../iconos/font/flaticon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	   <header>
        <label for="check" class="flaticon-menu iconmenu"></label>
        <input type="checkbox" id="check" name="check">
        <img src="../img/logo.png">
        <nav>
            <ul>
                <li class="item"><a href="#"><span class="flaticon-inicio select"></span>Inicio</a></li>
                <li class="item"><a href="#"><span class="flaticon-usuario"></span>Usuario</a>
                    <ul class="submenu" id="usuario">
                        <li class="subitem"><a href="usuario/adduser.php"><span class="flaticon-addusuario"></span>Agregar</a></li>
                        <li class="subitem"><a href="usuario/edituser.php"><span class="flaticon-ediusuario"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="#"><span class="flaticon-finca"></span>Finca</a>
                    <ul class="submenu" id="finca">
                        <li class="subitem"><a href="finca/addfinca.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                        <li class="subitem"><a href="finca/editfinca.php"><span class="flaticon-editar"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="#"><span class="flaticon-sensor"></span>Equipos</a>
                    <ul class="submenu" id="equipos">
                        <li class="subitem"><a href="../equipo/addequipo.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                        <li class="subitem"><a href="../equipo/editequipo.php"><span class="flaticon-editar"></span>Editar</a></li>
                    </ul>
                </li>
                <li class="item"><a href="../out.php"><span class="flaticon-salir"></span>Salir</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="bienvenida">
            <img src="http://placeimg.com/1000/300/any">
            <h1>Bienvenido/a <?php echo $_SESSION['usuario']; ?></h1>
        </div>
        <div class="datacontent">
            <article class="data">
                <div class="general"><h4>Usuarios</h4><p><?php echo $iusuarios; ?></p></div>
                <div class="puntual"><h4>Administradores</h4><p><?php echo $iadmin; ?></p></div>
                <div class="puntual"><h4>Agronomos</h4><p><?php echo $iagro; ?></p></div>
                <div class="puntual"><h4>Clientes</h4><p><?php echo $icli; ?></p></div>
            </article>
            <article class="data otras"><h4>Fincas</h4><p><?php echo $ifincas; ?></p></article >
            <article class="data otras"><h4>Equipos</h4><p><?php echo $iequipos; ?></p></article>
        </div>
    </main>
    <footer>
        <p>Smart Agroindustry &copy; 2018 by <span>Cesar Contreras</span></p>
    </footer>
</body>
</html>
<?php 
}else{
header("location: ../");
}
 ?>
