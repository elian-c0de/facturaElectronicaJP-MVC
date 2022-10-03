<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM gen_forma_pago";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_forma_pago' => $row['cod_forma_pago'],
            'nom_forma_pago' => $row['nom_forma_pago'],
            'sts_defecto' => $row['sts_defecto'],
            'cod_sri' => $row['cod_sri'],
            'sts_forma_pago' => $row['sts_forma_pago'],
            'sts_retencion' => $row['sts_retencion'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>