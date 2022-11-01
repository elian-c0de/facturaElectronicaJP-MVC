<?php
class UsuariosController{



    public function create(){
        date_default_timezone_set("America/Guayaquil");

     
       

        if(isset($_POST["cod_usuario"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';


            // if (!isset($_POST["nom_usuario"])) {

            //     $_POST["nom_usuario"] = "";
            // }
            

            if(
            preg_match('/^[a-zñÑáéíóúÁÉÍÓÚ ]{1,20}$/',$_POST["cod_usuario"]) &&
            preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}$/',$_POST["nom_usuario"]) &&  
            preg_match('/^[a-zA-Z0-9]{1,6}$/',$_POST["cod_perfil"]) &&
            preg_match('/^[a-zA-Z0-9]{1,3}$/',$_POST["cod_establecimiento"]) &&
            preg_match('/^[0-9]{1,18}([.][0-9]{1,2})?$/',$_POST["cod_punto_emision"]) )
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




                $data = array(
                    
                    

                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_usuario" => trim($_POST["cod_usuario"]),
                    "nom_usuario" => trim($_POST["nom_usuario"]),
                    "fec_vigencia_passwd" => date("Y-m-d H:i:s"),
                    "num_dias_vigencia_passwd" => trim('0'),
                    "num_intentos" => trim('0'),
                    //"cod_passwd" => explode("-",$_POST["cod_passwd"])[0],
                    "cod_perfil" => trim($_POST["cod_perfil"]),
                    "sts_administrador" => $_POST["sts_administrador"],
                    "sts_usuario" => $_POST["sts_usuario"],
                    "cod_establecimiento" => trim($_POST["cod_establecimiento"]),
                    "cod_punto_emision" => trim($_POST["cod_punto_emision"])

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
                    fncSweetAlert("success", "Registro Exitosos", "usuarios");

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
   
    public function codigo_nombre_estado_usuario(){
        $url = "gen_usuario?linkTo=cod_empresa&equalTo=".$_SESSION['admin']->cod_empresa;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }

    public function establecimiento_usuario(){
        $url = "gen_local?linkTo=cod_empresa&equalTo=".$_SESSION['admin']->cod_empresa;
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
    public function puntoEmision_usuario2($id){
        $url = "gen_punto_emision?linkTo=cod_empresa,cod_establecimiento&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }

    //BUSCAR
    // public function buscar($tabla,$condicion){
    //     $result = $this->conexion->query('SELECT * FROM $tabla WHERE $condicion') or die($this->conexion->error);
    //     if($result){
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     }else{
    //         return false;
    //     }
    // }

    public function edit($id){

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){

            $url = "gen_usuario?linkTo=cod_empresa,cod_usuario&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){


          

                if(
                preg_match('/^[a-zñÑáéíóúÁÉÍÓÚ ]{1,20}$/',$_POST["cod_usuario"]) &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}$/',$_POST["nom_usuario"]) &&  
                preg_match('/^[a-zA-Z0-9]{1,6}$/',$_POST["cod_perfil"]) &&
                preg_match('/^[a-zA-Z0-9]{1,3}$/',$_POST["cod_establecimiento"]) &&
                preg_match('/^[0-9]{1,18}([.][0-9]{1,2})?$/',$_POST["cod_punto_emision"]) )
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
    
                            $data = "cod_empresa=".trim($_POST["cod_empresa"]).
                            "&cod_usuario=".trim($_POST["cod_usuario"]).
                            "&nom_usuario=".trim($_POST["nom_usuario"]).
                            "&fec_vigencia_passwd=".date("d-m-Y H:i:s").
                            "&num_dias_vigencia_passwd=".trim('0').
                            "&num_intentos=".trim('0').
                            "&cod_perfil=".trim($_POST["cod_perfil"]).
                            "&sts_administrador=".$_POST["sts_administrador"].
                            "&sts_usuario=".$_POST["sts_usuario"].
                            "&cod_perfil=".trim($_POST["cod_perfil"]).
                            "&cod_punto_emision=".trim($_POST["cod_punto_emision"]);
            

                
                    $url = "gen_usuario?id=".$id."&nameId=cod_usuario&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
              
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "usuarios");

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
