<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM ecmp_precio WHERE cod_precio = '$id'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el tipo precio ".$id.", verfique los datos. ".sqlsrv_error($conn));
        }
        echo "Tipo Precio ".$id." eliminado correctamente.";

    }
    
?>