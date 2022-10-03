<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $parametro = $_POST['parametro'];
    $nombre = $_POST['nombre'];
    $valor = $_POST['valor'];
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE gen_control SET cod_parametro = '$parametro', 
                                    nom_parametro = '$nombre',
                                    val_parametro ='$valor',
                                    fec_actualiza='$fecha' 
                                WHERE cod_parametro = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al actualizar el parametro'. $parametro . ', verfique los datos.');
    }else{
        echo 'Parametro '.$parametro.' actualizado con exito.';
    }
?>