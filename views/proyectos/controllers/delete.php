<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM ecmp_proyecto WHERE cod_proyecto = $id";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el proyecto ".$id.", verifique los datos.");
        }
        echo "Proyecto ".$id." eliminado correctamente.";

    }
    
?>