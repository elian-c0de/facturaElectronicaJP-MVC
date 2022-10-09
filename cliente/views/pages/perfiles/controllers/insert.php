<?php
    include("../../../config/config.php");
    if(isset($_POST['codigo'])){
        $empresa = '1';
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $estado = 'C';
        if($_POST['estado']== 'true'){
            $estado = 'A';
        }

        $query = "INSERT INTO gen_perfil (cod_empresa ,cod_perfil ,nom_perfil,sts_perfil)        
                    VALUES ('$empresa','$codigo', '$nombre', '$estado')";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se pudo guardar el perfil " . $codigo . " en el sistema.");
        }
        echo 'Perfil ' . $codigo . ' guardado con exito';
    }
?>