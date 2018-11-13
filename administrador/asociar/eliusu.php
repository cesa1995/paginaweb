<?php
session_start();
    if(isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include "../../conexion.php";
        $idfinca = $_GET['idfin'];
        $fincaequid = $_GET['fincausuid'];
        $sql="DELETE FROM fincausu WHERE id=?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("s",$fincaequid);
        $statement->execute();
        header("location: asociar.php?id=".$idfinca."&div=0");
    }else{
        header("location: ../../");
    }

?>