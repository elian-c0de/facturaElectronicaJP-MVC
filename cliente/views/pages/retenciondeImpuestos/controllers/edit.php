<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $subid = $_POST['subid'];

    $impuesto = $_POST['impuesto'];
    $codigoRetencion = $_POST['codigoRetencion'];
    $descripcion = $_POST['descripcion'];
    $porcentajeRetencion = $_POST['porcentajeRetencion'];
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }
    
    $query = "UPDATE ecmp_impuesto SET cod_impuesto = '$impuesto',
                                    cod_retencion = '$codigoRetencion', 
                                    txt_descripcion = '$descripcion', 
                                    por_retencion = '$porcentajeRetencion',  
                                    sts_impuesto='$estado' 
                                WHERE cod_impuesto='$id' and cod_retencion = '$subid'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error updating');
        die('Error al actualizar la Retención de Impuesto '. $impuesto .', verfique los datos.');
    }else{
        echo 'Retencion updated successfully';
        echo 'Retención de Impuesto ' . $impuesto . ' actualizada con exito';
    }
?>