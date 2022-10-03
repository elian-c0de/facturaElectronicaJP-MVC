<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM gen_control WHERE cod_parametro= '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find parametro in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'parametro' => $row['cod_parametro'],
            'nombre' => $row['nom_parametro'],
            'valor' => $row['val_parametro'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>