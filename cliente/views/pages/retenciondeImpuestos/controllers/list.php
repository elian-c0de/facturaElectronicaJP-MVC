<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM ecmp_impuesto";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_impuesto' => $row['cod_impuesto'],
            'cod_retencion' => $row['cod_retencion'],
            'txt_descripcion' => $row['txt_descripcion'],
            'por_retencion' => $row['por_retencion'],
            'sts_impuesto' => $row['sts_impuesto'],
        );
    }
    $jsonstring =  json_encode($json);
    echo $jsonstring;
?>