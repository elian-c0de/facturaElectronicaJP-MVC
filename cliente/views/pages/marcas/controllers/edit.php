<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];

    $query = "UPDATE ecmp_marca SET cod_marca = '$codigo', 
                                    nom_marca = '$nombre'
                                WHERE cod_marca = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error updating marca');
    }else{
        echo 'Marca updated successfully';
    }
?>