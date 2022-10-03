<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }

    $query = "UPDATE gen_perfil SET cod_perfil = '$codigo', 
                                    nom_perfil = '$nombre',
                                    sts_perfil= '$estado' 
                                WHERE cod_perfil = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error updating perfiles');
    }else{
        echo 'Perfil updated successfully';
    }
?>