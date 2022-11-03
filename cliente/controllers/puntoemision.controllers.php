<?php
class PuntoemisionController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_establecimiento"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

            if(preg_match('/^[a-zA-Z0-9]{1,3}$/',$_POST["cod_establecimiento"]) &&
            preg_match('/^[a-zA-Z0-9]{1,3}$/',$_POST["cod_punto_emision"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))

            {
                if(isset($_POST["sts_ambiente"])){
                    $_POST["sts_ambiente"] = "1";
                }else{
                    $_POST["sts_ambiente"] = "2";
                }

                if(isset($_POST["sts_punto_emsion"])){
                    $_POST["sts_punto_emsion"] = "A";
                }else{
                    $_POST["sts_punto_emsion"] = "C";
                    
                }
                if(isset($_POST["sts_tipo_facturacion"])){
                    $_POST["sts_tipo_facturacion"] = "E";
                }else{
                    $_POST["sts_tipo_facturacion"] = "F";
                    
                }
                if(isset($_POST["sts_impresion"])){
                    $_POST["sts_impresion"] = "R";
                }else{
                    $_POST["sts_impresion"] = "F";
                    
                }
                if(isset($_POST["sts_tipo_emision"])){
                    $_POST["sts_tipo_emision"] = "1";
                }else{
                    $_POST["sts_tipo_emision"] = "2";
                    
                }

                $data = array(
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_establecimiento" => trim($_POST["cod_establecimiento"]),
                    "cod_punto_emision" => trim($_POST["cod_punto_emision"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "sts_ambiente" => $_POST["sts_ambiente"],
                    "sts_punto_emsion" => $_POST["sts_punto_emsion"],
                    "cod_usuario" => trim($_SESSION["admin"]->cod_usuario),
                    "fec_actualiza" => date("d-m-Y H:i:s")
                );
                    
                    if($_POST["cod_caja"]!=""){
                        $data["cod_caja"] = trim($_POST["cod_caja"]);
                    }
                    if($_POST["num_factura"]!=""){
                        $data["num_factura"] = trim($_POST["num_factura"]);
                    }
                    if($_POST["num_nota_credito"]!=""){
                        $data["num_nota_credito"] = trim($_POST["num_nota_credito"]);
                    }
                    if($_POST["sts_tipo_facturacion"]!=""){
                        $data["sts_tipo_facturacion"] = trim($_POST["sts_tipo_facturacion"]);
                    }
                    if($_POST["sts_impresion"]!=""){
                        $data["sts_impresion"] = trim($_POST["sts_impresion"]);
                    }
                    if($_POST["num_factura_prueba"]!=""){
                        $data["num_factura_prueba"] = trim($_POST["num_factura_prueba"]);
                    }
                    if($_POST["num_nota_credito_prueba"]!=""){
                        $data["num_nota_credito_prueba"] = trim($_POST["num_nota_credito_prueba"]);
                    }
                    if($_POST["sts_tipo_emision"]!=""){
                        $data["sts_tipo_emision"] = trim($_POST["sts_tipo_emision"]);
                    }
                    if($_POST["num_retencion"]!=""){
                        $data["num_retencion"] = trim($_POST["num_retencion"]);
                    }
                    if($_POST["num_retencion_prueba"]!=""){
                        $data["num_retencion_prueba"] = trim($_POST["num_retencion_prueba"]);
                    }
                    if($_POST["num_guia"]!=""){
                        $data["num_guia"] = trim($_POST["num_guia"]);
                    }
                    if($_POST["num_guia_prueba"]!=""){
                        $data["num_guia_prueba"] = trim($_POST["num_guia_prueba"]);
                    }
                    // echo '<pre>'; print_r($data); echo '</pre>';
                    // return;
                // echo '<pre>'; print_r($data); echo '</pre>';
         
                $url = "gen_punto_emision?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
              


                if($response->status == 200){
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Registro con exito", "puntosEmision");

                    </script>';
                }else{
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error al crear los datos");

                    </script>';
                }

    
            }else{
                echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error en el campo de datos");

                    </script>';
            }
        }

  
    }


    public function getListaEstablecimiento(){
        $url = "gen_local?linkTo=cod_empresa,sts_local&equalTo=".$_SESSION["admin"]->cod_empresa.",A";
        // echo '<pre>'; print_r(url); echo '</pre>';
        // return;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }

    public function getListaCajas(){
        $url = "srja_caja?linkTo=cod_empresa&equalTo=".$_SESSION["admin"]->cod_empresa;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id,$id2){

        date_default_timezone_set("America/Guayaquil");
        if(isset($_POST["idAdmin"]) && isset($_POST["idAdmin1"])){

            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
          if($id == $_POST["idAdmin"] && $id2 == $_POST["idAdmin1"]){

            $url = "gen_punto_emision?linkTo=cod_empresa,cod_establecimiento,cod_punto_emision&equalTo=".$_SESSION['admin']->cod_empresa.",".$id.",".$id2;
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url,$method,$fields);

            if($response->status == 200){
                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))
                {
                    if(isset($_POST["sts_ambiente"])){
                        $_POST["sts_ambiente"] = "1";
                    }else{
                        $_POST["sts_ambiente"] = "2";
                    }
    
                    if(isset($_POST["sts_punto_emsion"])){
                        $_POST["sts_punto_emsion"] = "A";
                    }else{
                        $_POST["sts_punto_emsion"] = "C";
                        
                    }
                    if(isset($_POST["sts_tipo_facturacion"])){
                        $_POST["sts_tipo_facturacion"] = "E";
                    }else{
                        $_POST["sts_tipo_facturacion"] = "F";
                        
                    }
                    if(isset($_POST["sts_impresion"])){
                        $_POST["sts_impresion"] = "R";
                    }else{
                        $_POST["sts_impresion"] = "F";
                        
                    }
                    if(isset($_POST["sts_tipo_emision"])){
                        $_POST["sts_tipo_emision"] = "1";
                    }else{
                        $_POST["sts_tipo_emision"] = "2";
                        
                    }

                    $data = "txt_descripcion=".trim($_POST["txt_descripcion"]).
                
                            "&sts_ambiente=".trim($_POST["sts_ambiente"]).
                            "&sts_punto_emsion=".trim($_POST["sts_punto_emsion"]).
                            "&cod_usuario=".trim($_SESSION["admin"]->cod_usuario).
                            "&fec_actualiza=".date("d-m-Y H:i:s").
                            "&cod_caja=".trim($_POST["cod_caja"]).
                            "&num_factura=".trim($_POST["num_factura"]).
                            "&sts_tipo_facturacion=".trim($_POST["sts_tipo_facturacion"]).
                            "&sts_impresion=".trim($_POST["sts_impresion"]).
                            "&num_factura_prueba=".trim($_POST["num_factura_prueba"]).
                            "&num_nota_credito_prueba=".trim($_POST["num_nota_credito_prueba"]).
                            "&sts_tipo_emision=".trim($_POST["sts_tipo_emision"]).
                            "&num_retencion=".trim($_POST["num_retencion"]).
                            "&num_retencion_prueba=".trim($_POST["num_retencion_prueba"]).
                            "&num_guia=".trim($_POST["num_guia"]).
                            "&num_guia_prueba=".trim($_POST["num_guia_prueba"]);
                    
                    //CODIGO PARA VALIDAR DATOS NULOS EN EDITAR
                    $f ="";
                    $perro = explode("&", $data);
                            foreach ($perro as $key => $value) {
                                $v = explode("=",$value);
                                if($v[1]!=""){
                                    $f.=$value."&";
                                }
                            }
                            $f=substr($f,0,-1);

                    $url = "gen_punto_emision?id=".$id."&nameId=cod_establecimiento&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_punto_emision&id3=".$id2;
                    $method = "PUT";
                    $fields = $f;
                    $response = CurlController::request($url,$method,$fields);

                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "puntosEmision");

                        </script>';
                    }else{
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error al momento de editar");

                        </script>';
                    }

    
                }else{
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error en los campos de datos");

                    </script>';
                }

            }else{
                echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error al editar el registro");

                    </script>';
            }
          }
        }
    }
}


