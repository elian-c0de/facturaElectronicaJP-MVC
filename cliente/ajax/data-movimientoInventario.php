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
            $url = "ecmp_detalle_inventario?select=*";
            
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            //$select = "cod_establecimiento,num_documento,cod_inventario,qtx_cantidad,val_costo";

            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["cod_establecimiento","num_documento","cod_inventario","qtx_cantidad","val_costo","val_porcentaje_iva"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_detalle_inventario?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
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
            $url = "ecmp_detalle_inventario?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa&linkTo=cod_empresa&equalTo=".$_GET["code"];
            
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
                    
                    // if($_GET["text"] == "flat"){
                    //     $actions = "";
                        
                    // }else{
                    //     //$actions = "<a class='btn btn-warning btn-sm mr-2'><i class='fas fa-pencil-alt'></i></a> <a class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                    //     $actions = "<a href='movimientoInventario/Editar/" . base64_encode($value->cod_establecimiento . "~" . $value->num_documento . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>
                        
                    //     <i class='fas fa-pencil-alt'></i>

                    //     </a> 
                        
                    //     <a class='btn btn-danger btn-sm rounded-circle removeItem1' idItem=" . base64_encode($value->cod_establecimiento . "~" . $value->num_documento . "~" . $_GET["token"]) . " table='ecmp_detalle_inventario' column='cod_establecimiento' column1='num_documento' page='retenciondeImpuestos'>

                    //     <i class='fas fa-trash-alt'></i>

                    //     </a>";

                    // $actions = TemplateController::htmlClean($actions);
                    // }
                    $cod_establecimiento = $value->cod_establecimiento;
                    $num_documento = $value->num_documento;
                    $cod_inventario = $value->cod_inventario;
                    $qtx_cantidad = $value->qtx_cantidad;
                    $val_costo = $value->val_costo;
                    $val_porcentaje_iva = $value->val_porcentaje_iva;

                            $dataJson.='{
                        "cod_establecimiento":"'.$cod_establecimiento.'",
                        "num_documento":"'.$num_documento.'",
                        "cod_inventario":"'.$cod_inventario.'",
                        "qtx_cantidad":"'.$qtx_cantidad.'",
                        "val_costo":"'.$val_costo.'",
                        "val_porcentaje_iva":"'.$val_porcentaje_iva.'"
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