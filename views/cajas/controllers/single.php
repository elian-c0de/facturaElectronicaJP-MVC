<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM srja_caja WHERE cod_caja= $id";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find caja in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'codigo' => $row['cod_caja'],
            'descripcion' => $row['txt_descripcion'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>