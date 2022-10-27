<?php

require_once ("../controllers/curl.controller.php");

class DeleteController{

    public $idItem;
    public $table;
    public $cod_empresa;
    public $token;
    public $column;
    
 

    public function dataDelete(){
        
        $security = explode("~",base64_decode($this->idItem));
        $security1 = base64_decode($this->cod_empresa);


        if($security[1] == $this->token){

            $url = $this->table."?id=".$security[0]."&nameId=".$this->column."&token=".$this->token."&nameId2=cod_empresa&id2=".$security1;
 
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

$validate = new DeleteController();

$validate -> idItem = $_POST["idItem"];
$validate -> table = $_POST["table"];
$validate -> cod_empresa = $_POST["cod_empresa"];
$validate -> column = $_POST["column"];
$validate -> token = $_POST["token"];
$validate->dataDelete();

}









?>