<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM srja_concepto";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'concepto' => $row['cod_concepto'],
            'descripcion' => $row['txt_descripcion'],
            'facturacion' => $row['sts_facturacion'],
            'tipo_concepto' => $row['sts_tipo_concepto'],
            'proceso' => $row['sts_proceso'],
            'inventario' => $row['sts_inventario'],
            'estado' => $row['sts_concepto'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>