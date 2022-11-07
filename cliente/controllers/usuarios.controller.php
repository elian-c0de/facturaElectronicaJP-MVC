<?php
class UsuariosController{



    public function create(){
        date_default_timezone_set("America/Guayaquil");

        //$_POST["gen_punto_emision1"];
    //     echo '<pre>'; print_r($_POST["gen_punto_emision1"]); echo '</pre>';
    //    return;

        if(isset($_POST["cod_usuario"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("Loading", "Loading...", "");

            </script>';


            // if (!isset($_POST["nom_usuario"])) {

            //     $_POST["nom_usuario"] = "";
            // }
            

            if(
            preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9]{1,20}$/',$_POST["cod_usuario"]) &&
            preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,50}$/',$_POST["nom_usuario"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ]{8,20}$/',$_POST["cod_passwd"])  )
            {

                if(isset($_POST["sts_usuario"])){
                    $_POST["sts_usuario"] = "A";
                }else{
                    $_POST["sts_usuario"] = "C";
                }

                if(isset($_POST["sts_administrador"])){
                    $_POST["sts_administrador"] = "A";
                }else{
                    $_POST["sts_administrador"] = "C";
                    
                }

                $variable = explode("~",$_POST["gen_punto_emision1"]);

                // $crypt = crypt($data["cod_passwd"], 'td');
                $data = array(
                    
                    

                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_usuario" => trim($_POST["cod_usuario"]),
                    "nom_usuario" => trim($_POST["nom_usuario"]),
                    "fec_vigencia_passwd" => date("Y-m-d H:i:s"),
                    "num_dias_vigencia_passwd" => trim('0'),
                    "num_intentos" => trim('0'),
                    "cod_passwd" => crypt($_POST["cod_passwd"], 'td'),
                    "cod_perfil" => trim($_POST["gen_perfil"]),
                    "sts_administrador" => $_POST["sts_administrador"],
                    "sts_usuario" => $_POST["sts_usuario"],
                    "cod_establecimiento" => $variable[0],
                    "cod_punto_emision" => $variable[1]

                );

          
            
            
                
         
                $url = "gen_usuario?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
             
              


                if($response->status == 200){
                    echo '<script>

                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("success", "Registro Exitoso", "usuarios");

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


    public function perfil_usuario(){
        $url = "gen_perfil?linkTo=cod_empresa&equalTo=".$_SESSION['admin']->cod_empresa;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }
    public function puntoEmision_usuario(){
        $url = "gen_punto_emision?linkTo=cod_empresa&equalTo=".$_SESSION['admin']->cod_empresa;
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

            $url = "gen_usuario?linkTo=cod_empresa,cod_usuario&equalTo=".$_SESSION['admin']->cod_empresa.",".trim($id);
          
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
            
            if($response->status == 200){
                if(
                
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}$/',$_POST["nom_usuario"]) 
                // &&                preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{8,20}$/',$_POST["cod_passwd"])  
                )
                {
    
                    if(isset($_POST["sts_usuario"])){
                        $_POST["sts_usuario"] = "A";
                    }else{
                        $_POST["sts_usuario"] = "C";
                    }
    
                    if(isset($_POST["sts_administrador"])){
                        $_POST["sts_administrador"] = "A";
                    }else{
                        $_POST["sts_administrador"] = "C";
                        
                    }
                    echo '<pre>'; print_r($response->result[0]->cod_passwd); echo '</pre>';
                    return;

                    if(isset($_POST["claveTemporar"])){
                        $_POST["claveTemporar"] = "tdqow9PSQszTg";
                    }else{
                        $_POST["claveTemporar"] = $response->result[0]->cod_passwd;
                        
                        
                    }
              
                    $variable = explode("~",$_POST["gen_punto_emision1"]);
    
                            $data = 
                            "nom_usuario=".trim($_POST["nom_usuario"]).
                            "&fec_vigencia_passwd=".date("d-m-Y H:i:s").
                            "&num_dias_vigencia_passwd=".trim('0').
                            "&num_intentos=".trim('0').
                            "&cod_perfil=".trim($_POST["gen_perfil"]).
                            "&sts_administrador=".trim($_POST["sts_administrador"]).
                            "&sts_usuario=".trim($_POST["sts_usuario"]).
                            "&cod_establecimiento=".$variable[0].
                            "&cod_punto_emision=".$variable[1].      
                            // "&cod_passwd=".trim($_POST["cod_passwd"]).                   
                            "&cod_passwd=".trim($_POST["claveTemporar"]);
                          
                    $url = "gen_usuario?id=".trim($id)."&nameId=cod_usuario&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
                    
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
                    
                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con éxito", "usuarios");

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

    //EDITAR PASSWORD
    public function editpass($id){

        if(isset($_POST["idAdmin"])){
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

        </script>';
            
          if($id == $_POST["idAdmin"]){

            $url = "gen_usuario?linkTo=cod_empresa,cod_usuario&equalTo=".$_SESSION['admin']->cod_empresa.",".trim($id);
          
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
            $passold = crypt($_POST["cod_passwd"], 'td');
            if($response->status == 200 && trim($response->result[0]->cod_passwd)==$passold){
                
                
                
                if($_POST["cod_passwd"] )
                {
                    if($_POST["txt_passwdnew"]==$_POST["txt_passwdnewconfi"]){
        
                                $data =                          
                                "&cod_passwd=". crypt($_POST["txt_passwdnew"], 'td');
                              
                        $url = "gen_usuario?id=".trim($id)."&nameId=cod_usuario&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
                        
                        $method = "PUT";
                        $fields = $data;
                    
                        $response = CurlController::request($url,$method,$fields);
                        
                        if($response->status == 200){
                            echo '<script>
    
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "Edicion con exito", "logout");
    
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
                        fncNotie(3, "La contraseña no coincide");
    
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
                fncNotie(3, "Error en el sistema1");

            </script>';
            }

          }else{

            echo '<script>

            fncFormatInputs();
            matPreloader("off");
            fncSweetAlert("close", "", "");
            fncNotie(3, "Error en el sistema2");

        </script>';
            
          }
            
        }

  
    }

}
