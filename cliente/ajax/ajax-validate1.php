<?php

require_once ("../controllers/curl.controller.php");

class Validate1Cotroller{

    public $data;
    public $table;
    public $columna;

    public function dataRepeat(){

   
        $url = $this->table."?select=".$this->columna."&linkTo=".$this->columna."&equalTo=".$this->data;
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

$validate = new Validate1Cotroller();

$validate -> data = $_POST["data"];
$validate -> table = $_POST["table"];
$validate -> columna = $_POST["columna"];
$validate->dataRepeat();

}


?>