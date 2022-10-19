<?php
include_once "controllers/get.controller.php";


$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;
$orderAt = $_GET["orderAt"] ?? null;
$filterTo = $_GET["filterTo"] ?? null;
$inTo = $_GET["inTo"] ?? null;


// $endAt = $_GET["endAt"] ?? null;
$response = new GetController();

// //peticiones posr para usuarios autorizados
// if (isset($_GET["token"])) {
//     $validate = Base::tokenValidate($_GET["token"]);


    //cuando el token es valido
    // if ($validate == "ok") {

        // esto es si viene peticiones get con filtro
        

        if (isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && !isset($_GET["rel"]) && !isset($_GET["type"])) {
            $response->getDataFilter($table, $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt,$endAt,$orderAt);


            // peticiones get sin filtros entre tablas relacionadas
        } else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
            $response->getRelData($_GET["rel"], $_GET["type"], $select, $orderBy, $orderMode, $startAt, $endAt, $orderAt);


            //peticiones get con filtros entre tablas relacionadas
        } else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {
            $response->getRelDataFilter($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt, $orderAt);

            //peticiones get para el buscado sin relaciones
        } else if (!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["search"])) {
            $response->getDataSearch($table, $select, $_GET["linkTo"], $_GET["search"], $orderBy, $orderMode, $startAt, $endAt, $orderAt);

            
        } else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["search"])) {
            $response->getRelDataSearch($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["search"], $orderBy, $orderMode, $startAt, $endAt, $orderAt);


        } else if (!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["between1"]) && isset($_GET["between2"])) {
            $response->getDataRange($table, $select, $_GET["linkTo"], $_GET["between1"], $_GET["between2"], $orderBy, $orderMode, $startAt, $endAt, $orderAt, $filterTo, $inTo);


            //peticiones get para selecion de rngos con relaciones
        } else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["between1"]) && isset($_GET["between2"])) {
            $response->getRelDataRange($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["between1"], $_GET["between2"], $orderBy, $orderMode, $startAt,$endAt,$orderAt, $filterTo, $inTo);


        } else {
            //peticiones get sin filtro
            

            $response->getData($table, $select, $orderBy, $orderMode, $startAt,$endAt,$orderAt);
            
        }
    // }

    // // error cuando el token a expirado
    // if ($validate == "expired") {
    //     $json = array(
    //         'status' => 303,
    //         'result' => "Error: the token has expired"
    //     );

    //     echo json_encode($json, http_response_code($json["status"]));
    //     return;
    // }

    // // error cuanel el token no coinciden en bd
    // if ($validate == "no-auth") {
    //     $json = array(
    //         'status' => 400,
    //         'result' => "Error: the user is not authorized"
    //     );

    //     echo json_encode($json, http_response_code($json["status"]));
    //     return;
    // }



    // erroc cuandos e solicita el token para realizar la accion
// } else {

//     $json = array(
//         'status' => 400,
//         'result' => "Error: Authorization required"
//     );

//     echo json_encode($json, http_response_code($json["status"]));
//     return;
// }
