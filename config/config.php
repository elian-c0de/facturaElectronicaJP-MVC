<?php
        //Todo Cambiar nombre del SERVIDOR!!!

        //Servidor Elian: ELIANGL753VE
        //servidor Miguel: DESKTOP-J4VGQP7
        //$serverName = "DESKTOP-J4VGQP7"; 
        $serverName = "CARLOS";
        $conecctionInfo = array("Database" => "PECMP_JPEREZ");
        $conn = sqlsrv_connect($serverName, $conecctionInfo);
    
        // if ($conn) {
        //     echo "Connection established\n";
        // }else{
        //     echo "Connection failed\n";
        //     die(print_r(sqlsrv_errors(), true));
        // }
?>