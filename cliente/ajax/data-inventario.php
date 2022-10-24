<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class inventarioDataTableController
{

    public function data()
    {
        //PREGUNTAMOS SI SE ENVIO DATOS 
        if (!empty($_POST)) {
            


            //CAPTURA Y ORGANIZACION DE VARIABLES ENVIADAS DE DATATABLE POR EL METODO POST
            $draw = $_POST["draw"];
            $orderByColumnIndex = $_POST['order'][0]['column'];
            $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];
            $orderType = $_POST['order'][0]['dir'];
            $start = $_POST["start"];
            $length = $_POST["length"];


            //PREPARAMOS PARAMETROS QUE SE LE ENVIARAN A LA API

            //RECOLECTAMOS TODOS LOS DATOS QUE EXISTEN EN UN RANGO DE FECHA QUE TENGA EL CODIGO COD EMPRESA
            $url = "ecmp_inventario?select=*&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=fec_actualiza&filterTo=cod_empresa&inTo=".$_GET["code"];
            $method = "GET";
            $fields = array();

            //ENVIAMOS PARAMETOS A LA API
            $response = CurlController::request($url, $method, $fields);
    

            //VALIDAMOS QUE LA RESPUESTA DE LA API SEA 200 CASO CONTRARIO SE APLICARA UN RETURN DEVOLVIENDO UN JSON VACIO
            if ($response->status == 200) {
                $totalData = $response->total;
            } else {
                echo '{"data":[]}';
                return;
            }
       

            //BUSQUEDAD DE LA TABLA
            $select = "ecmp_inventario.cod_empresa,ecmp_linea.cod_empresa%20as%20cod_empresa_linea,ecmp_inventario.cod_inventario,cod_barras,ecmp_inventario.txt_descripcion,ecmp_linea.txt_descripcion%20as%20lineasublinea,ecmp_inventario.sts_iva,ecmp_inventario.sts_tipo,ecmp_inventario.qtx_saldo,ecmp_inventario.val_costo,ecmp_inventario.cod_sublinea%20as%20cod_sublinea_inventario,ecmp_inventario.cod_linea%20as%20cod_linea_inventario,ecmp_linea.cod_sublinea%20as%20cod_sublinea_linea,ecmp_linea.cod_linea%20as%20cod_linea_linea,ecmp_inventario.cod_marca,ecmp_inventario.sts_inventario";
            $rel= "ecmp_inventario,ecmp_linea";
            $type = "cod_empresa,cod_empresa";
            $hola = array();
            // BUSCADOR 
            if (!empty($_POST['search']['value'])) {
               

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["ecmp_inventario.cod_inventario", "ecmp_inventario.txt_descripcion"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "relations?select=".$select."&orderMode=".$orderType."&orderBy=".$orderBy."&rel=".$rel."&type=".$type."&linkTo=".$value."&search=".$search;
                        $data = CurlController::request($url, $method, $fields)->result;
                     

           

                     

                        if ($data == "Not Found") {
                            $data = array();
                            $recordsFiltered = count($data);
                        } else {


                            foreach ($data as $key1 => $value1) {
                                if ($value1->cod_empresa == $_GET["code"] && $value1->cod_sublinea_inventario == $value1->cod_sublinea_linea && $value1->cod_linea_inventario == $value1->cod_linea_linea){
                                    array_push($hola,$value1);
                                   }
                            }
            
            
                            $data = array_slice($hola,$start,$length);

                            $recordsFiltered = count($data);
                            break;
                        }
                    }
                } else {
                    echo '{"data":[]}';
                    return;
                }
            }else{
            // FIN BUSCADOR
                
             
          
                
                $url = "relations?rel=".$rel."&type=".$type."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=ecmp_inventario.fec_actualiza"."&orderBy=".$orderBy."&orderMode=".$orderType."&select=".$select;
                // $url = "ecmp_cliente?select=*"."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
                $data = CurlController::request($url, $method, $fields)->result;


         


                foreach ($data as $key1 => $value1) {
                    if ($value1->cod_empresa == $_GET["code"] && $value1->cod_sublinea_inventario == $value1->cod_sublinea_linea && $value1->cod_linea_inventario == $value1->cod_linea_linea){
                        array_push($hola,$value1);
                        
                       }
                }

                // foreach ($hola as $key => $value) {
                //     if($key > $start ){
                       
                //         if($length >= $key){
                //             array_push($hola2,$value); 
                //         }
                //     }
                // }

                 

                $data = array_slice($hola,$start,$length);
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
                    }else{
                        $actions = "<a href='inventario/edit/" . base64_encode($value->cod_inventario . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                            <i class='fas fa-pencil-alt'></i>

                            </a> 
                            
                            <a class='btn btn-danger btn-sm rounded-circle removeItem' idItem=" . base64_encode($value->cod_inventario . "~" . $_GET["token"]) . " table='ecmp_inventario' column='cod_inventario' page='inventario' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                            <i class='fas fa-trash-alt'></i>


                            </a>";

                        $actions = TemplateController::htmlClean($actions);
                    }

                    //checkbox control de checked
                    if ($value->sts_iva == "A") {
                        $checked = "checked";
                    }else{
                        $checked = "";
                    }

                       //checkbox control de checked
                    if ($value->sts_inventario == "A") {
                        $checked1 = "checked";
                    }else{
                        $checked1 = "";
                    }

                    if($value->sts_tipo == "S"){
                        $sts_tipo = "SERVICIOS";
                    }

                    if($value->sts_tipo == "B"){
                        $sts_tipo = "BIENES";
                    }

                    // $button = "<input type='checkbox' class='stsiva' val='".$value->sts_iva."'  $checked idItem='".base64_encode($value->cod_inventario . "~" . $_GET["token"])."' cod_empresa='" . base64_encode($value->cod_empresa. "~" . $_GET["token"])."' table = 'ecmp_inventario' column = 'cod_inventario' page='inventario' >";
                    // $button2 = "<input type='checkbox' class='stsinventario' val='".$value->sts_inventario."'  $checked1 idItem='".base64_encode($value->cod_inventario . "~" . $_GET["token"])."' cod_empresa='" . base64_encode($value->cod_empresa. "~" . $_GET["token"])."' table = 'ecmp_inventario' column = 'cod_inventario' page='inventario' >";
                


                 

                    //ASIGANACION DE VALORES A VARIABLES
                    $cod_inventario= $value->cod_inventario;
                    $cod_barras= $value->cod_barras;
                    $txt_descripcion= $value->txt_descripcion;
                    $sts_iva= $value->sts_iva;
                    // $sts_tipo= $value->sts_tipo;
                    $qtx_saldo= $value->qtx_saldo;
                    $val_costo= $value->val_costo;
                    $cod_linea_sublinea= $value->lineasublinea;
                    $cod_marca= $value->cod_marca;
                    $sts_inventario= $value->sts_inventario;
                


                    
                    $dataJson .= '{

                        "cod_inventario":"'.$cod_inventario.'",
                        "cod_barras":"'.$cod_barras.'",		
                        "txt_descripcion":"'.$txt_descripcion.'",		
                        "sts_iva":"'.$sts_iva.'",		
                        "sts_tipo":"'.$sts_tipo.'",		
                        "qtx_saldo":"'.$qtx_saldo.'",		
                        "val_costo":"'.$val_costo.'",		
                        "cod_linea_sublinea":"'.$cod_linea_sublinea.'",
                        "cod_marca":"'.$cod_marca.'",		
                        "sts_inventario":"'.$sts_inventario.'",
                        "actions":"'.$actions.'"	
                        },';
                }

            $dataJson = substr($dataJson, 0, -1);
            $dataJson .= ']}';
            //FIN CONSTRUCCION DEL JSON QUE SE ENVIARA

            echo $dataJson;
        }
    }
}




$data = new inventarioDataTableController();
$data->data();
