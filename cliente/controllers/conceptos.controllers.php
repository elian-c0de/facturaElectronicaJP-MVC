<?php
class ConceptosController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_concepto"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "loading...", "");

            </script>';

            if(preg_match('/^[a-zA-Z0-9]{1,2}$/',$_POST["cod_concepto"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))

            {
                if(isset($_POST["sts_facturacion"])){
                    $_POST["sts_facturacion"] = "S";
                }else{
                    $_POST["sts_facturacion"] = "N";
                }

                if(isset($_POST["sts_inventario"])){
                    $_POST["sts_inventario"] = "A";
                }else{
                    $_POST["sts_inventario"] = "C";
                }

                if(isset($_POST["sts_concepto"])){
                    $_POST["sts_concepto"] = "A";
                }else{
                    $_POST["sts_concepto"] = "C";
                }

                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_concepto" => trim($_POST["cod_concepto"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "sts_facturacion" => $_POST["sts_facturacion"],
                    "sts_tipo_concepto" => $_POST["sts_tipo_concepto"],
                    "sts_sistema" => "C",
                    "sts_proceso" => $_POST["sts_proceso"],
                    "sts_inventario" => $_POST["sts_inventario"],
                    "sts_concepto" => $_POST["sts_concepto"],
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("d-m-Y H:i:s"),
                    "cod_sri" => "sri1",
    
                );
                

         
                $url = "srja_concepto?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Registro con éxito", "conceptos");

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


    public function conceptos(){
        $url = "srja_concepto";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id){

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){

            $url = "srja_concepto?linkTo=cod_empresa,cod_concepto&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))
    
                {
                    
                    if(isset($_POST["sts_facturacion"])){
                        $_POST["sts_facturacion"] = "S";
                    }else{
                        $_POST["sts_facturacion"] = "N";
                    }
    
                    if(isset($_POST["sts_inventario"])){
                        $_POST["sts_inventario"] = "A";
                    }else{
                        $_POST["sts_inventario"] = "C";
                    }
    
                    if(isset($_POST["sts_concepto"])){
                        $_POST["sts_concepto"] = "A";
                    }else{
                        $_POST["sts_concepto"] = "C";
                    }
                    
                        $data =
                            "txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&sts_facturacion=".trim($_POST["sts_facturacion"]).
                            "&sts_tipo_concepto=".trim($_POST["sts_tipo_concepto"]).
                            "&sts_proceso=".trim($_POST["sts_proceso"]).
                            "&sts_inventario=".trim($_POST["sts_inventario"]).
                            "&sts_concepto=".trim($_POST["sts_concepto"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("d-m-Y H:i:s").
                            "&cod_sri="."sri1";
            
                    
                     
                
                    $url = "srja_concepto?id=".$id."&nameId=cod_concepto&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con éxito", "conceptos");

                    </script>';
                    }else{
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error al editar el registro");

                    </script>';
                    }

    
                }else{
                    echo '<script>

                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncNotie(3, "Error en los campos ingresados");

                </script>';
                }

            }else{
                echo '<script>

                fncFormatInputs();
                matPreloader("off");
                fncSweetAlert("close", "", "");
                fncNotie(3, "Error en el sistema");

            </script>';
            }

          }else{

            echo '<script>

            fncFormatInputs();
            matPreloader("off");
            fncSweetAlert("close", "", "");
            fncNotie(3, "Error en el sistema");

        </script>';
            
          }
            
        }

  
    }

}
