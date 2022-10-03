<?php
require_once("library/Controlador.php");
class PostController extends Controlador{

    public function __construct()
    {
        $this->instanciaModelo = $this->modelo("Post");
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function postData($table,$data){
        $response = $this->instanciaModelo->postData($table,$data);
        $return = new PostController();
        $return -> fncResponse($response);

    }

    public function fncResponse($response){

        if(!empty($response)){
            $json = array(
                'status' => 200,
                'results' => $response
            );
        }else{
            $json = array(
                'status' => 404,
                'result' => 'Not Found',
                'method' => 'post'
            );

        }

        echo json_encode($json, http_response_code($json['status']));

    }

}


?>