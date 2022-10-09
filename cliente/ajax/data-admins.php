<?php

require_once "../controllers/curl.controller.php";

class DataTableController
{

    public function data()
    {
        if (!empty($_POST)) {
     
           

            //capturando y organizandos las variables post de datatable

            $draw = $_POST["draw"];
            $orderByColumnIndex = $_POST['order'][0]['column'];
            $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];
            $orderType = $_POST['order'][0]['dir'];
            $start = $_POST["start"];
            $length = $_POST["length"];
           
     
            //total de registros de la data
            $url = "srja_caja?select=cod_caja&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=0&endAt=1&orderAt=cod_empresa";
            
            
            $method = "GET";
            $fields = array();


            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            $select = "cod_empresa,cod_caja,txt_descripcion,cod_usuario,fec_actualiza";
            //busquedad de datos
            
            if(!empty($_POST['search']['value'])){

                
                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                

                    $linkTo = ["cod_empresa","cod_caja","txt_descripcion","cod_usuario","fec_actualiza"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "srja_caja?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_caja";
                        $data = CurlController::request($url, $method, $fields)->result;
                        
                   
                    
                        if($data == "Not Found"){
                            $data = array();
                            $recordsFiltered = count($data);
                        
                        }else{
                            $data = $data;
                            $recordsFiltered = count($data);
                            break;
                        }
                    }
            
                }else{
                    echo '{"data":[]}';
                    return;
                }
               
             
            }else{ 
            //seleccionar datos
          
            $url = "srja_caja?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=".$start."&endAt=".$length."&orderAt=cod_caja";

            $data = CurlController::request($url, $method, $fields)->result;
        
            $recordsFiltered = $totalData;
         
           
    
        }
        if(empty($data)){

            echo '{"data": []}';

            return;

        }
            //construit json a regresar
            $dataJson = '{
                "Draw": '.intval($draw).',
                "recordsTotal": '.$totalData.',
                "recordsFiltered": '.$recordsFiltered.',
                "data": [';

                //recorrer la data 
                foreach ($data as $key => $value) {

                    if($_GET["text"] == "flat"){
                        $actions = "";
                        
                    }else{
                        $actions = "<a class='btn btn-warning btn-sm mr-2'><i class='fas fa-pencil-alt'></i></a> <a class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                    }
                    $cod_empresa = $value->cod_empresa;
                    $cod_empresa = $value->cod_empresa;
                    $cod_caja = $value->cod_caja;
                    $txt_descripcion = $value->txt_descripcion;
                    $cod_usuario = $value->cod_usuario;
                    $fec_actualiza = $value->fec_actualiza;

                            $dataJson.='{
                        "cod_empresa":"'.$cod_empresa.'",
                        "cod_caja":"'.$cod_caja.'",
                        "txt_descripcion":"'.$txt_descripcion.'",
                        "cod_usuario":"'.$cod_usuario.'",
                        "fec_actualiza":"'.$fec_actualiza.'",
                        "actions":"'.$actions.'"
                    },';
                }

                $dataJson = substr($dataJson,0,-1); 
                $dataJson .= ']}';
                echo $dataJson;
        
      
        }
        
    
    }

    
    

}




$data = new DataTableController();
$data->data();

    





