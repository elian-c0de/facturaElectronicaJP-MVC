<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM srja_caja";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_caja' => $row['cod_caja'],
            'txt_descripcion' => $row['txt_descripcion'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>