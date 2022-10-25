<?php
class TipoprecioController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_precio"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

            if(preg_match('/^[a-zA-Z0-9]{1,2}$/',$_POST["cod_precio"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,60}$/',$_POST["txt_descripcion"]))

            {
                if(isset($_POST["sts_defecto"])){
                    $_POST["sts_defecto"] = "A";
                }else{
                    $_POST["sts_defecto"] = "C";
                }

                if(isset($_POST["sts_precio"])){
                    $_POST["sts_precio"] = "A";
                }else{
                    $_POST["sts_precio"] = "C";
                    
                }

                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_precio" => trim($_POST["cod_precio"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "sts_defecto" => $_POST["sts_defecto"],
                    "sts_precio" => $_POST["sts_precio"],
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("d-m-Y H:i:s"),
    
                );
                

         
                $url = "ecmp_precio?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Registro con exito", "tipoprecio");

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


    public function tipoprecio(){
        $url = "ecmp_precio";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id){

        date_default_timezone_set("America/Guayaquil");
        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){
            

            $url = "ecmp_precio?linkTo=cod_empresa,cod_precio&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,60}$/',$_POST["txt_descripcion"]))
    
                {
                    if(isset($_POST["sts_defecto"])){
                        $_POST["sts_defecto"] = "A";
                    }else{
                        $_POST["sts_defecto"] = "C";
                    }
    
                    if(isset($_POST["sts_precio"])){
                        $_POST["sts_precio"] = "A";
                    }else{
                        $_POST["sts_precio"] = "C";
                        
                    }
              
                        $data = "&txt_descripcion=".trim($_POST["txt_descripcion"]).
                                "&sts_defecto=".$_POST["sts_defecto"].
                                "&sts_precio=".$_POST["sts_precio"].
                                "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                                "&fec_actualiza=".date("d-m-Y H:i:s");
            
                    
                    
                    $url = "ecmp_precio?id=".$id."&nameId=cod_precio&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "Registro con exito", "tipoprecio");

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
