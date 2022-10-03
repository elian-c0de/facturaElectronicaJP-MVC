<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM gen_local WHERE cod_establecimiento= $id";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find establecimiento in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'establecimiento' => $row['cod_establecimiento'],
            'descripcion' => $row['txt_descripcion'],
            'direccion' => $row['txt_direccion'],
            'matriz' => $row['sts_matriz'],
            'estado' => $row['sts_local'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>