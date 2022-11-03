<?php
class PerfilesController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");
        if(isset($_POST["cod_perfil"])){

            echo '<script>
            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");
            </script>';
            

            //INSERTAR cod_perfil
            if(preg_match('/^[a-zA-Z0-9]{1,6}$/',$_POST["cod_perfil"]) &&
            preg_match('/^[a-zA-Z0-9]{1,50}$/',$_POST["nom_perfil"]))
            {
                if(isset($_POST["sts_perfil"])){
                    $_POST["sts_perfil"] = "A";
                }else{
                    $_POST["sts_perfil"] = "C"; 
                }


                $data = array(
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "nom_perfil" => trim($_POST["nom_perfil"]),
                    "sts_perfil" => $_POST["sts_perfil"],
                    "cod_usuario_act" => $_SESSION["admin"]->cod_usuario,
    
                );

                $url = "gen_perfil?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);

                
            //INSERTAR PERMISOS
            // D_00
            if(isset($_POST["cod_perfil"])){

                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "D_00",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // D_01
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "D_01",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // D_01_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "D_01_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }
            
            // D_02
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "D_02",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_00
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_00",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_01
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_01",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
               
            }

            // O_01_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_01_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_02
            if(isset($_POST["cod_perfil"])){



                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_02",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_03
            if(isset($_POST["cod_perfil"])){



                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_03",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_03_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_03_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_04
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_04",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_04_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_04_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_05
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_05",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_05_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_05_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_06
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_06",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_07
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_07",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_07_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_07_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // O_08
            if(isset($_POST["cod_perfil"])){



                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "O_08",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_00
            if(isset($_POST["cod_perfil"])){

                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_00",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_01
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_01",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_02
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_02",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_03
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_03",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_03_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_03_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_04
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_04",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_05
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_05",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_06
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_06",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_06_L
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_06_L",
                    "sts_perfil_opcion" => "A",

                );

                $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                
            }

            // R_07
            if(isset($_POST["cod_perfil"])){


                $data = array(
                        
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "cod_modulo" => "PECMP",
                    "cod_opcion" => "R_07",
                    "sts_perfil_opcion" => "A",

                );

                    $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
                    $method = "POST";
                    $fields = $data;
                    $response = CurlController::request($url,$method,$fields);
        
                }

                if($response->status == 200){
                    echo '<script>
                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("success", "Registro Exitosos", "perfiles");

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


    public function perfiles(){
        $url = "gen_perfil";
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
            $url = "gen_perfil?linkTo=cod_empresa,cod_perfil&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url,$method,$fields);

            if($response->status == 200){
                if(preg_match('/^[a-zA-Z0-9]{1,50}$/',$_POST["nom_perfil"]))
                {
                if(isset($_POST["sts_perfil"])){
                    $_POST["sts_perfil"] = "A";
                }else{
                    $_POST["sts_perfil"] = "C";
                }
                        // AGRUPAMOS LA INFORMACION
                        $data = 
                            "nom_perfil=".trim($_POST["nom_perfil"]).
                            "&sts_perfil=".trim($_POST["sts_perfil"]).
                            "&cod_usuario_act=".$_SESSION["admin"]->cod_usuario;
                
                    $url = "gen_perfil?id=".$id."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                    $response = CurlController::request($url,$method,$fields);

                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "perfiles");

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