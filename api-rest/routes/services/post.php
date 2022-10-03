<?php
require_once "library/Base.php";
include_once "controllers/post.controller.php";

if(isset($_POST)){
    $columns = array();
    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns,$value);
    }

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
    $response = new PostController();
    $response->postData($table,$_POST);
    
    
}


?>