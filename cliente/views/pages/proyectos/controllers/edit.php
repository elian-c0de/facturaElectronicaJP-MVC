<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE ecmp_proyecto SET cod_proyecto = '$codigo', 
                                    nom_proyecto = '$nombre',
                                    fec_actualiza='$fecha' 
                                WHERE cod_proyecto = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al actualizar el proyecto '.$codigo.', verifique los datos.');
    }else{
        echo 'Proyecto '.$codigo.' actualizado con exito.';
    }
?>