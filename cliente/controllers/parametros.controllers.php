<?php
class ParametrosController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_parametro"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

            if(preg_match('/^[A-Z\\_]{1,10}$/',$_POST["cod_parametro"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["nom_parametro"])&&
            preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\#\\?\\¿\\!\\¡\\:\\,\\.\\"\\@\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["val_parametro"]))

            {
                
                $data = array(
                    
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_parametro" => trim(explode("_",$_POST["cod_parametro"])[0]),
                    "nom_parametro" => trim($_POST["nom_parametro"]),
                    "val_parametro" =>  trim($_POST["val_parametro"]),
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("Y-m-d H:i:s")
                    //Deben cambiar el Formato de la Fecha:Y-m-d o d-m-Y 
    
                );
          
              

         
                $url = "gen_control?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
          


                if($response->status == 200){
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Registro con éxito", "parametros");

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


    public function parametros(){
        $url = "gen_control";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id){

        if(isset($_POST["idAdmin"])){
            
            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
          if($id == $_POST["idAdmin"]){

            $url = "gen_control?linkTo=cod_empresa,cod_parametro&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
       

           
            if($response->status == 200){

                if(
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\#\\?\\¿\\!\\¡\\:\\,\\.\\"\\@\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["val_parametro"]))
    
                {
                        // agruamos la informaicon

                        $data =
                            "val_parametro=".trim($_POST["val_parametro"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("Y-m-d H:i:s");
                            //Deben cambiar el Formato de la Fecha:Y-m-d o d-m-Y 
                     
                
                    $url = "gen_control?id=".$id."&nameId=cod_parametro&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con éxito", "parametros");

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
