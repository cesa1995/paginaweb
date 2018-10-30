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
                <li class="item"><a href="../administrador.php"><span class="flaticon-inicio"></span>Inicio</a></li>
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
        <table>
            <caption><h1>Usuarios Registrados</h1></caption>
            <thead>
                <tr>
                    <th><h1>id</h1></th>
                    <th><h1>Nombre</h1></th>
                    <th><h1>Apellido</h1></th>
                    <th><h1>Email</h1></th>
                    <th><h1>Nivel</h1></th>
                </tr>
            </thead>
            <tbody>
            <?php 
            include '../../conexion.php';
                $sql="SELECT * FROM usuarios ORDER BY nombre ASC";
                $statement=$conn->prepare($sql);
                $statement->execute();
                $result=$statement->get_result();
                foreach ($result as $row){
            ?>
            
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php if ($row['nivel']==0) {
                        echo "Administrador";
                    }else if($row['nivel']==1){
                        echo "Agronomo";
                    }else{
                        echo "Cliente";
                    } ?></td>
                    <td><a href="modifuser.php?id=<?php echo $row['id']; ?>">Editar</a></td>
                    <td><a href="deleuser.php?id=<?php echo $row['id']; ?>">Eliminar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>        
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