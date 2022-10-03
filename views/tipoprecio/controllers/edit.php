<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $defecto = 'C';
    if($_POST['defecto']== 'true'){
        $defecto = 'A';
    }
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE ecmp_precio SET cod_precio = '$precio', 
                                    txt_descripcion = '$descripcion',
                                    sts_defecto ='$defecto', 
                                    sts_precio='$estado', 
                                    fec_actualiza='$fecha' 
                                WHERE cod_precio = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al actualizar el tipo de precio '.$precio);
    }else{
        echo 'Tipo Precio '.$precio.' correctamente actualizado';
    }
?>