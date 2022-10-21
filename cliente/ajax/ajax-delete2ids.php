<?php

require_once ("../controllers/curl.controller.php");

class Delete1Controller{

    public $idItem;
    public $table;
    public $cod_empresa;
    public $token;
    public $column;
    public $column1;
    
 

    public function dataDelete(){
        
        $security = explode("~",base64_decode($this->idItem));
        $security1 = base64_decode($this->cod_empresa);


        if($security[2] == $this->token){

            $url = $this->table."?id=".$security[0]."&nameId=".$this->column."&token=".$this->token."&nameId2=cod_empresa&id2=".$security1."&nameId2=".$this->column1."&id2=".$security[1];
            $method = "DELETE";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
         
           
          
            
       
            if($response == null){
                echo "400";
            }else{
                echo $response->status;
    
            }

        }else{
            echo 404;
        }

       

}






}

if(isset($_POST["idItem"])){

$validate = new Delete1Controller();

$validate -> idItem = $_POST["idItem"];
$validate -> table = $_POST["table"];
$validate -> cod_empresa = $_POST["cod_empresa"];
$validate -> column = $_POST["column"];
$validate -> column1 = $_POST["column1"];
$validate -> token = $_POST["token"];
$validate->dataDelete();

}









?>