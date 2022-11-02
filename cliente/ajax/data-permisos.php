<?php

require_once ("../controllers/curl.controller.php");

class ValidateCotroller{

    public $cod_empresa;
    public $cod_perfil;

    public function ObtenerData(){

   
        $url = "gen_perfil_opcion?linkTo=cod_empresa,cod_perfil&equalTo=".$this->cod_empresa.",".trim($this->cod_perfil);
        //echo '<pre>'; print_r($url); echo '</pre>';
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url,$method,$fields);
        
        if($response == null){
            echo "400";
        }else{
            echo json_encode($response->result);
            

        }

}

}



$validate = new ValidateCotroller();

$validate -> cod_empresa = $_POST["cod_empresa"];
$validate -> cod_perfil = $_POST["cod_perfil"];
$validate -> ObtenerData();




?>