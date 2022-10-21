<?php
require_once("library/Controlador.php");
class PutController extends Controlador{

    public function __construct()
    {
        $this->instanciaModelo = $this->modelo("Put");
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function putData($table,$data,$id,$nameId){
        $response = $this->instanciaModelo->putData($table,$data,$id,$nameId);
        $return = new PutController();
        $return -> fncResponse($response);

    }

    public function putData2ids($table,$data,$id,$nameId,$id2,$nameId2){
        $response = $this->instanciaModelo->putData2ids($table,$data,$id,$nameId,$id2,$nameId2);
        $return = new PutController();
        $return -> fncResponse($response);

    }

    public function putData3ids($table,$data,$id,$nameId,$id2,$nameId2,$id3,$nameId3){
        $response = $this->instanciaModelo->putData3ids($table,$data,$id,$nameId,$id2,$nameId2,$id3,$nameId3);
        $return = new PutController();
        $return -> fncResponse($response);

    }

    public function fncResponse($response){

        if(!empty($response)){
            $json = array(
                'status' => 200,
                'result' => $response
            );
        }else{
            $json = array(
                'status' => 404,
                'result' => 'Not Found',
                'method' => 'put'
            );

        }

        echo json_encode($json, http_response_code($json['status']));

    }

}


?>