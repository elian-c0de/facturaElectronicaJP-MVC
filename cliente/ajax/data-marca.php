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
            $url = "ecmp_marca?select=*";
            
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            //$select = "cod_marca,nom_marca";

            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["cod_marca","nom_marca"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_marca?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_marca";
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

            $url = "ecmp_marca?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
            $data = CurlController::request($url, $method, $fields)->result;
             
            $recordsFiltered = $totalData;
        }
        if(empty($data) || $data==null){
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
                        
                        $actions = "<a href='marcas/edit/" . base64_encode($value->cod_marca . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>
                        
                        <i class='fas fa-pencil-alt'></i>

                        </a> 
                        
                        <a class='btn btn-danger btn-sm rounded-circle removeItem1' idItem=" . base64_encode($value->cod_marca . "~" . $_GET["token"]) . " table='ecmp_marca' column='cod_marca' page='marcas'>

                        <i class='fas fa-trash-alt'></i>

                        </a>";

                    $actions = TemplateController::htmlClean($actions);
                    }

                    $cod_marca = $value->cod_marca;
                    $nom_marca = $value->nom_marca;

                            $dataJson.='{
                        "cod_marca":"'.$cod_marca.'",
                        "nom_marca":"'.$nom_marca.'",
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