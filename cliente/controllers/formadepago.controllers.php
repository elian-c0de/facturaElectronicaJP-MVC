<?php
class FormadepagoController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_forma_pago"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

            if(preg_match('/^[a-zA-Z0-9]{1,2}$/',$_POST["cod_forma_pago"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["nom_forma_pago"]))

            {
                if(isset($_POST["sts_defecto"])){
                    $_POST["sts_defecto"] = "A";
                }else{
                    $_POST["sts_defecto"] = "C";
                }

                if(isset($_POST["sts_forma_pago"])){
                    $_POST["sts_forma_pago"] = "A";
                }else{
                    $_POST["sts_forma_pago"] = "C";
                }

                $data = array(
                    
                    
                    
                    "cod_forma_pago" => trim($_POST["cod_forma_pago"]),
                    "nom_forma_pago" => trim($_POST["nom_forma_pago"]),
                    "sts_defecto" => $_POST["sts_defecto"],
                    "cod_sri" => $_POST["cod_sri"],
                    "sts_forma_pago" => $_POST["sts_forma_pago"],
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("d-m-Y H:i:s"),
                    "sts_retencion" => $_POST["sts_retencion"],
    
                );

         
                $url = "gen_forma_pago?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Registro con exito", "formadepago");

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


    public function formadepago(){
        $url = "gen_forma_pago";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id){

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){

            $url = "gen_forma_pago?linkTo=cod_forma_pago&equalTo=".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["nom_forma_pago"]))
    
                {
                    
                    if(isset($_POST["sts_defecto"])){
                        $_POST["sts_defecto"] = "A";
                    }else{
                        $_POST["sts_defecto"] = "C";
                    }
    
                    if(isset($_POST["sts_forma_pago"])){
                        $_POST["sts_forma_pago"] = "A";
                    }else{
                        $_POST["sts_forma_pago"] = "C";
                    }
    
                        // // validar contraseña
                        // if(!empty($_POST["password"])){
                        //     $password = $_POST["password"];
                        //     $crypt = crypt($password["cod_passwd"], 'td');
                        // }else{

                        // }
                        // agruamos la informaicon

                        $data =
                            "nom_forma_pago=".trim($_POST["nom_forma_pago"]).
                            "&sts_defecto=".trim($_POST["sts_defecto"]).
                            "&cod_sri=".trim($_POST["cod_sri"]).
                            "&sts_forma_pago=".trim($_POST["sts_forma_pago"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("d-m-Y H:i:s").
                            "&sts_retencion=".trim($_POST["sts_retencion"]);
            
                    
                     
                
                    $url = "gen_forma_pago?id=".$id."&nameId=cod_forma_pago&token=".$_SESSION["admin"]->token_usuario;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "formadepago");

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
