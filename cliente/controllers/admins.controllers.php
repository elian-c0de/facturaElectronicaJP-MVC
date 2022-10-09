<?php

class AdminsController{

    public function login(){

        if(isset($_POST["txtusuario"])){

            if(preg_match('/^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}$/D', $_POST["txtusuario"])){
                
                $url = "gen_usuario?login=true";
                $method = "POST";
                $fields = array(
                    "cod_usuario" => $_POST["txtusuario"],
                    "cod_passwd" => $_POST["txtcontra"]
                );
                
                $response = CurlController::request($url,$method,$fields);
                
         
                //validamos si los datos coinciden en la base de datos
                if($response->status == 200){
                    $v = str_replace(" ","",$response->result[0]->cod_perfil);
                    //validamos si tiene rol administrativo
                    if( $v != "ADM"){
                        echo '<div class="alert-default-warning">no tienes permiso para acceder</div>';
                    }
                    
                    $_SESSION["admin"] = $response->result[0];
                    echo '<script>

                    window.location = "'.$_SERVER["REQUEST_URI"].'"
                    
                    
                    </script>';


                }else{
                    echo '<div class="alert-default-warning">'.$response->result.'</div>';
                }


            }else{
                echo '<div class="alert-default-warning">Erorr en la sintaxis de los campos</div>';

            }
        }
       
        
    }
}



?>