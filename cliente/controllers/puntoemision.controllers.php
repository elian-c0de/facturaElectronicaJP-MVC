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
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("d-m-Y H:i:s"),
                    // "cod_caja" => trim($_POST["cod_caja"]),
                    // "num_factura" => trim($_POST["num_factura"]),
                    // "num_nota_credito" => trim($_POST["num_nota_credito"]),
                    // "sts_tipo_facturacion" => $_POST["sts_tipo_facturacion"],
                    // "sts_impresion" => $_POST["sts_impresion"],
                    // "num_factura_prueba" => trim($_POST["num_factura_prueba"]),
                    // "num_nota_credito_prueba" => trim($_POST["num_nota_credito_prueba"]),
                    // "sts_tipo_emision" => $_POST["sts_tipo_emision"],
                    // "num_retencion" => trim($_POST["num_retencion"]),
                    // "num_retencion_prueba" => trim($_POST["num_retencion_prueba"]),
                    // "num_guia" => trim($_POST["num_guia"],)
                    // "num_guia_prueba" => trim($_POST["num_guia_prueba"])
                );
                // echo '<pre>'; print_r($data); echo '</pre>';
                // return;

         
                $url = "gen_punto_emision?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                // echo '<pre>'; print_r($response); echo '</pre>';
                // return;
              


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
        $url = "gen_local?linkTo=cod_empresa&equalTo=".$_SESSION["admin"]->cod_empresa;
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
        
        if(isset($_POST["idAdmin"]) && isset($_POST["idAdmin2"])){

            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
          if($id == $_POST["idAdmin"] && $id2 == $_POST["idAdmin2"]){

            $url = "gen_punto_emision?linkTo=cod_empresa,cod_establecimiento,cod_punto_emision&equalTo=".$_SESSION['admin']->cod_empresa.",".$id.",".$id2;
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url,$method,$fields);

            if($response->status == 200){
                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))
                {
                    $data = "&txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("d-m-Y H:i:s");
                    $url = "gen_punto_emision?id=".$id."&nameId=cod_establecimiento&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_sublinea&id3=".$id2;
                    $method = "PUT";
                    $fields = $data;
                    $response = CurlController::request($url,$method,$fields);

                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "lineasdeproducto");

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
