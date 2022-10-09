<?php
    include("../../../config/config.php");
    if(isset($_POST['codigo'])){
        $empresa = '2';
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines

        $query = "INSERT INTO ecmp_proyecto (cod_empresa ,cod_proyecto ,nom_proyecto,fec_actualiza)        
                    VALUES ('$empresa','$codigo', '$nombre', '$fecha')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el proyecto " . $codigo . " en el sistema, verifique los datos.");
        }
        echo 'Proyecto ' . $codigo . ' guardado con exito';
    }
?>