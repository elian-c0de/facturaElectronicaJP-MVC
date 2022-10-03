<?php
    include("../../../config/config.php");
    if(isset($_POST['id']) && isset($_POST['subid'])) {
        $id = $_POST['id'];
        $subid = $_POST['subid'];

        $query = "DELETE FROM ecmp_linea WHERE cod_linea = '$id' and cod_sublinea = '$subid'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro la linea ".$id.", verfique los datos ");
        }
        echo "Linea ".$id.", ".$subid." eliminada correctamente.";

    }
    
?>