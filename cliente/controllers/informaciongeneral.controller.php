<?php
class InformacionGeneralController{

    
    // ! el create no se usa en esta ocacion ya que solo existira 1 empresa ligada a 1 usuario
    // public function create(){
    //     date_default_timezone_set("America/Guayaquil");


    //     if(isset($_POST["num_id"])){
            
           

    //         if(preg_match('/^[0,1,2,3,4,5,6,7,8,9]{1,13}$/',$_POST["num_id"]) &&
    //         preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["nom_apellido_rsocial"]) &&
    //         preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["nom_persona_nombre"]) &&
    //         preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["txt_direccion"]) &&
    //         preg_match('/^[-\\(\\)\\0-9 ]{1,15}$/',$_POST["num_telefono"]) && preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["txt_email"]))

    //         {
    //             $var1 = "";
    //             $var3 = "";
    //             $_POST["sts_proveedor"] = "off";
    //             if($_POST["sts_cliente"] == "on"){
    //                 $var1 = "A";
    //             }else{
    //                 $var1 = "I";
    //             }

    //             if($_POST["sts_proveedor"] == "on"){
    //                 $var2 = "P";
    //             }else{
    //                 $var2 = "C";
    //             }


    //             $data = array(
                    
    //                 "cod_empresa" => $_SESSION["admin"]->cod_empresa,
    //                 "num_id" => trim($_POST["num_id"]),
    //                 "cod_tipo_id" => trim(explode("_",$_POST["cod_tipo_id"])[0]),
    //                 "nom_persona_nombre" => trim($_POST["nom_persona_nombre"]),
    //                 "nom_apellido_rsocial" => trim($_POST["nom_apellido_rsocial"]),
    //                 "txt_direccion" => trim($_POST["txt_direccion"]),
    //                 "num_telefono" => trim($_POST["num_telefono"]),
    //                 "num_id_texto" => trim($_POST["num_id"]),
    //                 "txt_email" => trim($_POST["txt_email"]),
    //                 "sts_cliente" => $var1,
    //                 "cod_usuario" => "administrador",
    //                 "fec_actualiza" => date("Y-m-d H:i:s"),
    //                 "cod_precio" =>  trim(explode("_",$_POST["cod_precio"])[0]),
    //                 "sts_proveedor" => $var2
    
    //             );

            
                
         
    //             $url = "ecmp_cliente?token=".$_SESSION["admin"]->token_usuario;
    //             $method = "POST";
    //             $fields = $data;
    //             $response = CurlController::request($url,$method,$fields);
      
              


    //             if($response->status == 200){
    //                 echo '
    //                 <script>

    //                 fncFormatInput();
    //                 </script>
                    
                    
    //                 <div class="alert alert-success"> Registro Exitoso </div>
                    
                    
                    
    //                 ';
    //             }else{
    //                 echo '
    //                 <script>

    //                 fncFormatInput();
    //                 </script>
                    
                    
    //                 <div class="alert alert-warning"> Error en el sietam , intente mas tarde </div>';
    //             }

    
    //         }else{
    //             echo '
                
    //             <script>

    //                 fncFormatInput();
    //                 </script>
                
    //             <div class="alert alert-danger">Error en el campo de datos</div>';
    //         }
    //     }

  
    // }


    // public function tipoprecio(){
    //     $url = "ecmp_precio";
    //     $method = "GET";
    //     $fields = array();
    //     $response = CurlController::request($url,$method,$fields)->result;
    //     return $response;
    // }


    public function edit($id){

        

        if(isset($_POST["idAdmin"])){

            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
          if($id == $_POST["idAdmin"]){



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
                preg_match('/^[A-Z]{1,1}$/',$_POST["cod_tipo_id_representante"]) && preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}$/',$_POST["nom_representante"])
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
