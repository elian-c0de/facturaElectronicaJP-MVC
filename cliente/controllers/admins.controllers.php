<?php

class AdminsController{

    public function login(){

        if(isset($_POST["txtusuario"])){

            if(preg_match('/^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}$/D', $_POST["txtusuario"])){

                echo '<script>
                matPreloader("on");
                fncSweetAlert("loading","loading..","");
                
                </script>';
                
           
                $url = "gen_usuario?login=true";
                $method = "POST";
                $fields = array(
                    "cod_usuario" => $_POST["txtusuario"],
                    "cod_passwd" => $_POST["txtcontra"]
                );
                
                $response = CurlController::request($url,$method,$fields);
                
                
                //validamos si los datos coinciden en la base de datos
                if($response->status == 200 && $response->result[0]->sts_usuario == "A"){
                    $v = str_replace(" ","",$response->result[0]->cod_perfil);
                    //validamos si tiene rol administrativo
                    // if( $v != "ADM"){
                    //     echo '<div class="alert-default-warning">no tienes permiso para acceder</div>';
                    //     session_destroy();
                    // }
                    
                    $_SESSION["admin"] = $response->result[0];

                    $url1 = "gen_perfil_opcion?linkTo=cod_empresa,cod_perfil&equalTo=".$_SESSION["admin"]->cod_empresa.",".trim($_SESSION["admin"]->cod_perfil);
                    $method1 = "GET";
                    $fields1 = array();
                    
                    $response1 = CurlController::request($url1,$method1,$fields1);
    
                    $_SESSION["perfil"] = $response1->result;
                  
                    
                    echo '<script>

                    fncFormatInputs();
                    localStorage.setItem("token_user","'.$response->result[0]->token_usuario.'");
                    localStorage.setItem("cod","'.$response->result[0]->cod_empresa.'");
                    localStorage.setItem("codus","'.$response->result[0]->cod_usuario.'");
                    window.location = "'.$_SERVER["REQUEST_URI"].'"
                    
                    
                    </script>';


                }else{
                    if(is_array($response->result)){
                        echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                    
                        </script> 
                        <div class="alert alert-danger">Usuario Deshabilitado</div>';
                    }else{
                        echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                    
                        </script> 
                        <div class="alert alert-danger">'.$response->result.'</div>';
                    }
                }


            }else{
                echo '<script>

                fncFormatInputs();
                matPreloader("off");
                fncSweetAlert("close", "", "");
        
            </script> 

         <div class="alert alert-danger">Field syntax error</div>';

            }
        }
       

    }

    public function create(){
        date_default_timezone_set("America/Guayaquil");
   
        if(isset($_POST["cod_caja"])){
          
            if(preg_match('/^[0,1,2,3,4,5,6,7,8,9]{1,3}$/',$_POST["cod_caja"]) &&
            preg_match('/^[a-zA-Z,0,1,2,3,4,5,6,7,9_]{1,20}$/',$_POST["cod_usuario"])){
              
                // echo "estamos aqui";
    
                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_caja" => trim($_POST["cod_caja"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "cod_usuario" => trim($_POST["cod_usuario"]),
                    "fec_actualiza" => date("Y-m-d H:i:s")
    
                );
                $url = "srja_caja?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                echo '<pre>'; print_r($response); echo '</pre>';
              


                if($response->status == 200){
                    echo '
                    <script>

                    fncFormatInput();
                    </script>
                    
                    
                    <div class="alert alert-success"> Registro Exitoso </div>
                    
                    
                    
                    ';
                }else{
                    echo '
                    <script>

                    fncFormatInput();
                    </script>
                    
                    
                    <div class="alert alert-warning"> Error en el sietam , intente mas tarde </div>';
                }

    
            }else{
                echo '
                
                <script>

                    fncFormatInput();
                    </script>
                
                <div class="alert alert-danger">Error en el campo de datos</div>';
            }
        }

  
    }

    public function edit($id){
        echo '<pre>'; print_r($id); echo '</pre>';
        echo '<pre>'; print_r($_POST["idAdmin"]); echo '</pre>';

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){

            $url = "srja_caja?linkTo=cod_empresa,cod_caja&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
        
            $response = CurlController::request($url,$method,$fields);
           

            if($response->status == 200){

                if(preg_match('/^[0,1,2,3,4,5,6,7,8,9]{1,3}$/',$_POST["cod_caja"]) &&
                preg_match('/^[a-zA-Z,0,1,2,3,4,5,6,7,9_]{1,20}$/',$_POST["cod_usuario"])){
              
                        // // validar contraseña
                        // if(!empty($_POST["password"])){
                        //     $password = $_POST["password"];
                        //     $crypt = crypt($password["cod_passwd"], 'td');
                        // }else{

                        // }
                        // agruamos la informaicon
        
                    $data = "cod_usuario=".trim($_POST["cod_usuario"])."&fec_actualiza=".date("Y-m-d H:i:s")."&txt_descripcion=".trim($_POST["txt_descripcion"]);
                        
                         // "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                        // "cod_caja=".trim($_POST["cod_caja"])."&txt_descripcion=".trim($_POST["txt_descripcion"])."&
                       
                     
                
                    $url = "srja_caja?id=".$id."&nameId=cod_caja&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
                    echo '<pre>'; print_r($url); echo '</pre>';
                    $method = "PUT";
                    $fields = $data;
                 
                    $response = CurlController::request($url,$method,$fields);
                    echo '<pre>'; print_r($response); echo '</pre>';

                    


                    if($response->status == 200){
                        echo '
                        <script>
                        fncFormatInput();
                        </script>
                        
                        
                        <div class="alert alert-success"> Edicion Exitosa </div>
                        
                        
                        ';
                    }else{
                        echo '
                        <script>

                        fncFormatInput();
                        </script>
                        
                        
                        <div class="alert alert-warning"> Error al editar los registros</div>';
                    }

    
                }else{
                    echo '
                    
                    <script>

                        fncFormatInput();
                        </script>
                    
                    <div class="alert alert-danger">Error en el campo de datos</div>';
                }

            }else{
                echo '
                
                <script>

                    fncFormatInput();
                    </script>
                
                <div class="alert alert-danger">Error al editar el registro mielda</div>';
            }

          }
            
        }

  
    }

}
