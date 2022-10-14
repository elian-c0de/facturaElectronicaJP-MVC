<?php

require_once ("../controllers/curl.controller.php");

class ValidateCotroller{

    public $data;
    public $id;
    public $table;
    public $columna;

    public function dataRepeat(){

   
        $url = $this->table."?select=cod_caja&linkTo=cod_empresa,".$this->columna."&equalTo=".$this->id.",".$this->data;
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url,$method,$fields);
        if($response == null){
            echo "400";
        }else{
            echo $response->status;

        }

}

}

if(isset($_POST["data"])){

$validate = new ValidateCotroller();

$validate -> data = $_POST["data"];
$validate -> id = $_POST["id"];
$validate -> table = $_POST["table"];
$validate -> columna = $_POST["columna"];
$validate->dataRepeat();

}









?>