<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM ecmp_marca WHERE cod_marca= $id";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find marca in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'codigo' => $row['cod_marca'],
            'nombre' => $row['nom_marca'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>