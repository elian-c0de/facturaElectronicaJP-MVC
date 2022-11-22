<?php

require_once("../controllers/curl.controller.php");

class CreateController
{

    public $array;

    public $cod_empresa;
    public $cod_establecimiento;
    public $num_documento;
    public $cod_documento;
    public $token;
    public $fec_actualiza;
    public $txt_descripcion;
    public $cod_usuario;




    public function dataCreate()
    {

        $variable = $this->array;
        // //saco el numero de elementos
        // $longitud = count($variable);

        // //Recorro todos los elementos
        // for ($i = 0; $i < $longitud; $i++) {
        //     //saco el valor de cada elemento
        //     // echo $variable[$i];
        //     echo '<pre>'; print_r($variable[$i]); echo '</pre>';

        // }
        // return;
        $array = [];
        foreach ($variable as $key => $value) {
            $arrexp = explode(",", $value);
            // echo '<pre>';
            // print_r($arrexp);
            // echo '</pre>';
            $data1 = array(



                "cod_empresa" => trim($this->cod_empresa),
                "cod_establecimiento" => trim($this->cod_establecimiento),
                "num_documento" => trim($this->num_documento),
                "cod_inventario" => trim($arrexp[0]),
                "qtx_cantidad" => trim($arrexp[2]),
                "val_costo" => trim($arrexp[3]),
                "val_porcentaje_iva" => "12.00"

            );
            // echo '<pre>';
            // print_r($data1);
            // echo '</pre>';
            $url = "ecmp_detalle_inventario?token=".$this->token;
            $method = "POST";
            $fields = $data1;
            $response = CurlController::request($url, $method, $fields);
             echo '<pre>'; print_r($response); echo '</pre>';
        }

        $data = array(


            "cod_empresa" => trim($this->cod_empresa),
            "cod_establecimiento" => trim($this->cod_establecimiento),
            "num_documento" => trim($this->num_documento),
            "cod_documento" => trim($this->cod_documento),
            "fec_documento" => trim($this->fec_actualiza),
            "txt_observacion" => trim($this->txt_descripcion),
            "cod_usuario" => trim($this->cod_usuario),
            "fec_actualiza" => trim($this->fec_actualiza),
            "sts_cabecera_inventario" => "A"

        );

        $url = "ecmp_cabecera_inventario?token=".$this->token;
        $method = "POST";
        $fields = $data;
        $response = CurlController::request($url, $method, $fields);
        if($response == null){
            echo "400";
        }else{
            echo $response->status;

        }
    }
}


if (isset($_POST["cod_establecimiento"])) {


    $validate = new CreateController();

    $validate->array = $_POST["array"];

    $validate->cod_empresa = $_POST["cod_empresa"];
    $validate->cod_establecimiento = $_POST["cod_establecimiento"];
    $validate->token = $_POST["token"];
    $validate->num_documento = $_POST["num_documento"];
    $validate->cod_documento = $_POST["cod_documento"];
    $validate->fec_actualiza = $_POST["fec_actualiza"];
    $validate->txt_descripcion = $_POST["txt_descripcion"];
    $validate->cod_usuario = $_POST["cod_usuario"];

    $validate->dataCreate();
}
