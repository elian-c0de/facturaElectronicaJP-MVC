<?php

require_once ("../controllers/curl.controller.php");

class GetController{


    public $cod_empresa;

    
 

    public function dataGet(){
        

        

            $url = "gen_empresa?equalTo=".$this->cod_empresa."&linkTo=cod_empresa";
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


$validate = new GetController();

$validate -> cod_empresa = $_POST["coddata"];

$validate->dataGet();











?>