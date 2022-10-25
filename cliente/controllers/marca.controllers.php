<?php
class MarcaController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_marca"])){
            
            // echo '<script>

            // matPreloader("on");
            // fncSweetAlert("loading", "Loading...", "");

            // </script>';

            if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,70}$/',$_POST["nom_marca"]))

            {

                $data = array(
                    
                    "cod_marca" => trim($_POST["cod_marca"]),
                    "nom_marca" => trim($_POST["nom_marca"]),
    
                );
                //echo '<pre>'; print_r($data); echo '</pre>';
         
                $url = "ecmp_marca?token=".$_SESSION["admin"]->token_usuario;
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
                        fncSweetAlert("success", "Registro con exito", "marcas");

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


    public function edit($id){

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){

            $url = "ecmp_marca?linkTo=cod_marca&equalTo=".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,70}$/',$_POST["nom_marca"]))
    
                {
                    
                        $data =
                            "nom_marca=".trim($_POST["nom_marca"]);
            
                    
                     
                
                    $url = "ecmp_marca?id=".$id."&nameId=cod_marca&token=".$_SESSION["admin"]->token_usuario;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "marcas");

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
