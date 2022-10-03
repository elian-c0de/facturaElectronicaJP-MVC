<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $subid = $_POST['subid'];

    $codigo = $_POST['codigo'];
    $subcodigo = $_POST['sublinea'];
    $descripcion = $_POST['descripcion'];
    // $fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
     $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

    $query = "UPDATE ecmp_linea SET cod_linea = '$codigo', 
                                    cod_sublinea = '$subcodigo',
                                    txt_descripcion = '$descripcion',
                                    fec_actualiza='$fecha' 
                                WHERE cod_linea = '$id' and cod_sublinea = '$subid'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error al actualizar la linea '. $codigo.', verfique los datos.');
        // Linea ' . $codigo . ' guardado con exito
    }else{
        echo 'Linea ' . $codigo . ' actualizada con exito';
    }
?>