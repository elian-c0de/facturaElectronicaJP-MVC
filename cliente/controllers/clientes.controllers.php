<?php
class ClientesController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["num_id"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';
            
           

            if(preg_match('/^[0,1,2,3,4,5,6,7,8,9]{1,13}$/',$_POST["num_id"]) &&
            preg_match('/^[-0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["nom_apellido_rsocial"]) &&
            preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["nom_persona_nombre"]) &&
            preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["txt_direccion"]) &&
            preg_match('/^[-\\(\\)\\0-9 ]{1,15}$/',$_POST["num_telefono"]) && 
            preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["txt_email"]))

            {


                if(isset($_POST["sts_proveedor"])){
                    $_POST["sts_proveedor"] = "A";
                }else{
                    $_POST["sts_proveedor"] = "C";
                }

                if(isset($_POST["sts_cliente"])){
                    $_POST["sts_cliente"] = "A";
                }else{
                    $_POST["sts_cliente"] = "C";
                    
                }


                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "num_id" => trim($_POST["num_id"]),
                    "cod_tipo_id" => trim(explode("_",$_POST["cod_tipo_id"])[0]),
                    "nom_persona_nombre" => trim($_POST["nom_persona_nombre"]),
                    "nom_apellido_rsocial" => trim($_POST["nom_apellido_rsocial"]),
                    "txt_direccion" => trim($_POST["txt_direccion"]),
                    "num_telefono" => trim($_POST["num_telefono"]),
                    "num_id_texto" => trim($_POST["num_id"]),
                    "txt_email" => trim($_POST["txt_email"]),
                    "sts_cliente" => $_POST["sts_cliente"],
                    "cod_usuario" => "administrador",
                    "fec_actualiza" => date("Y-m-d H:i:s"),
                    "cod_precio" =>  trim(explode("_",$_POST["cod_precio"])[0]),
                    "sts_proveedor" =>  $_POST["sts_proveedor"]
    
                );

            
                
         
                $url = "ecmp_cliente?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
      
              


                if($response->status == 200){
                    echo '<script>

                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("success", "Registro Exitosos", "clientes");

                </script>';
                }else{
                    '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error al ingresar la informacion, intente mas tarde");

                    </script>';
                }

    
            }else{
                '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error en los campos ingresados");

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
;
        if(isset($_POST["idAdmin"])){

            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            
           
          if($id == $_POST["idAdmin"]){
         

            $url = "ecmp_cliente?linkTo=cod_empresa,num_id&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
      
           
            if($response->status == 200){

                if(preg_match('/^[-0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["nom_apellido_rsocial"]) &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["nom_persona_nombre"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}$/',$_POST["txt_direccion"]) &&
                preg_match('/^[-\\(\\)\\0-9 ]{1,15}$/',$_POST["num_telefono"]) && preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["txt_email"]))
    
                {
                    $var1 = "";
                    $var3 = "";
                    $_POST["sts_proveedor"] = "off";
                    if($_POST["sts_cliente"] == "on"){
                        $var1 = "A";
                    }else{
                        $var1 = "I";
                    }
    
                    if($_POST["sts_proveedor"] == "on"){
                        $var2 = "P";
                    }else{
                        $var2 = "C";
                    }
              
                        // // validar contraseña
                        // if(!empty($_POST["password"])){
                        //     $password = $_POST["password"];
                        //     $crypt = crypt($password["cod_passwd"], 'td');
                        // }else{

                        // }
                        // agruamos la informaicon

                        $data = 
                            "nom_persona_nombre=".trim($_POST["nom_persona_nombre"]).
                            "&nom_apellido_rsocial=".trim($_POST["nom_apellido_rsocial"]).
                            "&txt_direccion=".trim($_POST["txt_direccion"]).
                            "&num_telefono=".trim($_POST["num_telefono"]).
                            "&txt_email=".trim($_POST["txt_email"]).
                            "&sts_cliente=".$var1.
                            "&cod_usuario="."administrador".
                            "&fec_actualiza=".date("Y-m-d H:i:s").
                            "&cod_precio=".trim(explode("_",$_POST["cod_precio"])[0]).
                            "&sts_proveedor=".$var2;
            
                    
                     
                
                    $url = "ecmp_cliente?id=".$id."&nameId=num_id&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "clientes");

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
