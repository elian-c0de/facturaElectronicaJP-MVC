<?php
require_once("library/Controlador.php");
require_once "library/Base.php";
require_once("vendor/autoload.php");

use Firebase\JWT\JWT;
class PostController extends Controlador{

    

    public function __construct()
    {
        $this->instanciaModelo = $this->modelo("Post");
        $this->instanciaModelo1 = $this->modelo("Get");
        $this->instanciaModelo2 = $this->modelo("Put");
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function postData($table,$data){
        $response = $this->instanciaModelo->postData($table,$data);
        $return = new PostController();
        $return -> fncResponse($response,null);

    }

    public function postRegister($table,$data){

        if(isset($data["cod_passwd"]) && $data["cod_passwd"] != null){
            $crypt = crypt($data["cod_passwd"], 'td');
            echo '<pre>'; print_r($crypt); echo '</pre>';
            $data['cod_passwd'] = $crypt;
            // echo '<pre>'; print_r($data); echo '</pre>';
            // echo '<pre>'; print_r($table); echo '</pre>';

            $response = $this->instanciaModelo->postData($table,$data);
            $return = new PostController();
            $return -> fncResponse($response, null);
   

        }

    }





    public function postLogin($table,$data){
        //validar que el usuario exiate n la base de datos
        $response = $this->instanciaModelo1->obtenerDataFilter($table,"*","cod_usuario",$data["cod_usuario"],null,null,null,null,null);
    
        if(!empty($response)){

            $v = str_replace(" ", "",$response[0]->{"cod_passwd"});
            $crypt = crypt($data["cod_passwd"], 'td');
            $v1 = str_replace(" ","",$response[0]->{"cod_usuario"});
           
            if($v == $crypt){
                
                $token = Base::jwt($response[0]->{"cod_usuario"},$response[0]->{"nom_usuario"});
                $jwt = JWT::encode($token, "fdsfsfewnwewv", 'HS256');
                $data = array(
                    "token_usuario" => $jwt,
                    "token_exp_usuario" => $token["exp"]
                );
                
                $update = $this->instanciaModelo2->putData($table,$data,$v1,"cod_usuario");
    
            

                if(isset($update["comment"]) && $update["comment"] == "the process was successful"){

                    $response[0]->{"token_usuario"} = $jwt;
                    $response[0]->{"token_exp_usuario"} = $token["exp"];
                    $return = new PostController();
                    $return -> fncResponse($response,null);

                }

            }else{

                $response = null;
                $return = new PostController();
                $return -> fncResponse($response,"Wrong password");
            

            }
        
        }else{
            $response = null;
            $return = new PostController();
            $return -> fncResponse($response,"Wrong email");
        }
      

    }









    public function fncResponse($response,$error){

        if(!empty($response)){

            if(isset($response[0]->{"cod_password"})){
                unset($response[0]->{"cod_password"});
            }


            $json = array(
                'status' => 200,
                'result' => $response
            );
        }else{
            if($error != null){

                $json = array(
                    'status' => 404,
                    'result' => $error
                );

            }else{
                $json = array(
                    'status' => 404,
                    'result' => 'Not Found',
                    'method' => 'post'
                );
            }
         

        }

        echo json_encode($json, http_response_code($json['status']));

    }

}


?>