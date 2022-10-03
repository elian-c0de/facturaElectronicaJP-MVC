<?php
    include("../../../config/config.php");
    if(isset($_POST['concepto'])){
        $empresa = '2';
        $concepto = $_POST['concepto'];
        $descripcion = $_POST['descripcion'];
        $facturacion = 'N';
        if($_POST['facturacion']== 'true'){
            $facturacion = 'S';
        }
        $tipo = $_POST['tipo'];
        $proceso = $_POST['proceso'];
        $afectainventario = 'C';
        if($_POST['afectainventario']== 'true'){
            $afectainventario = 'A';
        }
        $estado = 'C';
        if($_POST['estado']== 'true'){
            $estado = 'A';
        }
        //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO srja_concepto (cod_empresa, cod_concepto ,txt_descripcion, sts_facturacion, sts_tipo_concepto, sts_proceso, sts_inventario, sts_concepto, fec_actualiza)        
                    VALUES ('$empresa','$concepto', '$descripcion', '$facturacion','$tipo','$proceso','$afectainventario','$estado','$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el concepto " . $concepto . " en el sistema, verifique los datos.");
        }
        echo 'Concepto ' . $concepto . ' guardado con exito';
    }
?>