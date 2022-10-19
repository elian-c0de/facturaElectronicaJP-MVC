<?php
require_once("library/Controlador.php");
class GetController extends Controlador{

    public function __construct()
    {
        $this->instanciaModelo = $this->modelo("Get");
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    // el Index es para Obtener los registros
    public function getData($table,$select,$orderBy,$orderMode,$startAt,$endAt,$orderAt)
    {
        $response = $this->instanciaModelo->obtenerData($table,$select,$orderBy,$orderMode,$startAt,$endAt,$orderAt);
    

        $return = new GetController();
        $return -> fncResponse($response);


        // $json = array(

        //     "status" => 200,
        //     "total_registros" => count($cajas),
        //     "detalle" => $cajas

        // );
        // echo json_encode($json, true);
        
    }
     // el Index es para Obtener los registros
     public function getRelData($rel,$type,$select,$orderBy,$orderMode,$startAt, $endAt, $orderAt)
     {
         $response = $this->instanciaModelo->obtenerRelData($rel,$type,$select,$orderBy,$orderMode,$startAt, $endAt, $orderAt);
         $return = new GetController();
         $return -> fncResponse($response);

     }

     public function getRelDataFilter($rel,$type,$select,$linkTo,$equalTo,$orderBy,$orderMode,$startAt, $endAt, $orderAt)
     {
         $response = $this->instanciaModelo->obtenerRelDataFilter($rel,$type,$select,$linkTo,$equalTo,$orderBy,$orderMode,$startAt, $endAt, $orderAt);
         $return = new GetController();
         $return -> fncResponse($response);

     }

     public function getDataSearch($table,$select,$linkTo,$search,$orderBy,$orderMode,$startAt, $endAt, $orderAt)
     {
         $response = $this->instanciaModelo->obtenerDataSearch($table,$select,$linkTo,$search,$orderBy,$orderMode,$startAt, $endAt, $orderAt);
         $return = new GetController();
         $return -> fncResponse($response);

     }

    public function getDataFilter($table,$select,$linkTo,$equalTo,$orderBy,$orderMode,$startAt, $endAt, $orderAt){
        $response = $this->instanciaModelo->obtenerDataFilter($table,$select,$linkTo,$equalTo,$orderBy,$orderMode,$startAt, $endAt, $orderAt);
        $return = new GetController();
        $return -> fncResponse($response);

    }

    public function getRelDataSearch($rel,$type,$select,$linkTo,$search,$orderBy,$orderMode,$startAt, $endAt, $orderAt){
        $response = $this->instanciaModelo->obtenerRelDataSearch($rel,$type,$select,$linkTo,$search,$orderBy,$orderMode,$startAt, $endAt, $orderAt);
        $return = new GetController();
        $return -> fncResponse($response);

    }
    //peticiones get para selecion de rangos
    public function getDataRange($table,$select,$linkTo,$between1,$between2,$orderBy,$orderMode,$startAt,$endAt,$orderAt,$filterTo,$inTo){
        $response = $this->instanciaModelo->getDataRange($table,$select,$linkTo,$between1,$between2,$orderBy,$orderMode,$startAt,$endAt,$orderAt,$filterTo,$inTo);
        $return = new GetController();
        $return -> fncResponse($response);

    }
    // peticiomes get para secion de rngos con relacioness
    public function getRelDataRange($rel,$type,$select,$linkTo,$between1,$between2,$orderBy,$orderMode,$startAt,$endAt,$orderAt,$filterTo,$inTo){
        $response = $this->instanciaModelo->getRelDataRange($rel,$type,$select,$linkTo,$between1,$between2,$orderBy,$orderMode,$startAt,$endAt,$orderAt,$filterTo,$inTo);
        $return = new GetController();
        $return -> fncResponse($response);

    }


    
    


    public function fncResponse($response){

        if(!empty($response)){
            $json = array(
                'status' => 200,
                'total' => count($response),
                'result' => $response
            );
        }else{
            $json = array(
                'status' => 404,
                'result' => 'Not Found',
                'method' => 'get'
            );

        }

        echo json_encode($json, http_response_code($json['status']));

    }
    
    
    

}



?>