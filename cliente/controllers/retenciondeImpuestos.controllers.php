<?php
class RetenciondeImpuestosController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_impuesto"])){
            
            // echo '<script>

            // matPreloader("on");
            // fncSweetAlert("loading", "Loading...", "");

            // </script>';

            if(preg_match('/^[a-zA-Z1-9]{1,5}$/',$_POST["cod_retencion"]) &&
            preg_match('/^[-%0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]) &&
            preg_match('/^[0-9]{1,3}([.][0-9]{1,2})$/',$_POST["por_retencion"]))

            {
                if(isset($_POST["sts_impuesto"])){
                    $_POST["sts_impuesto"] = "A";
                }else{
                    $_POST["sts_impuesto"] = "C";
                }

                $data = array(
                    
                    "cod_impuesto" => trim($_POST["cod_impuesto"]),
                    "cod_retencion" => trim($_POST["cod_retencion"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "por_retencion" => trim($_POST["por_retencion"]),
                    "sts_impuesto" => $_POST["sts_impuesto"]
    
                );
                //echo '<pre>'; print_r($data); echo '</pre>';
         
                $url = "ecmp_impuesto?token=".$_SESSION["admin"]->token_usuario;
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
                        fncSweetAlert("success", "Registro con exito", "retenciondeImpuestos");

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


    public function retenciondeImpuestos(){
        $url = "ecmp_impuesto";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id,$id2){

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"] && $id2 == $_POST["idAdmin1"]){
            
            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';

            $url = "ecmp_impuesto?linkTo=cod_impuesto,cod_retencion&equalTo=".$id.",".trim($id2);
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(preg_match('/^[-%0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]) &&
                preg_match('/^[0-9]{1,5}([.][0-9]{1,2})$/',$_POST["por_retencion"]))
    
                {
                    
                    if(isset($_POST["sts_impuesto"])){
                        $_POST["sts_impuesto"] = "A";
                    }else{
                        $_POST["sts_impuesto"] = "C";
                    }
    
                        // agruamos la informaicon

                        $data =
                            "txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&por_retencion=".trim($_POST["por_retencion"]).
                            "&sts_impuesto=".trim($_POST["sts_impuesto"]);
            
            
                     
                
                    $url = "ecmp_impuesto?id=".$id."&nameId=cod_impuesto&id2=".trim($id2)."&nameId2=cod_retencion&token=".$_SESSION["admin"]->token_usuario;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "retenciondeImpuestos");

                    </script>';
                    }else{
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error editing the registry");

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
