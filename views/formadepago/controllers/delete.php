<?php
    include("../../../config/config.php");
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM gen_forma_pago WHERE cod_forma_pago = '$id'";
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            die("No se encontro el establecimiento ".$id." verifique los datos.");
        }
        echo "Establecimiento ".$id."  eliminado correctamente.";

    }
    
?>