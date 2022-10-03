<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $sri = $_POST['sri'];
    $defecto = 'C';
    if($_POST['defecto']== 'true'){
        $defecto = 'A';
    }
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }
    $retencion = 'C';
    if($_POST['retencion']== 'true'){
        $retencion = 'A';
    }
    //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
    $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE gen_forma_pago SET cod_forma_pago = '$codigo', 
                                        nom_forma_pago = '$descripcion', 
                                        sts_defecto = '$defecto', 
                                        cod_sri ='$sri', 
                                        sts_forma_pago='$estado', 
                                        sts_retencion='$retencion', 
                                        fec_actualiza='$fecha' 
                                WHERE cod_forma_pago = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al actualizar la forma de pago '.$codigo.', verifique los datos.');
    }else{
        echo 'Forma de Pago '.$codigo.' actualizado con exito.';
    }
?>