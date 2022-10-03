<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM srja_concepto WHERE cod_concepto = $id";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el concepto ".$id.", verifique los datos.");
        }
        echo "Concepto ".$id." eliminado correctamente.";

    }
    
?>