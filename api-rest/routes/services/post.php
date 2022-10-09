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

    $response = new PostController();

    //PETICION POST PARA EL REGISTRO DE USUARIOS
    if(isset($_GET['register']) && $_GET['register'] == true){

        $response->postRegister($table,$_POST);

    }else if(isset($_GET['login']) && $_GET["login"] == true){
       
   
        $response->postLogin($table,$_POST);


}else{
    //peticiones posr para usuarios autorizados
    if(isset($_GET["token"])){
        $validate = Base::tokenValidate($_GET["token"]);


        //cuando el token es valido
        if($validate == "ok"){
            $response->postData($table,$_POST);
            
        }

        // error cuando el token a expirado
        if($validate == "expired"){
            $json = array(
                'status' => 303,
                'result' => "Error: the token has expired"
            );
    
            echo json_encode($json,http_response_code($json["status"]));
            return;
        }

        // error cuanel el token no coinciden en bd
        if($validate == "no-auth"){
            $json = array(
                'status' => 400,
                'result' => "Error: the user is not authorized"
            );
    
            echo json_encode($json,http_response_code($json["status"]));
            return;
        }

 

        // erroc cuandos e solicita el token para realizar la accion
    }else{

        $json = array(
            'status' => 400,
            'result' => "Error: Authorization required"
        );

        echo json_encode($json,http_response_code($json["status"]));
        return;

    }
    
    //solictamos respuesta del controlador para crear datos en cualquier tabla

}
    
}
