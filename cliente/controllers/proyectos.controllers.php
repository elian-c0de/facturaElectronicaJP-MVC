<?php
class ProyectosController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_proyecto"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';
            
           

            if(preg_match('/^[a-zA-Z0-9]{1,3}$/',$_POST["cod_proyecto"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["nom_proyecto"]))

            {
                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_proyecto" => trim($_POST["cod_proyecto"]),
                    "nom_proyecto" => trim($_POST["nom_proyecto"]),
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("Y-m-d H:i:s"),
    
                );

            
                
         
                $url = "ecmp_proyecto?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("success", "Registro Exitosos", "proyectos");

                </script>';
                }else{
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error al ingresar la informacion, intente mas tarde");

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
        }

  
    }


    public function proyecto(){
        $url = "ecmp_proyecto";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id){
;
        if(isset($_POST["idAdmin"])){

            echo '<script>

                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");

            </script>';
            
            
            if($id == $_POST["idAdmin"]){
            

            $url = "ecmp_proyecto?linkTo=cod_empresa,cod_proyecto&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
        
            
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["nom_proyecto"]))
                {
                        // AGRUPAMOS LA INFORMACION

                        $data = 
                            "nom_proyecto=".trim($_POST["nom_proyecto"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("Y-m-d H:i:s");
            
                    
                        
                
                    $url = "ecmp_proyecto?id=".$id."&nameId=cod_proyecto&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
            
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
                

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "proyectos");

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
