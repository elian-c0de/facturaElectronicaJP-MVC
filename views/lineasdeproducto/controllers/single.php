<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $subid = $_POST['subid'];
    $query = "SELECT * FROM ecmp_linea WHERE cod_linea = '$id' and cod_sublinea = '$subid'";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find linea in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'cod_linea' => $row['cod_linea'],
            'cod_sublinea' => $row['cod_sublinea'],
            'txt_descripcion' => $row['txt_descripcion'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>