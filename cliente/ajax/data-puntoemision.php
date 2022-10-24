<?php
require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";
class DataTableController
{
    public function data()
    {
        if (!empty($_POST)) {
            
            if($_GET["cod_establecimiento"] != "") {
                
                //capturando y organizandos las variables post de datatable
                $draw = $_POST["draw"];
                $orderByColumnIndex = $_POST['order'][0]['column'];
                $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];
                $orderType = $_POST['order'][0]['dir'];
                $start = $_POST["start"];
                $length = $_POST["length"];
            
                //total de registros de la data
                $url = "gen_punto_emision?select=*&linkTo=cod_empresa,cod_establecimiento&equalTo=".$_GET["code"].",".$_GET["cod_establecimiento"];
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
                $valk = array();
                //busquedad de datos
                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["cod_punto_emision","txt_descripcion"];
                        $search = str_replace(" ","_",$_POST['search']['value']);
                        foreach ($linkTo as $key => $value) {

                            $url = "gen_punto_emision?select=*&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType;
                            $data = CurlController::request($url, $method, $fields)->result;
                            
                            if($data == "Not Found"){
                                $data = array();
                                $recordsFiltered = count($data);
                            
                            }else{
                                foreach ($data as $key1 => $value1) {
                                    if ($value1->cod_empresa == $_GET["code"] && $value1->cod_establecimiento == $_GET["cod_establecimiento"]) {
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
                $url = "gen_punto_emision?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&linkTo=cod_empresa,cod_establecimiento&equalTo=".$_GET["code"].",".$_GET["cod_establecimiento"]."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
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
                            $actions = "<a href='sublineaproducto/edit/" . base64_encode($value->cod_punto_emision . "~" . $value->cod_sublinea . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                                <i class='fas fa-pencil-alt'></i>

                                </a> 
                                
                                <a class='btn btn-danger btn-sm rounded-circle removeItem2ids' idItem=" .  base64_encode($value->cod_punto_emision . "~" . $value->cod_sublinea . "~" . $_GET["token"]) . " table='gen_punto_emision' column='cod_punto_emision' column1='cod_sublinea' page='lineasdeproducto' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                                <i class='fas fa-trash-alt'></i>

                                </a>";

                            $actions = TemplateController::htmlClean($actions);
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
                        $sts_punto_emsion = $value->sts_punto_emsion;
                        $num_factura_prueba = $value->num_factura_prueba;
                        $num_nota_credito_prueba = $value->num_nota_credito_prueba;
                        $num_retencion_prueba = $value->num_retencion_prueba;
                        $num_guia_prueba = $value->num_guia_prueba;

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
                            "sts_punto_emsion":"'.$sts_punto_emsion.'",
                            "num_factura_prueba":"'.$num_factura_prueba.'",
                            "num_nota_credito_prueba":"'.$num_nota_credito_prueba.'",
                            "num_retencion_prueba":"'.$num_retencion_prueba.'",
                            "num_guia_prueba":"'.$num_guia_prueba.'",
                            "actions":"'.$actions.'"
                        },';
                    }

                    $dataJson = substr($dataJson,0,-1); 
                    $dataJson .= ']}';
                    echo $dataJson;
            }else{
                echo '{"data":[]}';
                return;
            }
            
        }
    }
}

$data = new DataTableController();
$data->data();