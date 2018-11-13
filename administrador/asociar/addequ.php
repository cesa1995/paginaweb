<?php
    session_start();
    if(isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include "../../conexion.php";
        $idfinca=$_GET['idfin'];
        $idequipo=$_GET['idequ'];
        $estado=0;
        $sql="INSERT INTO fincaequ (fincaid,equipoid,estado) VALUES (?,?,?)";
        $statement=$conn->prepare($sql);
        $statement->bind_param("ssi",$idfinca,$idequipo,$estado);
        $statement->execute();
        header("location: asociar.php?id=".$idfinca."&div=1");
    }else{
        header("location: ../../");
    }

?>