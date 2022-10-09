<?php
require_once "library/Base.php";
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);


//echo '<pre>'; print_r($RoutesArray); echo '</pre>';

//chequea si recibimos despues de nuesta url es decir  si colocamos localhost/api que vendra a hacer la url base, nos mostrar que no encontro nada
// caso contrario si colocams localhost/api/cajas nos mostrar lo referentes caja y evitaremos esta condicional.

// en otra palabras cuando no recibe una peticion
if (count($routesArray) == 2) {
    

    $json = array(
        'status' => 404,
        'result' => 'Not Found'
    );
    echo json_encode($json, http_response_code($json['status']));
    return;
}

if (count($routesArray) == 3 && isset($_SERVER['REQUEST_METHOD'])) {
    
    $table = explode("?",$routesArray[3])[0];

    //VALIDAR LLAVE SECRETA
    
    if(!isset(getallheaders()["Authorization"]) || getallheaders()["Authorization"] != Base::apiKey()){
        

        $json = array(
            'status' => 400,
            'result' => "You are not authorized to make this request"
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

  


  













    //GET
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        include_once("services/get.php");
    }

    //POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        include_once("services/post.php");
    }

    //PUT
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        include_once("services/put.php");
    }

    //DELETE
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        include_once("services/delete.php");

    
    }
}
