<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM ecmp_proyecto";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_proyecto' => $row['cod_proyecto'],
            'nom_proyecto' => $row['nom_proyecto'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>