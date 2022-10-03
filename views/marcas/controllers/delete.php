<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM ecmp_marca WHERE cod_marca = $id";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro la marca. ".sqlsrv_error($conn));
        }
        echo "Marca eliminada correctamente.";

    }
    
?>