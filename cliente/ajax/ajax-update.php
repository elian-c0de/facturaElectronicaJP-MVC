<?php

require_once ("../controllers/curl.controller.php");

class UpdateController{

    public $idItem;
    public $table;
    public $cod_empresa;
    public $token;
    public $column;
    public $estado;    
    public $donde;

    
 

    public function dataUpdate(){
        
        $security = explode("~",base64_decode($this->idItem));
        $id = $security[0];
        $security = explode("~",base64_decode($this->cod_empresa));
        $security1 = base64_decode($this->cod_empresa);

        $data="";
        

        if($this->donde == "stsinven"){
            

            if ($this->estado == "A") {
                
            
                $data="sts_inventario="."I";
            }
    
            if ($this->estado == "I") {
                $data="sts_inventario="."A";
            }

        }

        if($this->donde == "stsiva"){
            

            if ($this->estado == "A") {
            
                $data="sts_iva="."I";
            }
    
            if ($this->estado == "I") {
                $data="sts_iva="."A";
            }

        }

 

      
        


       
        if($security[1] == $this->token){
            

            $url = $this->table."?id=".$id."&nameId=".$this->column."&token=".$this->token."&nameId2=cod_empresa&id2=".$security1[0];
      

           
            $method = "PUT";
            $fields = $data;
         
          
 
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

$validate = new UpdateController();

$validate -> idItem = $_POST["idItem"];
$validate -> table = $_POST["table"];
$validate -> cod_empresa = $_POST["cod_empresa"];
$validate -> column = $_POST["column"];
$validate -> token = $_POST["token"];
$validate -> estado = $_POST["estado"];
$validate-> donde = $_POST["donde"];
$validate->dataUpdate();

}









?>