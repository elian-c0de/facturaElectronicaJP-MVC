<?php
     include("../../../config/config.php");
     if(isset($_POST['impuesto']) && isset($_POST['codigoRetencion'])){
         $impuesto = $_POST['impuesto'];
         $codigoRetencion = $_POST['codigoRetencion'];
         $descripcion = $_POST['descripcion'];
         $porcentajeRetencion = $_POST['porcentajeRetencion'];
         $estado = 'C';
         if($_POST['estado']== 'true'){
            $estado = 'A';
        }
 
         $query = "INSERT INTO ecmp_impuesto (cod_impuesto, cod_retencion, txt_descripcion, por_retencion, sts_impuesto)        
                     VALUES ('$impuesto','$codigoRetencion', '$descripcion', '$porcentajeRetencion', '$estado')";
         $result = sqlsrv_query($conn, $query);
         if(!$result) {
             die("No se pudo guardar la Retención de Impuesto " . $impuesto . " en el sistema.");
         }
         echo 'Retencion de Impuesto' . $impuesto . ' guardado con exito';
     }
?>