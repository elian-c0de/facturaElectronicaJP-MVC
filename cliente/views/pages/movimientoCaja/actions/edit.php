<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $concepto = $_POST['concepto'];
    $descripcion = $_POST['descripcion'];
    $facturacion = 'N';
    if($_POST['facturacion']== 'true'){
        $facturacion = 'S';
    }
    $tipo = $_POST['tipo'];
    $proceso = $_POST['proceso'];
    $afectainventario = 'C';
    if($_POST['afectainventario']== 'true'){
        $afectainventario = 'A';
    }
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE srja_concepto SET cod_concepto = '$concepto', 
                                    txt_descripcion = '$descripcion', 
                                    sts_facturacion = '$facturacion', 
                                    sts_tipo_concepto ='$tipo', 
                                    sts_proceso='$proceso', 
                                    sts_inventario='$afectainventario',
                                    sts_concepto='$estado',
                                    fec_actualiza='$fecha' 
                                WHERE cod_concepto = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al editar el concepto '.$concepto.', verifique los datos.');
    }else{
        echo 'Concepto  '.$concepto.' actualizado con exito.';
    }
?>