<?php
    include("../../../config/config.php");
    if(isset($_POST['codigo']) && isset($_POST['sublinea'])){
        $empresa = '2';
        $codigo = $_POST['codigo'];
        $sublinea = $_POST['sublinea'];
        $descripcion = $_POST['descripcion'];
        // $fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO ecmp_linea (cod_empresa, cod_linea ,cod_sublinea ,txt_descripcion ,fec_actualiza)        
                    VALUES ('$empresa','$codigo', '$sublinea', '$descripcion', '$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar la linea " . $codigo . " en el sistema, verfique los datos.");
        }
        echo 'Linea ' . $codigo . ' guardado con exito';
    }
?>