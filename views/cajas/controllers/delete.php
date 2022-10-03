<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM srja_caja WHERE cod_caja = $id";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro la Caja. ".sqlsrv_error($conn));
        }
        echo "Caja eliminado correctamente.";

    }
    
?>