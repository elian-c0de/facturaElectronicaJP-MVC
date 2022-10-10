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
            $url = "gen_punto_emision?select=cod_punto_emision&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=0&endAt=1&orderAt=cod_punto_emision";
            
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            if($response->status == 200){
                $totalData = $response->total;
            }else{
                echo '{"data":[]}';
                return;
            }
            $select = "cod_punto_emision,txt_descripcion,cod_caja,sts_ambiente,sts_tipo_emision,num_factura,num_nota_credito,num_retencion,num_guia,sts_tipo_facturacion,sts_impresion,num_factura_prueba,num_nota_credito_prueba,num_retencion_prueba,num_guia_prueba,sts_punto_emsion";
            
            //busquedad de datos
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["cod_punto_emision","txt_descripcion","cod_caja","fec_actualiza"];
                    $search = str_replace(" ","_",$_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "gen_punto_emision?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_establecimiento";
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
            $url = "gen_punto_emision?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
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
                    $cod_punto_emision = $value->cod_punto_emision;
                    $txt_descripcion = $value->txt_descripcion;
                    $cod_caja = $value->cod_caja;
                    $sts_ambiente = $value->sts_ambiente;
                    $sts_tipo_emision = $value->sts_tipo_emision;
                    $num_factura = $value->num_factura;
                    $num_nota_credito = $value->num_nota_credito;
                    $num_retencion = $value->num_retencion;
                    $num_guia = $value->num_guia;
                    $sts_tipo_facturacion = $value->sts_tipo_facturacion;
                    $sts_impresion = $value->sts_impresion;
                    $num_factura_prueba = $value->num_factura_prueba;
                    $num_nota_credito_prueba = $value->num_nota_credito_prueba;
                    $num_retencion_prueba = $value->num_retencion_prueba;
                    $num_guia_prueba = $value->num_guia_prueba;
                    $sts_punto_emsion = $value->sts_punto_emsion;

                            $dataJson.='{
                        "cod_punto_emision":"'.$cod_punto_emision.'",
                        "txt_descripcion":"'.$txt_descripcion.'",
                        "cod_caja":"'.$cod_caja.'",
                        "sts_ambiente":"'.$sts_ambiente.'",
                        "sts_tipo_emision":"'.$sts_tipo_emision.'",
                        "num_factura":"'.$num_factura.'",
                        "num_nota_credito":"'.$num_nota_credito.'",
                        "num_retencion":"'.$num_retencion.'",
                        "num_guia":"'.$num_guia.'",
                        "sts_tipo_facturacion":"'.$sts_tipo_facturacion.'",
                        "sts_impresion":"'.$sts_impresion.'",
                        "num_factura_prueba":"'.$num_factura_prueba.'",
                        "num_nota_credito_prueba":"'.$num_nota_credito_prueba.'",
                        "num_retencion_prueba":"'.$num_retencion_prueba.'",
                        "num_guia_prueba":"'.$num_guia_prueba.'",
                        "sts_punto_emsion":"'.$sts_punto_emsion.'",
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