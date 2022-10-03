<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM ecmp_proyecto WHERE cod_proyecto= $id";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find proyecto in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'codigo' => $row['cod_proyecto'],
            'nombre' => $row['nom_proyecto'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>