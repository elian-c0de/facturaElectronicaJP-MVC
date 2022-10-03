<?php
    include("../../../config/config.php");
    if(isset($_POST['precio'])){
        $empresa = '2';
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $defecto = 'C';
        if($_POST['defecto']== 'true'){
            $defecto = 'A';
        }
        $estado = 'C';
        if($_POST['estado']== 'true'){
            $estado = 'A';
        }
        //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO ecmp_precio (cod_empresa, cod_precio ,txt_descripcion ,sts_defecto ,sts_precio, fec_actualiza)        
                    VALUES ('$empresa','$precio', '$descripcion', '$defecto','$estado','$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el tipo de precio " . $precio . " en el sistema, verifique los datos.");
        }
        echo 'Tipo Precio ' . $precio . ' guardado con exito';
    }
?>