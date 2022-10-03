<?php
    include("../../../config/config.php");
    if(isset($_POST['id']) && isset($_POST['subid'])) {
        $id = $_POST['id'];
        $subid = $_POST['subid'];

        $query = "DELETE FROM ecmp_impuesto WHERE cod_impuesto='$id' and cod_retencion = '$subid'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro la Retención de Impuesto ".$id.", verfique los datos ");
        }
        echo "Retención de Impuesto ".$id.", ".$subid." eliminada correctamente.";

    }
    
?>