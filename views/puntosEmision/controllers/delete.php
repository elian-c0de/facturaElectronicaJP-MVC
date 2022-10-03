<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM gen_punto_emision WHERE cod_punto_emision = $id";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el punto de emisión. ".sqlsrv_error($conn));
        }
        echo "Punto de Emisión eliminado correctamente.";

    }
    
?>