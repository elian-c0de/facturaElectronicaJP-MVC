<?php
    include("../../../config/config.php");
    $id = $_POST['id'];
    $codigo= $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $caja = $_POST['caja'];
    $ambiente = $_POST['ambiente'];
    $tipoemision = $_POST['tipoemision'];
    $numFactura = $_POST['numFactura'];
    $numNotaCredito = $_POST['numNotaCredito'];
    $numRetencion = $_POST['numRetencion'];
    $numGuiaRemision = $_POST['numGuiaRemision'];
    $tipofacturacion = $_POST['tipofacturacion'];
    $impresion = $_POST['impresion'];
    $numFacturaPrueba = $_POST['numFacturaPrueba'];
    $numNCPrueba = $_POST['numNCPrueba'];
    $numRetencionPrueba = $_POST['numRetencionPrueba'];
    $numGuiaRemisionPrueba = $_POST['numGuiaRemisionPrueba'];
    $estado = 'C';
    if($_POST['estado']== 'true'){
        $estado = 'A';
    }
    $query = "UPDATE gen_punto_emision SET cod_punto_emision = '$codigo', 
                                    txt_descripcion = '$descripcion', 
                                    cod_caja = '$caja', 
                                    sts_ambiente ='$ambiente', 
                                    sts_tipo_emision='$tipoemision', 
                                    num_factura='$numFactura',
                                    num_nota_credito='$numNotaCredito',
                                    num_retencion='$numRetencion',
                                    num_guia='$numGuiaRemision',
                                    sts_tipo_facturacion='$tipofacturacion',
                                    sts_impresion='$impresion',
                                    num_factura_prueba='$numFacturaPrueba',
                                    num_nota_credito_prueba='$numNCPrueba',
                                    num_retencion_prueba='$numRetencionPrueba',
                                    num_guia_prueba='$numGuiaRemisionPrueba',
                                    sts_punto_emsion='$estado'
                                WHERE cod_punto_emision = '$id'";
    $result = sqlsrv_query($conn, $query);
    if(!$result){
        die('Error updating');
    }else{
        echo 'Punto de Emisión updated successfully';
    }
?>