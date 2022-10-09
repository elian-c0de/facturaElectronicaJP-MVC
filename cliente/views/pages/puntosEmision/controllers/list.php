<?php
    include("../../../config/config.php");
    $query = "SELECT * FROM gen_punto_emision";
    $result = sqlsrv_query($conn, $query);
    if(!$result) {
        die("Couldn't connect to database".sqlsrv_error($conn));
    }

    $json = array();
    while($row = sqlsrv_fetch_array($result)){
        $json[] = array(
            'cod_punto_emision' => $row['cod_punto_emision'],
            'txt_descripcion' => $row['txt_descripcion'],
            'cod_caja' => $row['cod_caja'],
            'sts_ambiente' => $row['sts_ambiente'],
            'sts_tipo_emision' => $row['sts_tipo_emision'],
            'num_factura' => $row['num_factura'],
            'num_nota_credito' => $row['num_nota_credito'],
            'num_retencion' => $row['num_retencion'],
            'num_guia' => $row['num_guia'],
            'sts_tipo_facturacion' => $row['sts_tipo_facturacion'],
            'sts_impresion' => $row['sts_impresion'],
            'num_factura_prueba' => $row['num_factura_prueba'],
            'num_nota_credito_prueba' => $row['num_nota_credito_prueba'],
            'num_retencion_prueba' => $row['num_retencion_prueba'],
            'num_guia_prueba' => $row['num_guia_prueba'],
            'sts_punto_emsion' => $row['sts_punto_emsion'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>