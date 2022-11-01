<?php
require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";
class DataTableController
{
    public function data()
    {
        if (!empty($_POST)) {
            
            if(isset($_GET["puntoemision"])){
                
                //capturando y organizandos las variables post de datatable
                $draw = $_POST["draw"];
                $orderByColumnIndex = $_POST['order'][0]['column'];
                $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];
                $orderType = $_POST['order'][0]['dir'];
                $start = $_POST["start"];
                $length = $_POST["length"];
            
                //total de registros de la data
                $url = "gen_punto_emision?select=*&linkTo=cod_empresa,cod_establecimiento&equalTo=".$_GET["code"].",".$_GET["puntoemision"];
                $link=array();
                $method = "GET";
                $fields = array();
                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){
                    foreach ($response -> result as $key2 => $value2) {
                        if ($value2->cod_punto_emision != 000) {
                        array_push($link,$value2);
                        }
                    }
                    $totalData = count($link);
                }else{
                    echo '{"data":[]}';
                    return;
                }
                $hola = array();
                $valk = array();
                //busquedad de datos
                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["cod_punto_emision","cod_establecimiento","txt_descripcion"];
                        $search = str_replace(" ","_",$_POST['search']['value']);
                        foreach ($linkTo as $key => $value) {

                            $url = "gen_punto_emision?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
                            $data = CurlController::request($url, $method, $fields)->result;
                            
                            if($data == "Not Found"){
                                $data = array();
                                $recordsFiltered = count($data);
                            
                            }else{
                                foreach ($data as $key1 => $value1) {
                                    if ($value1->cod_empresa == $_GET["code"] && $value1->cod_establecimiento == $_GET["puntoemision"] && $value1->cod_punto_emision != 000 ) {
                                    array_push($hola,$value1);
                                    }
                                }
                                $data = array_slice($hola,$start,$length);
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
                $url = "gen_punto_emision?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&linkTo=cod_empresa,cod_establecimiento&equalTo=".$_GET["code"].",".$_GET["puntoemision"]."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
                $data = CurlController::request($url, $method, $fields)->result;
                foreach ($data as $key3 => $value3) {
                    if ($value3->cod_punto_emision != 000) {
                    array_push($valk,$value3);
                    }
                }
                $data=$valk;
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
                            $actions = "<a href='puntosEmision/edit/" . base64_encode($value->cod_establecimiento . "~" . $value->cod_punto_emision . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                                <i class='fas fa-pencil-alt'></i>

                                </a> 
                                
                                <a class='btn btn-danger btn-sm rounded-circle removeItem2ids' idItem=" .  base64_encode($value->cod_establecimiento . "~" . $value->cod_punto_emision . "~" . $_GET["token"]) . " table='gen_punto_emision' column='cod_establecimiento' column1='cod_punto_emision' page='puntosEmision' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                                <i class='fas fa-trash-alt'></i>

                                </a>";

                            $actions = TemplateController::htmlClean($actions);
                        }
                        $cod_punto_emision = $value->cod_punto_emision;
                        $txt_descripcion = $value->txt_descripcion;

                                $dataJson.='{
                            "cod_punto_emision":"'.$cod_punto_emision.'",
                            "txt_descripcion":"'.$txt_descripcion.'",
                            "actions":"'.$actions.'"
                        },';
                    }

                    $dataJson = substr($dataJson,0,-1); 
                    $dataJson .= ']}';
                    echo $dataJson;
            }
            
        }
    }
}

$data = new DataTableController();
$data->data();