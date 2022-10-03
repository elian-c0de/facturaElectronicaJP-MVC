<?php
    include("../../../config/config.php");
    if(isset($_POST['establecimiento'])){
        $empresa = '1';
        $establecimiento = $_POST['establecimiento'];
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $matriz = 'C';
        if($_POST['matriz']== 'true'){
            $matriz = 'A';
        }
        $estado = 'C';
        if($_POST['estado']== 'true'){
            $estado = 'A';
        }
        //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO gen_local (cod_empresa, cod_establecimiento ,txt_descripcion ,txt_direccion ,sts_matriz ,sts_local,fec_actualiza)        
                    VALUES ('$empresa','$establecimiento', '$descripcion', '$direccion', '$matriz','$estado','$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el establecimiento " . $establecimiento . " en el sistema, verifique los datos.");
        }
        echo 'Establecimiento ' . $establecimiento . ' guardado con exito';
    }
?>