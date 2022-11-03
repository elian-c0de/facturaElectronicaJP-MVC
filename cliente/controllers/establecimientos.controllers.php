<?php
class EstablecimientosController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_establecimiento"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';
            
           

            if(preg_match('/^[a-zA-Z0-9]{1,3}$/',$_POST["cod_establecimiento"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_direccion"]))

            {


                if(isset($_POST["sts_matriz"])){
                    $_POST["sts_matriz"] = "A";
                }else{
                    $_POST["sts_matriz"] = "C";
                }

                if(isset($_POST["sts_local"])){
                    $_POST["sts_local"] = "A";
                }else{
                    $_POST["sts_local"] = "C";
                    
                }


                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_establecimiento" => trim($_POST["cod_establecimiento"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "txt_direccion" => trim($_POST["txt_direccion"]),
                    "sts_matriz" => $_POST["sts_matriz"],
                    "sts_local" => $_POST["sts_local"],
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "fec_actualiza" => date("Y-m-d H:i:s"),
                    "sts_bodega" => NULL,
    
                );

            
                
         
                $url = "gen_local?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("success", "Registro Exitosos", "establecimientos");

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

    // OBTIENE UN LISTADO DE LOS ESTABLECIMIENTO DE UNA EMPRESA EN ESPECIFICA
    public function establecimientos(){
        $url = "gen_local?linkTo=cod_empresa,sts_local&equalTo=".$_SESSION["admin"]->cod_empresa.",A";
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
         

            $url = "gen_local?linkTo=cod_empresa,cod_establecimiento&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
      
           
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]) &&
                preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_direccion"]))
                {
                    if(isset($_POST["sts_matriz"])){
                    $_POST["sts_matriz"] = "A";
                }else{
                    $_POST["sts_matriz"] = "C";
                }

                if(isset($_POST["sts_local"])){
                    $_POST["sts_local"] = "A";
                }else{
                    $_POST["sts_local"] = "C";
                    
                }
              
                        // AGRUPAMOS LA INFORMACION

                        $data = 
                            "txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&txt_direccion=".trim($_POST["txt_direccion"]).
                            "&sts_matriz=".trim($_POST["sts_matriz"]).
                            "&sts_local=".trim($_POST["sts_local"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&fec_actualiza=".date("Y-m-d H:i:s");
                            // "&sts_bodega=".trim($_POST["sts_bodega"]).
                            // "sts_bodega=". NULL;
            
                    
                     
                
                    $url = "gen_local?id=".$id."&nameId=cod_establecimiento&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "establecimientos");

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
