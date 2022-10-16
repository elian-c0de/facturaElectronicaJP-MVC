<?php

require_once "controllers/template.controller.php";
require_once "controllers/curl.controller.php";


ini_set('display_erros',1);
ini_set("log_errors",1);
ini_set("error_log", "C:/xampp/htdocs/SistemaF/cliente/php_error_log");
//cabios raros
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, Authorization, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");






$index = new TemplateController();
$index -> index();




?>