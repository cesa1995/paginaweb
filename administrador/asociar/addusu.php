<?php
    session_start();
    if(isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include "../../conexion.php";
        $idfinca=$_GET['idfin'];
        $idusuario=$_GET['idusu'];
        $sql="SELECT usuarioid FROM fincausu WHERE usuarioid=?";
        $statement=$conn->prepare($sql);
        $statement->bind_param("i",$idusuario);
        $statement->execute();
        $result=$statement->get_result();
        foreach($result as $row);
        if (empty($row['usuarioid'])){
            $sql="INSERT INTO fincausu (fincaid,usuarioid) VALUES (?,?)";
            $statement=$conn->prepare($sql);
            $statement->bind_param("ss",$idfinca,$idusuario);
            $statement->execute();
            header("location: asociar.php?id=".$idfinca."&div=0");
        }else{
            header("location: asociar.php?id=".$idfinca."&div=0&error=0");
        }
    }else{
        header("location: ../../");
    }

?>