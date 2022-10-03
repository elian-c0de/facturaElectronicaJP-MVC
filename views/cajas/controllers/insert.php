<?php
     include("../../../config/config.php");
     if(isset($_POST['id'])){
         $empresa = '2';
         $codigoCaja = $_POST['codigo'];
         $descripcion = $_POST['descripcion'];
         $codigoUser = null;
         //$fecha = date('Y-m-d h:i:s a', time());  //Fecha Elian
        $fecha = date('d-m-Y h:i:s a', time()); //Fecha Padalines
 
         $query = "INSERT INTO srja_caja (cod_empresa, cod_caja ,txt_descripcion ,cod_usuario, fec_actualiza)        
                     VALUES ('$empresa','$codigoCaja', '$descripcion','$codigoUser','$fecha')";
         $result = sqlsrv_query($conn, $query);
         if(!$result) {
             die("No se pudo guardar la caja " . $codigoCaja . " en el sistema.");
         }
         echo 'Caja ' . $codigoCaja . ' guardado con exito';
     }
?>