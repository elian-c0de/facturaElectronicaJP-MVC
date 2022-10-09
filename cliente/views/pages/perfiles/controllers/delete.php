<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM gen_perfil WHERE cod_perfil = '$id'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el perfil. ".sqlsrv_error($conn));
        }
        echo "Perfil eliminado correctamente.";

    }
    
?>