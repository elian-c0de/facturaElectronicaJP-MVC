<?php
class LineasdeproductoController{

    public function create(){
        date_default_timezone_set("America/Guayaquil");


        if(isset($_POST["cod_linea"])){
            
            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';

            if(preg_match('/^[0-9]{1,3}$/',$_POST["cod_linea"]) &&
               preg_match('/^[0-9]{1,3}$/',$_POST["cod_sublinea"]) && preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))

            {

                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_linea" => trim($_POST["cod_linea"]),
                    "cod_sublinea" => trim($_POST["cod_sublinea"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "cod_usuario" => "administrador",
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
                        fncSweetAlert("success", "Registro con exito", "lineasdeproducto");

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


    public function tipoprecio(){
        $url = "ecmp_linea";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }


    public function edit($id,$id2){

        if(isset($_POST["cod_linea"]) && isset($_POST["cod_sublinea"])){
            
          if($id == $_POST["cod_linea"]){

            $url = "ecmp_linea?linkTo=cod_empresa,cod_linea,cod_sublinea&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]))
    
                {
                    

                    $data = "&txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&cod_usuario="."administrador".
                            "&fec_actualiza=".date("d-m-Y H:i:s");
            
                    
                     
                
                    $url = "ecmp_linea?id=".$id."&nameId=cod_linea&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
             

                    


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
