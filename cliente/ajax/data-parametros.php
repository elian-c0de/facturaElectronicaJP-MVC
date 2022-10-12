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
            $url = "gen_control?select=cod_parametro&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&startAt=0&endAt=1&orderAt=cod_parametro";
            
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            $select = "cod_parametro,nom_parametro,val_parametro";

            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["cod_parametro","nom_parametro","val_parametro"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "gen_control?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
                        $data = CurlController::request($url, $method, $fields)->result;
                        // echo '<pre>'; print_r($url); echo '</pre>'; 
                        
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
            $url = "gen_control?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
            $data = CurlController::request($url, $method, $fields)->result;
            // echo '<pre>'; print_r($data); echo '</pre>'; 
            // echo '<pre>'; print_r($url); echo '</pre>'; 
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
                    $cod_parametro = $value->cod_parametro;
                    $nom_parametro = $value->nom_parametro;
                    $val_parametro = $value->val_parametro;
                    $val_parametro = preg_replace('/\\\\/i', '/', $val_parametro);
                            $dataJson.='{
                        "cod_parametro":"'.$cod_parametro.'",
                        "nom_parametro":"'.$nom_parametro.'",
                        "val_parametro":"'.$val_parametro.'",
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