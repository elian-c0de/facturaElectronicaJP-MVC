<?php 

//mostrar errores
ini_set('display',1);
ini_set("log_errors",1);
ini_set("error_log", "C:\xampp\htdocs\api-rest1/php_error_log");

require_once "controllers/routes.controller.php";
// require_once "controladores/cajas.controlador.php";
// require_once "modelos/cajas.php";

$rutas= new RoutesController();
$rutas->index();







?>