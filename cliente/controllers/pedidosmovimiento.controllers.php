<?php

require_once("../controllers/curl.controller.php");

class CreateController
{

    public $array;
    public $cod_empresa;
    public $num_id;
    public $num_pedido;
    public $nom_nombre_rsocial;
    public $token;
    public $fec_actualiza;
    // public $txt_descripcion;
    public $cod_usuario;




    public function dataCreate()
    {

        //ecmp_pedido
        /*
        SELECT TOP (1000) [cod_empresa]
      ,[num_pedido]
      ,[num_id]
      ,[nom_nombre_rsocial]
      ,[fec_pedido]
      ,[cod_establecimiento]
      ,[cod_punto_emision]
      ,[num_factura]
      ,[sts_pedido]
      ,[cod_usuario]
      ,[fec_actualiza]
  FROM [PECMP_JPEREZ].[dbo].[ecmp_pedido] 
        */
        $data = array(
            "cod_empresa" => trim($this->cod_empresa),
            "num_id" => trim($this->num_id),
            "num_pedido" => trim($this->num_pedido),
            "nom_nombre_rsocial" => trim($this->nom_nombre_rsocial),
            "fec_pedido" => trim($this->fec_actualiza),  
            "cod_establecimiento" => NULL,
            "cod_punto_emision" => NULL,
            "num_factura" => NULL,
            "sts_pedido" => "A",
            "cod_usuario" => trim($this->cod_usuario),
            "fec_actualiza" => trim($this->fec_actualiza)

        );
        //  echo '<pre>'; print_r($data); echo '</pre>';
        $url = "ecmp_pedido?token=" . $this->token;
        // echo '<pre>'; print_r($url); echo '</pre>';
        
        $method = "post";
        $fields = $data; 
        $response = CurlController::request($url,$method,$fields);
        
        
//ecmp_detalle_pedido
/*
SELECT TOP (1000) [cod_empresa]
      ,[num_pedido]
      ,[num_detalle]
      ,[cod_inventario]
      ,[txt_descripcion]
      ,[val_cantidad]
      ,[val_unitario]
      ,[val_porcentaje_iva]
  FROM [PECMP_JPEREZ].[dbo].[ecmp_detalle_pedido]
*/

        $variable = $this->array;
        foreach ($variable as $key => $value) {
            $arrexp = explode(",", $value);
            // echo '<pre>';
            // print_r($arrexp);
            // echo '</pre>';
            $data1 = array(



                "cod_empresa" => trim($this->cod_empresa),
                "num_pedido" => trim($this->num_pedido),
                "num_detalle" => trim($this->num_pedido),
                "cod_inventario" => trim($arrexp[0]),
                "txt_descripcion" => trim($arrexp[1]),
                "val_cantidad" => trim($arrexp[2]),
                "val_unitario" => trim($arrexp[3]),
                "val_porcentaje_iva" => "12.00"

            );
            // echo '<pre>';
            // print_r($data1);
            // echo '</pre>';
            $url = "ecmp_detalle_pedido?token=".$this->token;
            $method = "POST";
            $fields = $data1;
            $response = CurlController::request($url,$method,$fields);
            // echo '<pre>'; print_r( $response); echo '</pre>';
        }

       
        if($response == null){
            echo "400";
        }else{
            echo $response->status;

        }
    }
}


if (isset($_POST["num_id"])) {


    $validate = new CreateController();

    $validate->array = $_POST["array"];

    $validate->cod_empresa = $_POST["cod_empresa"];
    $validate->num_id = $_POST["num_id"];
    $validate->token = $_POST["token"];
    $validate->num_pedido = $_POST["num_pedido"];
    $validate->nom_nombre_rsocial = $_POST["nom_nombre_rsocial"];
    $validate->fec_actualiza = $_POST["fec_actualiza"];
    // $validate->txt_descripcion = $_POST["txt_descripcion"];
    $validate->cod_usuario = $_POST["cod_usuario"];

    $validate->dataCreate();
}
