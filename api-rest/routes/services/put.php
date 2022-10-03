<?php
require_once "library/Base.php";
include_once "controllers/put.controller.php";

if(isset($_GET["id"]) && isset($_GET["nameId"]) && !isset($_GET["id2"]) && !isset($_GET["nameId2"]) ){
    echo "hola 1id";
    $data = array();

    parse_str(file_get_contents('php://input'),$data);

    $columns = array();

    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns,$value);
    }
    array_push($columns,$_GET['nameId']);

    $columns = array_unique($columns);

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
    $response = new PutController();
    $response->putData($table,$data,$_GET["id"],$_GET["nameId"]);
    
    
}

if(isset($_GET["id"]) && isset($_GET["nameId"]) && isset($_GET["id2"]) && isset($_GET["nameId2"]) ){
   
    $data = array();

    parse_str(file_get_contents('php://input'),$data);

    $columns = array();

    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns,$value);
    }

    array_push($columns,$_GET['nameId']);
    array_push($columns,$_GET['nameId2']);

    $columns = array_unique($columns);
  


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
    $response = new PutController();
    $response->putData2ids($table,$data,$_GET["id"],$_GET["nameId"],$_GET["id2"],$_GET["nameId2"]);
    
    
}


?>