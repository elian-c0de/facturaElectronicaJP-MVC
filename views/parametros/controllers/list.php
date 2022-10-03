<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM gen_control";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'parametro' => $row['cod_parametro'],
            'nombre' => $row['nom_parametro'],
            'valor' => $row['val_parametro'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>