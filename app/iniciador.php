<?php
//Cargamos librerias
require_once 'config/configurar.php';
require_once 'helpers/url_helper.php';
// require_once 'librerias/Base.php';
// require_once 'librerias/Controlador.php';
// require_once 'librerias/Core.php';


//AutoLoad php
spl_autoload_register(function($nombreClase){
    require_once 'libs/' .$nombreClase. '.php';
});

?>