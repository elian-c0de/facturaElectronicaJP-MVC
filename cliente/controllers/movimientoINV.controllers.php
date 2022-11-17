<?php

require_once ("../controllers/curl.controller.php");

class CreateController{

   public $array;
   
   public $cod_empresa;
   public $cod_establecimiento;
   public $num_documento;
   public $cod_documento;
   public $token;
   public $fec_actualiza;
   public $txt_descripcion;
   public $cod_usuario;
   
    
 

    public function dataCreate(){
        // $variable = $this->array;
        // foreach ($variable as $key => $value) {
        //     list($valor1, $valor2, $valor3, $valor4, $valor5, $valor6, $valor7) = $variable;
        // echo "Valor1=$value Valor2=$value Valor3=$value Valor4=$value Valor5=$value Valor6=$value Valor7=$value";
        // return;
             
        // }
        
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
            
            echo '<pre>'; print_r( $data ); echo '</pre>';

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


if(isset($_POST["cod_establecimiento"])){
    

$validate = new CreateController();

 $validate -> array = $_POST["array"];

 $validate -> cod_empresa = $_POST["cod_empresa"];
 $validate -> cod_establecimiento = $_POST["cod_establecimiento"];
 $validate -> token = $_POST["token"];
 $validate -> num_documento = $_POST["num_documento"];
 $validate -> cod_documento = $_POST["cod_documento"];
 $validate -> fec_actualiza = $_POST["fec_actualiza"];
 $validate -> txt_descripcion = $_POST["txt_descripcion"];
 $validate -> cod_usuario = $_POST["cod_usuario"];

 $validate->dataCreate();

}
