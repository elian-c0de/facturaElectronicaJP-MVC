<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $subid = $_POST['subid'];
    $query = "SELECT * FROM ecmp_impuesto WHERE cod_impuesto='$id' and cod_retencion= '$subid'";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find retencion in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'cod_impuesto' => $row['cod_impuesto'],
            'cod_retencion' => $row['cod_retencion'],
            'txt_descripcion' => $row['txt_descripcion'],
            'por_retencion' => $row['por_retencion'],
            'sts_impuesto' => $row['sts_impuesto'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>