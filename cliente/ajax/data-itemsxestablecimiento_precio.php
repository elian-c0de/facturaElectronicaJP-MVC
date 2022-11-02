<?php

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class itemsxestablecimientoDataTableController
{

    public function data()
    {


        //PREGUNTAMOS SI SE ENVIO DATOS 
        if (!empty($_POST)) {

            if ($_GET["establecimiento"] != "") {

                //CAPTURA Y ORGANIZACION DE VARIABLES ENVIADAS DE DATATABLE POR EL METODO POST
                $draw = $_POST["draw"];
                $orderByColumnIndex = $_POST['order'][0]['column'];
                $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];
                $orderType = $_POST['order'][0]['dir'];
                $start = $_POST["start"];
                $length = $_POST["length"];
    
                $index = array();
                $hola = array();
         
                $security = explode("~", base64_decode($_GET["idItem"]));
                
                // Array
                // (
                //     [0] => PS-002
                //     [1] => 002
                //     [2] => eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjcxODgyODEsImV4cCI6MTY2NzQwNDI4MSwiZGF0YSI6eyJjb2RfdXN1YXJpbyI6IkZhYnJpRDQgICAgICAgICAgICAgIiwibm9tX3VzdWFyaW8iOiJkdWVcdTAwZjFvICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIn19.7Suevi6Pv4t-TUZC-utRdzBmoprMi-0i844TL61nM-U
                // )

                $select = "ecmp_inventario.cod_empresa,ecmp_inventario.cod_inventario,ecmp_item_local.cod_establecimiento%20as%20cod_establecimiento_local,ecmp_item_local.cod_inventario%20as%20cod_inventario_local,ecmp_item_precio.cod_establecimiento%20as%20cod_establecimiento_precio,ecmp_item_precio.cod_inventario%20as%20cod_inventario_precio,ecmp_precio.cod_precio%20as%20cod_precio_precio,ecmp_item_precio.cod_precio,ecmp_precio.txt_descripcion,ecmp_inventario.val_costo,ecmp_item_precio.val_porcentaje_costo,ecmp_item_precio.val_precio,ecmp_inventario.sts_iva";
                $rel = "ecmp_inventario,ecmp_item_local,ecmp_item_precio,ecmp_precio";
                $type = "cod_empresa,cod_empresa,cod_empresa,cod_empresa";
                

                // $url = "ecmp_item_local?select=*&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=fec_actualiza";
                $url = "relations?rel=" . $rel . "&type=" . $type . "&select=" . $select;
      
                $method = "GET";
                $fields = array();
                $response = CurlController::request($url, $method, $fields);
           


                //VALIDAMOS QUE LA RESPUESTA DE LA API SEA 200 CASO CONTRARIO SE APLICARA UN RETURN DEVOLVIENDO UN JSON VACIO
                if ($response->status == 200) {
                    foreach ($response->result as $key => $value) {
            
                        if ($value->cod_empresa == $_GET["code"]  && $value->cod_establecimiento_local == $value->cod_establecimiento_precio && $value->cod_inventario == $value->cod_inventario_local && $value->cod_inventario_local == $value->cod_inventario_precio && $value->cod_inventario_precio == $value->cod_inventario && $value->cod_precio == $value->cod_precio_precio) {
                
                            if ($value->cod_inventario == $security[0] && $value->cod_establecimiento_local == $security[1]) {
                                array_push($index, $value);
                            }
          
                        }
                    }

               
                 
                    $totalData = count($index);
                } else {
                    echo '{"data":[]}';
                    return;
                }




                $select = "ecmp_inventario.cod_empresa,ecmp_inventario.cod_inventario,ecmp_item_local.cod_establecimiento%20as%20cod_establecimiento_local,ecmp_item_local.cod_inventario%20as%20cod_inventario_local,ecmp_item_precio.cod_establecimiento%20as%20cod_establecimiento_precio,ecmp_item_precio.cod_inventario%20as%20cod_inventario_precio,ecmp_precio.cod_precio%20as%20cod_precio_precio,ecmp_item_precio.cod_precio,ecmp_precio.txt_descripcion,ecmp_inventario.val_costo,ecmp_item_precio.val_porcentaje_costo,ecmp_item_precio.val_precio,ecmp_inventario.sts_iva";
                $rel = "ecmp_inventario,ecmp_item_local,ecmp_item_precio,ecmp_precio";
                $type = "cod_empresa,cod_empresa,cod_empresa,cod_empresa";

                $response1 = CurlController::request($url, $method, $fields)->result;



                foreach ($response1 as $key => $value) {
            
                    if ($value->cod_empresa == $_GET["code"]  && $value->cod_establecimiento_local == $value->cod_establecimiento_precio && $value->cod_inventario == $value->cod_inventario_local && $value->cod_inventario_local == $value->cod_inventario_precio && $value->cod_inventario_precio == $value->cod_inventario && $value->cod_precio == $value->cod_precio_precio) {
            
                        if ($value->cod_inventario == $security[0] && $value->cod_establecimiento_local == $security[1]) {
                            array_push($hola, $value);
                        }
      
                    }
                }


                    $data = array_slice($hola, $start, $length);
              
             
                    
                    $recordsFiltered = $totalData;
             


                //VERIFICAMOS SI LA VARIABLE DATA VIENE VACIA
                if (empty($data) || $data == "Not Found") {
                    echo '{"data": []}';
                    return;
                }

                //CONSTRUCCION DEL JSON QUE SE ENVIARA
                $dataJson = '{
                "Draw": ' . intval($draw) . ',
                "recordsTotal": ' . $totalData . ',
                "recordsFiltered": ' . $recordsFiltered . ',
                "data": [';

                //RECORREMOS CADA POSICION DEL JSON QUE VIENE EN LA VARIABLE $data
                foreach ($data as $key => $value) {

          


                

            

                    $cod_precio = $value->cod_precio;
                    $txt_descripcion = $value->txt_descripcion;
                    $val_costo = $value->val_costo;
                    $val_porcentaje_costo = $value->val_porcentaje_costo;
                    $val_precio = $value->val_precio;
                    $sts_iva = $value->sts_iva;
                   
                    $val_iva = $val_precio*1.12;
                    $val_precio_final = $val_precio+$val_iva;
                    $val_porcentaje_costo = $val_porcentaje_costo;
                    $val_precio = $val_precio;

                 

               
        

                    $actions = "<a href='itemsxestablecimiento/precio/" . base64_encode($value->cod_inventario . "~" . $value->cod_precio . "~". $value->cod_establecimiento_local . "~". $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                    <i class='fas fa-pencil-alt'></i>

                    </a> ";



                    $actions = TemplateController::htmlClean($actions);





                    $dataJson .= '{

                        "cod_precio":"' . $cod_precio . '",
                        "txt_descripcion":"' . $txt_descripcion . '",		
                        "val_costo":"' . $val_costo . '",		
                        "val_porcentaje_costo":"'.$val_porcentaje_costo.'",		
                        "val_precio":"' . $val_precio . '",		
                        "sts_iva":"' . $sts_iva . '",		
                        "val_iva":"' . $val_iva . '",		
                        "val_final":"' . $val_precio_final . '",
                        "actions":"'.$actions.'"
                        },';
                }

                $dataJson = substr($dataJson, 0, -1);
                $dataJson .= ']}';
                //FIN CONSTRUCCION DEL JSON QUE SE ENVIARA
                echo $dataJson;
                
            } else {
                echo '{"data":[]}';
                return;
            }
        }
    }
}





$data = new itemsxestablecimientoDataTableController();
$data->data();
