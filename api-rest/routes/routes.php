<?php
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);
//echo '<pre>'; print_r($RoutesArray); echo '</pre>';

//chequea si recibimos despues de nuesta url es decir  si colocamos localhost/api que vendra a hacer la url base, nos mostrar que no encontro nada
// caso contrario si colocams localhost/api/cajas nos mostrar lo referentes caja y evitaremos esta condicional.

// en otra palabras cuando no recibe una peticion
if (count($routesArray) == 1) {

    $json = array(
        'status' => 404,
        'result' => 'not found'
    );
    echo json_encode($json, http_response_code($json['status']));
    return;
}

if (count($routesArray) == 2 && isset($_SERVER['REQUEST_METHOD'])) {
    $table = explode("?",$routesArray[2])[0];
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
