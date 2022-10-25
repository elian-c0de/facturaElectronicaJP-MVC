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
            $url = "ecmp_precio?select=cod_precio&linkTo=cod_empresa&equalTo=".$_GET["code"];
            
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

                    $linkTo = ["cod_precio","txt_descripcion"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_precio?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
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
            $url = "ecmp_precio?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&linkTo=cod_empresa&equalTo=".$_GET["code"]."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
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
                        $actions = "<a href='tipoprecio/edit/" . base64_encode($value->cod_precio . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>
                            

                            <i class='fas fa-pencil-alt'></i>

                            </a> 
                            
                            <a class='btn btn-danger btn-sm rounded-circle removeItem' idItem=" .  base64_encode($value->cod_precio . "~" . $_GET["token"]) . " table='ecmp_precio' column='cod_precio' page='tipoprecio' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                            <i class='fas fa-trash-alt'></i>

                            </a>";

                        $actions = TemplateController::htmlClean($actions);
                    }
                    $cod_precio = $value->cod_precio;
                    $txt_descripcion = $value->txt_descripcion;
                    $sts_defecto = $value->sts_defecto;
                    $sts_precio = $value->sts_precio;

                            $dataJson.='{
                                "cod_precio":"'.$cod_precio.'",
                                "txt_descripcion":"'.$txt_descripcion.'",
                                "sts_defecto":"'.$sts_defecto.'",
                                "sts_precio":"'.$sts_precio.'",
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