// $data = "txt_descripcion=".trim($_POST["txt_descripcion"]).
//                             "&sts_ambiente=".trim($_POST["sts_ambiente"]).
//                             "&sts_punto_emsion=".trim($_POST["sts_punto_emsion"]).
//                             "&cod_usuario=".trim($_SESSION["admin"]->cod_usuario).
//                             "&fec_actualiza=".date("d-m-Y H:i:s").                            
//                             "&cod_caja=".trim($_POST["cod_caja"]).
//                             "&num_factura=".trim($_POST["num_factura"]).
//                             "&sts_tipo_facturacion=".trim($_POST["sts_tipo_facturacion"]).
//                             "&sts_impresion=".trim($_POST["sts_impresion"]).
//                             "&num_factura_prueba=".trim($_POST["num_factura_prueba"]).
//                             "&num_nota_credito_prueba=".trim($_POST["num_nota_credito_prueba"]).
//                             "&sts_tipo_emision=".trim($_POST["sts_tipo_emision"]).
//                             "&num_retencion=".trim($_POST["num_retencion"]).
//                             "&num_retencion_prueba=".trim($_POST["num_retencion_prueba"]).
//                             "&num_guia=".trim($_POST["num_guia"]).
//                             "&num_guia_prueba=".trim($_POST["num_guia_prueba"]);