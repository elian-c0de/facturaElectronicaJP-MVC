<?php
    include("../../../config/config.php");
    if(isset($_POST['parametro'])){
        $empresa = '2';
        $parametro = $_POST['parametro'];
        $nombre = $_POST['nombre'];
        $valor = $_POST['valor'];
        // $fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO gen_control (cod_empresa, cod_parametro ,nom_parametro ,val_parametro, fec_actualiza)        
                    VALUES ('$empresa','$parametro', '$nombre', '$valor','$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el parametro " . $parametro . " en el sistema, verfique los datos.");
        }
        echo 'Parametro ' . $parametro . ' guardado con exito';
    }
?>