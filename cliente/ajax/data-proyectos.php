<?php
require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

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
            $url = "ecmp_proyecto?select=cod_proyecto&linkTo=cod_empresa&equalTo=".$_GET["code"];
            
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }

            $hola = array();
            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["cod_proyecto","nom_proyecto","fec_actualiza"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_proyecto?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
                        $data = CurlController::request($url, $method, $fields)->result;
                        // echo '<pre>'; print_r($url); echo '</pre>'; 
                        
                        if($data == "Not Found"){
                            $data = array();
                        
                        }else{
                            foreach ($data as $key1 => $value1) {
                                if ($value1->cod_empresa == $_GET["code"]) {
                                 array_push($hola,$value1);
                                }
                             }
                             $data = array_slice($hola,$start,$length);
                             $recordsFiltered = count($data);
                        }
                    }
                }else{
                    echo '{"data":[]}';
                    return;
                }
            }else{ 
            //seleccionar datos
            $url = "ecmp_proyecto?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa&linkTo=cod_empresa&equalTo=".$_GET["code"];
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
                        // $actions = "<a class='btn btn-warning btn-sm mr-2'><i class='fas fa-pencil-alt'></i></a> <a class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                        $actions = "<a href='proyectos/edit/" . base64_encode(trim($value->cod_proyecto) . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                        <i class='fas fa-pencil-alt'></i>

                        </a> 
                        
                        <a class='btn btn-danger btn-sm rounded-circle removeItem' idItem=" . base64_encode(trim($value->cod_proyecto) . "~" . $_GET["token"]) . " table='ecmp_proyecto' column='cod_proyecto' page='proyectos' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                        <i class='fas fa-trash-alt'></i>

                        </a>";

                    $actions = TemplateController::htmlClean($actions);

                    }
                    $cod_proyecto = $value->cod_proyecto;
                    $nom_proyecto = $value->nom_proyecto;

                            $dataJson.='{
                        "cod_proyecto":"'.$cod_proyecto.'",
                        "nom_proyecto":"'.$nom_proyecto.'",
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