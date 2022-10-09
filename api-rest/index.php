<?php 

//mostrar errores
ini_set('display_errors',1);
ini_set("log_errors",1);
ini_set("error_log", "C:\xampp\htdocs\api-rest1/php_error_log");



header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, Authorization, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("content-type application/json; charset=utf-8");



require_once "controllers/routes.controller.php";
// require_once "controladores/cajas.controlador.php";
// require_once "modelos/cajas.php";

$rutas= new RoutesController();
$rutas->index();







?>