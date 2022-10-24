<?php
class SubLineasdeproductoController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_linea"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

            if(preg_match('/^[0-9]{1,3}$/',$_POST["cod_linea"]) && preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))

            {

                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_linea" => trim($_POST["cod_linea"]),
                    "cod_sublinea" => trim($_POST["cod_sublinea"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("d-m-Y H:i:s"),
    
                );
                

         
                $url = "ecmp_linea?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Registro con exito", "sublineaproducto");

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


    public function edit($id,$id2){

        date_default_timezone_set("America/Guayaquil");
        
        if(isset($_POST["idAdmin"]) && isset($_POST["idAdmin2"])){

            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
          if($id == $_POST["idAdmin"] && $id2 == $_POST["idAdmin2"]){

            $url = "ecmp_linea?linkTo=cod_empresa,cod_linea,cod_sublinea&equalTo=".$_SESSION['admin']->cod_empresa.",".$id.",".$id2;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);

            if($response->status == 200){
                

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))
    
                {
                    

                    $data = 
                            "&txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("d-m-Y H:i:s");
            
                    
                     
                
                    $url = "ecmp_linea?id=".$id."&nameId=cod_linea&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_sublinea&id3=".$id2;
                    
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "sublineaproducto");

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
