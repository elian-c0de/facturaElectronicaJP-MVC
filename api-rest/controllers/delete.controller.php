<?php
require_once("library/Controlador.php");
class DeleteController extends Controlador{

    public function __construct()
    {
        $this->instanciaModelo = $this->modelo("Delete");
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function deleteData($table,$id,$nameId){
        $response = $this->instanciaModelo->deleteData($table,$id,$nameId);
        $return = new DeleteController();
        $return -> fncResponse($response);

    }

    public function deleteData2ids($table,$id,$nameId,$id2,$nameId2){
        $response = $this->instanciaModelo->deleteData2ids($table,$id,$nameId,$id2,$nameId2);
        $return = new DeleteController();
        $return -> fncResponse($response);

    }

    
    public function deleteData3ids($table,$id,$nameId,$id2,$nameId2,$id3,$nameId3){
        $response = $this->instanciaModelo->deleteData3ids($table,$id,$nameId,$id2,$nameId2,$id3,$nameId3);
        $return = new DeleteController();
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
                'method' => 'delete'
            );

        }

        echo json_encode($json, http_response_code($json['status']));

    }

}


?>