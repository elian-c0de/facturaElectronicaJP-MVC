<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $establecimiento = $_POST['establecimiento'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $matriz = 'C';
    if($_POST['matriz']== 'true'){
        $matriz = 'A';
    }
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE gen_local SET cod_establecimiento = '$establecimiento', 
                                    txt_descripcion = '$descripcion', 
                                    txt_direccion = '$direccion', 
                                    sts_matriz ='$matriz', 
                                    sts_local='$estado', 
                                    fec_actualiza='$fecha' 
                                WHERE cod_establecimiento = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al actualizar el establecimiento '.$establecimiento.', verifique los datos.');
    }else{
        echo 'Establecimiento '.$establecimiento.' actualizado.';
    }
?>