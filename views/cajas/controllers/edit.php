<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $codigoCaja = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $codigoUser = null;
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines
    
    $query = "UPDATE srja_caja SET cod_caja = '$codigoCaja', 
                                    txt_descripcion = '$descripcion', 
                                    cod_usuario = '$codigoUser',  
                                    fec_actualiza='$fecha' 
                                WHERE cod_caja = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error updating');
    }else{
        echo 'Caja updated successfully';
    }
?>