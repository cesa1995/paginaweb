<?php
    session_start();
    require_once('../../NoCSRF/nocsrf.php');
    if (isset($_POST["_token"]) and $_SESSION['nivel']==0) {
        if (NoCSRF::check('_token',$_POST,false,60*10,false)) {
            include '../../conexion.php';
            $nombre=$_POST["nombre"];
            $descripcion=$_POST["descripcion"];
            $type=$_POST["tipo"];
            $sql="INSERT INTO equipos (nombre,devicetype,descripcion) VALUES (?,?,?)";
            $statement=$conn->prepare($sql);
            $statement->bind_param("sss",$nombre,$type,$descripcion);
            $statement->execute();
            header("location: addequipo.php?error=0");
        }else{
            header("location: addequipo.php?error=2");
        }
    }else {
        header("location: ../../");
    }
?>