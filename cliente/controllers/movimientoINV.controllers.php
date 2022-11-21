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
        foreach ($variable as $variable => $value) {
            // $var = $value;
            // echo '</pre>';
            // print_r($var);
            // echo '</pre>';
            //echo "   {$value} ";
            // $array['cod_inventario'] = $value;
            $arrexp = explode(",", $value);

            //ELIMINAMOS EL UTLIMO CAMPO DEL ARRAY PORQUE MOSTRABA VACIO
            $eliminacionUltimocampoVacio = array_pop($arrexp);

                if (is_array ($arrexp))
                {
                    
                    foreach ($arrexp as $variable2=>$value2)
                    {
                        
                        echo "Llave final: ".$variable2. " Valor final: ".$value2."\n";
                    }  
                        echo "\n";
            
            
                }else{
                    echo "Llave: ".$variable. " Valor: ".$value."\n";
                }
            

           
            // $arrexp = explode(",", str_replace($clave.',', '', $value));
            //list($Codigo, $Descripcion, $Cantidad,$Costo,$Subtotal,$IVA,$Total) = $arrexp;

            // echo "ARRAY:  CODIGO:$Codigo DESCRIPCIO:$Descripcion CATIDAD: $Cantidad COSTO:$Costo SUBTOTAL:$Subtotal IVA:$IVA TOTAL:$Total <br>";
            // $arrexp = explode(",", str_replace($clave.',', '', $value));
            //unset($arrexp[$value[8]]);

            // var_dump( $arrexp);
            // print_r($variable);


            // for ($i=0; $i < $clave; $i++) { 
            //     echo "{$clave} => {$value} ";
            // }

        }

        return;

        // $data1 = array(


        //     "cod_empresa" => $_SESSION["admin"]->cod_empresa,
        //     "cod_establecimiento" => trim($variable[1]),
        //     "num_documento" => trim($variable[2]),
        //     "cod_inventario" => $variable[3],
        //     "qtx_cantidad" => trim($variable[4]),
        //     "val_costo" => trim($variable[5]),
        //     "val_porcentaje_iva" => "12.00"

        // );
        // echo '<pre>'; print_r($data1); echo '</pre>';
        // return;

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

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        //  $url = "ecmp_detalle_inventario?token=".$this->token;
        //  $method = "POST";
        //  $fields = $data;
        //  $response = CurlController::request($url,$method,$fields);



        //     if($response == null){
        //         echo "400";
        //     }else{
        //         echo $response->status;

        //     }

        // }else{
        //     echo 404;
        // }



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
