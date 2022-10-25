<?php

require_once ("../controllers/curl.controller.php");

class ValidateCotroller{

    public $data;
    public $id;
    public $table;
    public $columna;
    public $linea;

    public function dataRepeat(){

   
        $url = $this->table."?select=".$this->columna."&linkTo=cod_empresa,cod_linea,".$this->columna."&equalTo=".$this->id.",".$this->linea.",".$this->data;
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
$validate -> linea = $_POST["linea"];
$validate->dataRepeat();

}









?>