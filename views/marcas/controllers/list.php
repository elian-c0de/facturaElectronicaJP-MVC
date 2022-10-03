<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM ecmp_marca";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_marca' => $row['cod_marca'],
            'nom_marca' => $row['nom_marca'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>