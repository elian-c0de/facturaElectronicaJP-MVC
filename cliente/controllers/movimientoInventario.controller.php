<?php
class MovimientoInventarioController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_impuesto"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

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
                        fncSweetAlert("success", "Registro con éxito", "retenciondeImpuestos");

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


    public function gen_usuario(){
        $url = "gen_usuario?linkTo=cod_establecimiento&equalTo=".$_SESSION['admin']->cod_establecimiento;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id,$id2){

        

        if(isset($_POST["idAdmin"])){

            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
          if($id == $_POST["idAdmin"] && $id2 == $_POST["idAdmin1"]){



            $url = "gen_empresa?linkTo=cod_empresa&equalTo=".$_SESSION['admin']->cod_empresa;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
            
     
            if($response->status == 200){

                if(preg_match('/^[0-9]{1,13}$/',$_POST["num_ruc"]) && preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}$/',$_POST["nom_empresa"]) &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,15}$/',$_POST["nom_abreviado"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,225}$/',$_POST["txt_direccion"]) &&
                preg_match('/^[-\\(\\)\\0-9 ]{1,10}$/',$_POST["num_telefono"]) &&
                preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["txt_email"]) &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}$/',$_POST["nom_representante"])
                )

    
                {

                 
                              
                    
                    if(isset($_POST["sts_obligado_contabilidad"])){
                        $_POST["sts_obligado_contabilidad"] = "S";
                    }else{
                        $_POST["sts_obligado_contabilidad"] = "N";
                    }
    
                    if(isset($_POST["sts_contribuyente_rme"])){
                        $_POST["sts_contribuyente_rme"] = "S";
                    }else{
                        $_POST["sts_contribuyente_rme"] = "N";
                        
                    }
               
                        // // validar contraseña
                        // if(!empty($_POST["password"])){
                        //     $password = $_POST["password"];
                        //     $crypt = crypt($password["cod_passwd"], 'td');
                        // }else{

                        // }
                        // agruamos la informaicon
                        $data = "num_ruc=".trim($_POST["num_ruc"]).
                        "&nom_empresa=".trim($_POST["nom_empresa"]).
                        "&nom_abreviado=".trim($_POST["nom_abreviado"]).
                        "&txt_direccion=".trim($_POST["txt_direccion"]).
                        "&num_telefono=".trim($_POST["num_telefono"]).
                        "&txt_email=".trim($_POST["txt_email"]).
                        "&sts_obligado_contabilidad=".trim($_POST["sts_obligado_contabilidad"]).
                        "&num_res_agente_ret=".trim($_POST["num_res_agente_ret"]).
                        "&sts_contribuyente_rme=".trim($_POST["sts_contribuyente_rme"]).
                        "&txt_path_logo=".trim($_POST["txt_path_logo"]).
                        "&num_id_representante=".trim($_POST["num_id_representante"]).
                        "&cod_tipo_id_representante=".trim($_POST["cod_tipo_id_representante"]).
                        "&nom_representante=".trim($_POST["nom_representante"]);
                        
                        
                    
                     
                
                    $url = "gen_empresa?id=".$id."&nameId=cod_empresa&token=".$_SESSION["admin"]->token_usuario;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "informacionGeneral");

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
                    fncNotie(3, "Field syntax error");

                </script>';
                }

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
					fncNotie(3, "Error editing the registry");

				</script>';
          }
            
        }

  
    }

}
