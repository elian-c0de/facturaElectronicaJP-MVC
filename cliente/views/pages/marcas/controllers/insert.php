<?php
    include("../../../config/config.php");
    if(isset($_POST['codigo'])){
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];

        $query = "INSERT INTO ecmp_marca (cod_marca ,nom_marca)        
                    VALUES ('$codigo','$nombre')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar la marca " . $codigo . " en el sistema.");
        }
        echo 'Marca ' . $codigo . ' guardado con exito';
    }
?>