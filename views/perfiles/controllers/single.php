<?php
include("../../../config/config.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM gen_perfil WHERE cod_perfil= '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't find perfil in database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'codigo' => $row['cod_perfil'],
            'nombre' => $row['nom_perfil'],
            'estado' => $row['sts_perfil'],
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>