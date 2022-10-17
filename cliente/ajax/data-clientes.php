<?php

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class clientesDataTableController
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

            // $url = "ecmp_cliente?select=cod_empresa";
            $url = "ecmp_cliente?select=cod_empresa&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=fec_actualiza";

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
            $select = "num_id, cod_tipo_id, nom_apellido_rsocial, nom_persona_nombre, txt_direccion,num_telefono,txt_email,cod_precio";
            
            

            if (!empty($_POST['search']['value'])) {
               

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["num_id", "cod_tipo_id", "nom_apellido_rsocial", "nom_persona_nombre", "txt_direccion","num_telefono","txt_email","cod_precio"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_cliente?select=*"."&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length . "&orderAt=cod_empresa";

                        $data = CurlController::request($url, $method, $fields)->result;


                        if ($data == "Not Found") {
                            $data = array();
                            $recordsFiltered = count($data);
                        } else {
                            $data = $data;
                            $recordsFiltered = count($data);
                            break;
                        }
                    }
                } else {
                    echo '{"data":[]}';
                    return;
                }
            }else {
                
                //PREPARACION DE DATOS APLICANDO LAS VARIABLES DEL DATATABLE
                $url = "ecmp_cliente?select=*"."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
                $data = CurlController::request($url, $method, $fields)->result;
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
                        $actions = "<a href='clientes/edit/" . base64_encode($value->num_id . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-2'>

                            <i class='fas fa-pencil-alt'></i>

                            </a> 
                            
                            <a class='btn btn-danger btn-sm rounded-circle removeItem' idItem=" . base64_encode($value->num_id . "~" . $_GET["token"]) . " table='ecmp_cliente' column='num_id' page='clientes' cod_empresa='" . base64_encode($value->cod_empresa) . "'>

                            <i class='fas fa-trash-alt'></i>

                            </a>";

                        $actions = TemplateController::htmlClean($actions);
                    }

                    //ASIGANACION DE VALORES A VARIABLES
                    $num_id = $value->num_id;
                    $cod_tipo_id = $value->cod_tipo_id;
                    $nom_apellido_rsocial = $value->nom_apellido_rsocial;
                    $nom_persona_nombre = $value->nom_persona_nombre;
                    $txt_direccion = $value->txt_direccion;
                    $num_telefono = $value->num_telefono;
                    $txt_email = $value->txt_email;
                    $cod_precio = $value->cod_precio;
                    
                    $dataJson .= '{

                        "num_id":"'.$num_id.'",
                        "cod_tipo_id":"'.$cod_tipo_id.'",
                        "nom_apellido_rsocial":"'.$nom_apellido_rsocial.'",
                        "nom_persona_nombre":"'.$nom_persona_nombre.'",
                        "txt_direccion":"'.$txt_direccion.'",
                        "num_telefono":"'.$num_telefono.'",
                        "txt_email":"'.$txt_email.'",
                        "cod_precio":"'.$cod_precio.'",
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




$data = new clientesDataTableController();
$data->data();
