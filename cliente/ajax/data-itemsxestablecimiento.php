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
                $select = "ecmp_item_local.cod_establecimiento,ecmp_inventario.cod_empresa,ecmp_inventario.cod_inventario,ecmp_inventario.txt_descripcion,ecmp_item_local.sts_control_saldo,ecmp_item_local.sts_modifica_precio,ecmp_item_local.qtx_minimo,ecmp_item_local.qtx_maximo,ecmp_item_local.qtx_saldo,ecmp_inventario.val_costo,ecmp_item_local.val_descuento,ecmp_item_local.por_descuento,ecmp_item_local.sts_item_local,ecmp_item_local.cod_inventario%20as%20cod_inventario_local";
                $rel = "ecmp_inventario,ecmp_item_local";
                $type = "cod_empresa,cod_empresa";
                

                // $url = "ecmp_item_local?select=*&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=fec_actualiza";
                $url = "relations?rel=" . $rel . "&type=" . $type . "&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=ecmp_inventario.fec_actualiza&orderBy=ecmp_inventario&select=" . $select;
      
                $method = "GET";
                $fields = array();
                $response = CurlController::request($url, $method, $fields);
              
             
            





                //VALIDAMOS QUE LA RESPUESTA DE LA API SEA 200 CASO CONTRARIO SE APLICARA UN RETURN DEVOLVIENDO UN JSON VACIO
                if ($response->status == 200) {
                    foreach ($response->result as $key => $value) {
            
                        if ($value->cod_inventario == $value->cod_inventario_local && $value->cod_empresa == $_GET["code"]  && $value->cod_establecimiento == $_GET["establecimiento"]) {
                
                            array_push($index, $value);
                            
                            
                        }
                    }

                 
                    $totalData = count($index);
                } else {
                    echo '{"data":[]}';
                    return;
                }


                //BUSQUEDAD DE LA TABLA

                $buscar = array();
                // BUSCADOR 
                if (!empty($_POST['search']['value'])) {


                    if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                        $linkTo = ["ecmp_inventario.cod_inventario", "ecmp_inventario.txt_descripcion"];
                        $search = str_replace(" ", "_", $_POST['search']['value']);
                        foreach ($linkTo as $key => $value) {
                            $url = "relations?select=" . $select . "&orderMode=" . $orderType . "&orderBy=" . $orderBy . "&rel=" . $rel . "&type=" . $type . "&linkTo=" . $value . "&search=" . $search;
                            $data = CurlController::request($url, $method, $fields)->result;




                            if ($data == "Not Found") {
                                $data = array();
                                $recordsFiltered = count($data);
                            } else {



                                foreach ($data as $key2 => $value2) {
                                    if ($value2->cod_inventario == $value2->cod_inventario_local && $value2->cod_empresa == $_GET["code"] && $value2->cod_inventario == $_GET["establecimiento"]) {
                                        array_push($buscar, $value2);
                                    }
                                }

                                $data = array_slice($buscar, $start, $length);
                                $recordsFiltered = count($data);
                                break;
                            }
                        }
                    } else {
                        echo '{"data":[]}';
                        return;
                    }
                } else {
                    // FIN BUSCADOR







                    $url = "relations?rel=" . $rel . "&type=" . $type . "&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=ecmp_inventario.fec_actualiza&orderBy=ecmp_inventario." . $orderBy . "&orderMode=" . $orderType . "&select=" . $select;


                    $data = CurlController::request($url, $method, $fields)->result;



                    foreach ($data as $key1 => $value1) {


                   
                            if ($value1->cod_inventario == $value1->cod_inventario_local && $value1->cod_empresa == $_GET["code"]  && $value1->cod_establecimiento == $_GET["establecimiento"]) {
                                array_push($hola, $value1);
                             
                             
                            }

                    }

                    $data = array_slice($hola, $start, $length);


                    $recordsFiltered = $totalData;
                }

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

                    //PREGUNTAMOS SI VIENE UNA VARIABLE FLAT LA CUAL NOS APLICARA UNA CONDICIONAL PARA MOSTRAR O NO ALGUNOS BOTONES
                    if ($_GET["text"] == "flat") {
                        $actions = "";
                    } else {
                        $actions = "<a href='itemsxestablecimiento/edit/" . base64_encode($value->cod_inventario . "~" .$value->cod_establecimiento . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                            <i class='fas fa-pencil-alt'></i>

                            </a> 
                            
                            <a class='btn btn-success btn-sm rounded-circle removeItem' idItem=" . base64_encode($value->cod_inventario . "~" .$value->cod_establecimiento . "~" . $_GET["token"]) . " table='ecmp_cliente' column='num_id' page='clientes' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                            <i class='fas fa-trash-alt'></i>

                            </a>
                            
                            <a class='btn btn-danger btn-sm rounded-circle removeItem2ids' idItem=" .  base64_encode($value->cod_inventario . "~" .$value->cod_establecimiento . "~" . $_GET["token"]) . " table='ecmp_item_local' column='cod_inventario' column='cod_establecimiento' page='itemsxestablecimieto' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                            <i class='fa-solid fa-dollar-sign'></i>


                            </a>";

                        $actions = TemplateController::htmlClean($actions);
                    }


                    //ASIGANACION DE VALORES A VARIABLES


                    $cod_inventario = $value->cod_inventario;
                    $txt_descripcion = $value->txt_descripcion;
                    $sts_control_saldo = $value->sts_control_saldo;
                    $sts_modifica_precio = $value->sts_modifica_precio;
                    $qtx_minimo = $value->qtx_minimo;
                    $qtx_maximo = $value->qtx_maximo;
                    $qtx_saldo = $value->qtx_saldo;
                    $val_costo = $value->val_costo;
                    $val_descuento = $value->val_descuento;
                    $por_descuento = $value->por_descuento;
                    $sts_item_local = $value->sts_item_local;





                    $dataJson .= '{

                        "cod_inventario":"' . $cod_inventario . '",
                        "txt_descripcion":"' . $txt_descripcion . '",		
                        "sts_control_saldo":"' . $sts_control_saldo . '",		
                        "sts_modifica_precio":"' . $sts_modifica_precio . '",		
                        "qtx_minimo":"' . $qtx_minimo . '",		
                        "qtx_maximo":"' . $qtx_maximo . '",		
                        "qtx_saldo":"' . $qtx_saldo . '",		
                        "val_costo":"' . $val_costo . '",
                        "val_descuento":"' . $val_descuento . '",		
                        "por_descuento":"' . $por_descuento . '",
                        "sts_item_local":"' . $sts_item_local . '",
                        "actions":"' . $actions . '"	

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
