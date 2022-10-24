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
            $url = "ecmp_inventario?linkTo=cod_empresa&equalTo=".$_GET["code"];
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
            // BUSCADOR 
            if (!empty($_POST['search']['value'])) {
               

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["cod_inventario", "txt_descripcion"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {

               
                        $url = "ecmp_inventario?select=*"."&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType;

                        $data = CurlController::request($url, $method, $fields)->result;
                     

           

                     

                        if ($data == "Not Found") {
                            $data = array();
                            $recordsFiltered = count($data);
                        } else {


                            foreach ($data as $key1 => $value1) {
                                if ($value1->cod_empresa == $_GET["code"]){
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
                
             
          
                $url = "ecmp_inventario?select=*&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa&linkTo=cod_empresa&equalTo=".$_GET["code"];

                // $url = "ecmp_cliente?select=*"."&orderBy=".$orderBy."&orderMode=".$orderType."&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&linkTo=fec_actualiza&startAt=".$start."&endAt=".$length."&orderAt=cod_empresa";
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

              
                foreach ($data as $key => $value) {

                  

              


                 

                    //ASIGANACION DE VALORES A VARIABLES
                    $cod_inventario= $value->cod_inventario;
                    $txt_descripcion= $value->txt_descripcion;
                                              $qtx_saldo= $value->qtx_saldo;
                    $val_costo= $value->val_costo;
                    $sts_inventario= $value->sts_inventario;




                $dataJson .= '{

                        "cod_inventario":"' . $cod_inventario . '",
                    	"txt_descripcion":"' . $txt_descripcion . '",		
                 	    "qtx_saldo":"' . $qtx_saldo . '",		
                        "val_costo":"' . $val_costo . '",		          		
                        "sts_inventario":"' . $sts_inventario . '"
               	
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
