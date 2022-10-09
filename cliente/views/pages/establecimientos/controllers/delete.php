<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM gen_local WHERE cod_establecimiento = '$id'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("El Establecimiento ".$id." no existe o esta en uso.");
        }
        echo "Establecimiento ".$id." eliminado correctamente.";

    }
    
?>