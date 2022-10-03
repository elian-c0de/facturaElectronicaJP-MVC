<?php
include_once "controllers/get.controller.php";


$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$filterTo = $_GET["filterTo"] ?? null;
$inTo = $_GET["inTo"] ?? null;


// $endAt = $_GET["endAt"] ?? null;
$response = new GetController();




// esto es si viene peticiones get con filtro
if(isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && !isset($_GET["rel"]) && !isset($_GET["type"])){
    $response -> getDataFilter($table,$select,$_GET["linkTo"],$_GET["equalTo"],$orderBy,$orderMode,$startAt);



    // peticiones get sin filtros entre tablas relacionadas
}else if(isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){

    $response -> getRelData($_GET["rel"],$_GET["type"],$select,$orderBy,$orderMode,$startAt);

    //peticiones get con filtros entre tablas relacionadas
}else if(isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])){
    $response -> getRelDataFilter($_GET["rel"],$_GET["type"],$select,$_GET["linkTo"],$_GET["equalTo"],$orderBy,$orderMode,$startAt);

    //peticiones get para el buscado sin relaciones
}else if(!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["search"])){
    $response -> getDataSearch($table,$select,$_GET["linkTo"],$_GET["search"],$orderBy,$orderMode,$startAt);

}else if(isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["search"]) ){
    $response -> getRelDataSearch($_GET["rel"],$_GET["type"],$select,$_GET["linkTo"],$_GET["search"],$orderBy,$orderMode,$startAt);

}else if(!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["between1"]) && isset($_GET["between2"])){
    $response -> getDataRange($table,$select,$_GET["linkTo"],$_GET["between1"],$_GET["between2"],$orderBy,$orderMode,$startAt,$filterTo,$inTo);

    //peticiones get para selecion de rngos con relaciones
}else if(isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["between1"]) && isset($_GET["between2"])){
    $response -> getRelDataRange($_GET["rel"],$_GET["type"],$select,$_GET["linkTo"],$_GET["between1"],$_GET["between2"],$orderBy,$orderMode,$startAt,$filterTo,$inTo);
}
else{
    //peticiones get sin filtro
    $response -> getData($table,$select,$orderBy,$orderMode,$startAt);


}








?>