<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM srja_concepto WHERE cod_concepto= $id";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find concepto in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'concepto' => $row['cod_concepto'],
            'descripcion' => $row['txt_descripcion'],
            'facturacion' => $row['sts_facturacion'],
            'tipo' => $row['sts_tipo_concepto'],
            'proceso' => $row['sts_proceso'],
            'afectainventario' => $row['sts_inventario'],
            'estado' => $row['sts_concepto'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>