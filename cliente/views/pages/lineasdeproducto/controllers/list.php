<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM ecmp_linea";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_linea' => $row['cod_linea'],
            'cod_sublinea' => $row['cod_sublinea'],
            'txt_descripcion' => $row['txt_descripcion'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>