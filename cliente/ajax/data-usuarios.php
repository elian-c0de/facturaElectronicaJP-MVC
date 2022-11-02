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
            //$url = "gen_usuario?select=cod_usuario&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&startAt=0&endAt=1&orderAt=cod_usuario";
            $url = "gen_usuario?select=cod_usuario&linkTo=cod_empresa&equalTo=".$_GET["code"];

            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            //$select = "cod_empresa,cod_usuario,nom_usuario,cod_perfil,cod_establecimiento,cod_punto_emision,sts_usuario,sts_administrador";

            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["cod_usuario","nom_usuario","cod_perfil","cod_establecimiento","cod_punto_emision","sts_usuario","sts_administrador"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "gen_usuario?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
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
            $url = "gen_usuario?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa&linkTo=cod_empresa&equalTo=".$_GET["code"];
            $data = CurlController::request($url, $method, $fields)->result;
            // echo '<pre>'; print_r($data); echo '</pre>'; 
            // echo '<pre>'; print_r($url); echo '</pre>'; 
            if($data == "Not Found"){
                $recordsFiltered = 0;
            }else{
                $recordsFiltered = $totalData;
            }
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
                        //$actions = "<a class='btn btn-warning btn-sm mr-2'><i class='fas fa-pencil-alt'></i></a> <a class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                        $actions = "<a href='usuarios/edit/" . base64_encode($value->cod_usuario . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                        <i class='fas fa-pencil-alt'></i>

                        </a> 
                        
                        <a class='btn btn-danger btn-sm rounded-circle removeItem' idItem=" . base64_encode($value->cod_usuario . "~" . $_GET["token"]) . " table='gen_usuario' column='cod_usuario' page='usaurios' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                        <i class='fas fa-trash-alt'></i>

                        </a>";

                    $actions = TemplateController::htmlClean($actions);
                    }
                    $cod_usuario = $value->cod_usuario;
                    $nom_usuario = $value->nom_usuario;
                    $cod_perfil = $value->cod_perfil;
                    $cod_establecimiento = $value->cod_establecimiento;
                    $cod_punto_emision = $value->cod_punto_emision;
                    $sts_usuario = $value->sts_usuario;
                    $sts_administrador = $value->sts_administrador;

                            $dataJson.='{
                        "cod_usuario":"'.$cod_usuario.'",
                        "nom_usuario":"'.$nom_usuario.'",
                        "cod_perfil":"'.$cod_perfil.'",
                        "cod_establecimiento":"'.$cod_establecimiento.'",
                        "cod_punto_emision":"'.$cod_punto_emision.'",
                        "sts_usuario":"'.$sts_usuario.'",
                        "sts_administrador":"'.$sts_administrador.'",
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

