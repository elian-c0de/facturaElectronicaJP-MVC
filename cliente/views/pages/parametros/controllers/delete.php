<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM gen_control WHERE cod_parametro = '$id'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el parametro ".$id.", verifique los datos.");
        }
        echo "Parametro ".$id." eliminado correctamente.";

    }
    
?>