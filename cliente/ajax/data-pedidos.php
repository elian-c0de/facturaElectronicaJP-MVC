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
            $url = "ecmp_detalle_pedido?select=*";
            
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            //$select = "num_pedido,num_detalle,cod_inventario,txt_descripcion,val_cantidad";

            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["num_pedido","num_detalle","cod_inventario","txt_descripcion","val_cantidad","val_unitario","val_porcentaje_iva"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_detalle_pedido?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=num_detalle";
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
            $url = "ecmp_detalle_pedido?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=num_detalle";
            
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
                    //     $actions = "<a href='pedidos/Editar/" . base64_encode($value->num_pedido . "~" . $value->num_detalle . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>
                        
                    //     <i class='fas fa-pencil-alt'></i>

                    //     </a> 
                        
                    //     <a class='btn btn-danger btn-sm rounded-circle removeItem1' idItem=" . base64_encode($value->num_pedido . "~" . $value->num_detalle . "~" . $_GET["token"]) . " table='ecmp_detalle_pedido' column='num_pedido' column1='num_detalle' page='retenciondeImpuestos'>

                    //     <i class='fas fa-trash-alt'></i>

                    //     </a>";

                    // $actions = TemplateController::htmlClean($actions);
                    // }
                    $num_pedido = $value->num_pedido;
                    $num_detalle = $value->num_detalle;
                    $cod_inventario = $value->cod_inventario;
                    $txt_descripcion = $value->txt_descripcion;
                    $val_cantidad = $value->val_cantidad;
                    $val_unitario = $value->val_unitario;
                    $val_porcentaje_iva = $value->val_porcentaje_iva;
                            $dataJson.='{
                        "num_pedido":"'.$num_pedido.'",
                        "num_detalle":"'.$num_detalle.'",
                        "cod_inventario":"'.$cod_inventario.'",
                        "txt_descripcion":"'.$txt_descripcion.'",
                        "val_cantidad":"'.$val_cantidad.'",
                        "val_unitario":"'.$val_unitario.'",
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