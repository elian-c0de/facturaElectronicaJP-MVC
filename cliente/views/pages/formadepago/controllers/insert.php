<?php
    include("../../../config/config.php");
    if(isset($_POST['codigo'])){
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $sri = $_POST['sri'];
        $defecto = 'C';
        if($_POST['defecto']== 'true'){
            $defecto = 'A';
        }
        $estado = 'C';
        if($_POST['estado']== 'true'){
            $estado = 'A';
        }
        $retencion = 'C';
        if($_POST['retencion']== 'true'){
            $retencion = 'A';
        }
        //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO gen_forma_pago (cod_forma_pago, nom_forma_pago ,sts_defecto ,cod_sri ,sts_forma_pago ,sts_retencion,fec_actualiza)        
                    VALUES ('$codigo','$descripcion', '$defecto', '$sri', '$estado','$retencion','$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar la forma de pago " . $codigo . " en el sistema, verifique los datos.");
        }
        echo 'Forma de Pago ' . $codigo . ' guardado con exito';
    }
?>