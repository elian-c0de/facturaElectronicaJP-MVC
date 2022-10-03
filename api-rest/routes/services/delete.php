<?php
require_once "library/Base.php";
include_once "controllers/delete.controller.php";

if(isset($_GET["id"]) && isset($_GET["nameId"]) && !isset($_GET["id2"]) && !isset($_GET["nameId2"]) ){
   

    

    $columns = array($_GET["nameId"]);

  

    $this->db = new Base;

    //validar que la tabla y las columas existan en la base de datos
    if(empty($this->db->getColumsData($table,$columns))){
        $json = array(
            'status' => 400,
            'result' => "Error: los datos del formulario no coinciden con la base de datos"
        );

        echo json_encode($json,http_response_code($json["status"]));
        return;
    }
    
    //solictamos respuesta del controlador para crear datos en cualquier tabla
    $response = new deleteController();
    $response->deleteData($table,$data,$_GET["id"],$_GET["nameId"]);
    
    
}

if(isset($_GET["id"]) && isset($_GET["nameId"]) && isset($_GET["id2"]) && isset($_GET["nameId2"]) ){
   
    

  
    $columns = array($_GET["nameId"], $_GET["nameId2"]);
    
  

    


    $this->db = new Base;

    //validar que la tabla y las columas existan en la base de datos
    if(empty($this->db->getColumsData($table,$columns))){
        $json = array(
            'status' => 400,
            'result' => "Error: los datos del formulario no coinciden con la base de datos"
        );

        echo json_encode($json,http_response_code($json["status"]));
        return;
    }

   

    //solictamos respuesta del controlador para crear datos en cualquier tabla
    $response = new DeleteController();
    $response->deleteData2ids($table,$_GET["id"],$_GET["nameId"],$_GET["id2"],$_GET["nameId2"]);
    
    
}


?>