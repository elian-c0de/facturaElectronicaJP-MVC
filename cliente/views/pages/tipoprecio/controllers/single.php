<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM ecmp_precio WHERE cod_precio= '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find tipo precio in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'precio' => $row['cod_precio'],
            'descripcion' => $row['txt_descripcion'],
            'defecto' => $row['sts_defecto'],
            'estado' => $row['sts_precio'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>