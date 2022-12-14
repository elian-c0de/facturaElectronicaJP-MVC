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
            $url = "ecmp_cliente?select=*&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&linkTo=fec_actualiza&filterTo=cod_empresa&inTo=".$_GET["code"];
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
       

            $hola = array();
            
            //BUSQUEDAD DE LA TABLA
            if (!empty($_POST['search']['value'])) {
               

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["num_id", "cod_tipo_id", "nom_apellido_rsocial", "nom_persona_nombre", "txt_direccion","num_telefono","txt_email"];
                    
                    $search = str_replace(" ", "_", $_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

                        $url = "ecmp_cliente?select=*"."&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length . "&orderAt=cod_empresa";
                        $data = CurlController::request($url, $method, $fields)->result;



                   

                        if ($data == "Not Found") {
                            $data = array();
                            $recordsFiltered = count($data);
                        } else {
                            //FOREACH PARA RECORRER LOS DATOS OBETNIDOS DE LA API Y FILTRAR QUE COINCIDAN CON EL CODIGO DE EMPRESA
                            foreach ($data as $key1 => $value1) {
                                if ($value1->cod_empresa == $_GET["code"]) {
                                 array_push($hola,$value1);
                                }
                             }

                            $data = $hola;
                            $recordsFiltered = count($data);
                            break;
                        }
                    }
                } else {
                    echo '{"data":[]}';
                    return;
                }
            }else{
                
                //CONSULTA CON RANGOS Y FILTROS
                $url = "ecmp_cliente?select=*"."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa&filterTo=cod_empresa&inTo=".$_GET["code"];
                $data = CurlController::request($url, $method, $fields)->result;
             
                
                if($data == "Not Found"){
                    $recordsFiltered = 0;
                }else{
                    $recordsFiltered = $totalData;
                }
                
      
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
                        "txt_direccion":"'.$txt_direccion.'",
                        "num_telefono":"'.$num_telefono.'",
                        "txt_email":"'.$txt_email.'"
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
