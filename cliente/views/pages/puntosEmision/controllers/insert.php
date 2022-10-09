<?php
    include("../../../config/config.php");
    if(isset($_POST['codigo'])){
        $empresa = '2';
        $establecimiento = '002';
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
        $query = "INSERT INTO gen_punto_emision (cod_empresa, cod_establecimiento, cod_punto_emision, txt_descripcion, cod_caja, sts_ambiente, sts_tipo_emision, num_factura, num_nota_credito, num_retencion, num_guia, sts_tipo_facturacion, sts_impresion, num_factura_prueba, num_nota_credito_prueba, num_retencion_prueba, num_guia_prueba, sts_punto_emsion )
                    VALUES ('$empresa', '$establecimiento', '$codigo', '$descripcion', '$caja', '$ambiente', '$tipoemision', '$numFactura', '$numNotaCredito', '$numRetencion', '$numGuiaRemision', '$tipofacturacion', '$impresion', '$numFacturaPrueba', '$numNCPrueba', '$numRetencionPrueba', '$numGuiaRemisionPrueba','$estado')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el Punto de Emisión " . $codigo ." en el sistema.");
        }
        echo 'Emisión ' . $codigo . ' guardado con exito';
    }
?>