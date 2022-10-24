<?php
require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";
class DataTableController
{
    public function data()
    {
        if (!empty($_POST)) {
            
            if(isset($_GET["linea"])){
                
                //capturando y organizandos las variables post de datatable
                $draw = $_POST["draw"];
                $orderByColumnIndex = $_POST['order'][0]['column'];
                $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];
                $orderType = $_POST['order'][0]['dir'];
                $start = $_POST["start"];
                $length = $_POST["length"];
            
                //total de registros de la data
                $url = "ecmp_linea?select=*&linkTo=cod_empresa,cod_linea&equalTo=".$_GET["code"].",".$_GET["linea"];
                $link=array();
                $method = "GET";
                $fields = array();
                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){
                    foreach ($response -> result as $key2 => $value2) {
                        if ($value2->cod_sublinea != 000) {
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

                        $linkTo = ["cod_sublinea","txt_descripcion"];
                        $search = str_replace(" ","_",$_POST['search']['value']);
                        foreach ($linkTo as $key => $value) {

                            $url = "ecmp_linea?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
                            $data = CurlController::request($url, $method, $fields)->result;
                            
                            if($data == "Not Found"){
                                $data = array();
                                $recordsFiltered = count($data);
                            
                            }else{
                                foreach ($data as $key1 => $value1) {
                                    if ($value1->cod_empresa == $_GET["code"] && $value1->cod_linea == $_GET["linea"] && $value1->cod_sublinea != 000 ) {
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
                $url = "ecmp_linea?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&linkTo=cod_empresa,cod_linea&equalTo=".$_GET["code"].",".$_GET["linea"]."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
                $data = CurlController::request($url, $method, $fields)->result;
                foreach ($data as $key3 => $value3) {
                    if ($value3->cod_sublinea != 000) {
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
                            $actions = "<a href='sublineaproducto/edit/" . base64_encode($value->cod_linea . "~" . $value->cod_sublinea . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                                <i class='fas fa-pencil-alt'></i>

                                </a> 
                                
                                <a class='btn btn-danger btn-sm rounded-circle removeItem2ids' idItem=" .  base64_encode($value->cod_linea . "~" . $value->cod_sublinea . "~" . $_GET["token"]) . " table='ecmp_linea' column='cod_linea' column1='cod_sublinea' page='sublineaproducto' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                                <i class='fas fa-trash-alt'></i>

                                </a>";

                            $actions = TemplateController::htmlClean($actions);
                        }
                        $cod_sublinea = $value->cod_sublinea;
                        $txt_descripcion = $value->txt_descripcion;

                                $dataJson.='{
                            "cod_sublinea":"'.$cod_sublinea.'",
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