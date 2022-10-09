<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM gen_perfil";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_perfil' => $row['cod_perfil'],
            'nom_perfil' => $row['nom_perfil'],
            'sts_perfil' => $row['sts_perfil'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>