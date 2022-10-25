<?php
class UsuariosController{



    public function create(){
        date_default_timezone_set("America/Guayaquil");

     
       

        if(isset($_POST["cod_inventario"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';


            if (!isset($_POST["cod_barras"])) {

                $_POST["cod_barras"] = "";
            }
            

            if(
            preg_match('/^[-A-Z0-9]{1,30}$/',$_POST["cod_inventario"]) &&
            preg_match('/^[-0-9]{1,30}$/',$_POST["cod_barras"]) &&
            preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]) &&
            preg_match('/^[0-9]{1,18}$/',$_POST["qtx_saldo"]) &&
            preg_match('/^[0-9]{1,18}([.][0-9]{1,2})?$/',$_POST["val_costo"]) )
            {

                if(isset($_POST["sts_iva"])){
                    $_POST["sts_iva"] = "A";
                }else{
                    $_POST["sts_iva"] = "C";
                }

                if(isset($_POST["sts_inventario"])){
                    $_POST["sts_inventario"] = "A";
                }else{
                    $_POST["sts_inventario"] = "C";
                    
                }




                $data = array(
                    
                    

                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_inventario" => trim($_POST["cod_inventario"]),
                    "cod_barras" => trim($_POST["cod_barras"]),
                    "txt_descripcion" => trim($_POST["txt_descripcion"]),
                    "sts_iva" => $_POST["sts_iva"],
                    "sts_tipo" => $_POST["sts_tipo"],
                    "qtx_saldo" => trim($_POST["qtx_saldo"]),
                    "val_costo" => trim($_POST["val_costo"]),
                    "cod_usuario" => $_SESSION["admin"]->cod_usuario,
                    "cod_linea" => explode("-",$_POST["cod_linea"])[0],
                    "cod_sublinea" => explode("-",$_POST["cod_linea"])[1],
                    "cod_marca" => $_POST["cod_marca"],
                    "sts_inventario" => $_POST["sts_inventario"],
                    "fec_actualiza" => date("Y-m-d H:i:s")

                );

          
            
            
                
         
                $url = "ecmp_inventario?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
             
              


                if($response->status == 200){
                    echo '<script>

                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("success", "Registro Exitosos", "inventario");

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
        $url = "gen_perfil";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }
   
    public function codigo_nombre_estado_usuario(){
        $url = "gen_usuario";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }

    public function establecimiento_usuario(){
        $url = "gen_local";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }
    public function puntoEmision_usuario(){
        $url = "gen_punto_emision";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }

    public function edit($id){

        if(isset($_POST["idAdmin"])){
            
          if($id == $_POST["idAdmin"]){

            $url = "ecmp_inventario?linkTo=cod_empresa,cod_inventario&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){


          

                if(
                    preg_match('/^[-0-9 ]{1,30}$/',$_POST["cod_barras"]) &&
                    preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/',$_POST["txt_descripcion"]) &&
                    preg_match('/^[0-9]{1,18}$/',$_POST["qtx_saldo"]) &&
                    preg_match('/^[0-9]{1,18}([.][0-9]{1,2})?$/',$_POST["val_costo"]) )
                {


                if(isset($_POST["sts_iva"])){
                    $_POST["sts_iva"] = "A";
                }else{
                    $_POST["sts_iva"] = "C";
                }

                if(isset($_POST["sts_inventario"])){
                    $_POST["sts_inventario"] = "A";
                }else{
                    $_POST["sts_inventario"] = "C";
                    
                }
              
        


                            $data = "cod_barras=".trim($_POST["cod_barras"]).
                            "&txt_descripcion=".trim($_POST["txt_descripcion"]).
                            "&sts_iva=".$_POST["sts_iva"].
                            "&sts_tipo=".$_POST["sts_tipo"].
                            "&qtx_saldo=".trim($_POST["qtx_saldo"]).
                            "&val_costo=".trim($_POST["val_costo"]).
                            "&cod_usuario=".$_SESSION["admin"]->cod_usuario.
                            "&cod_linea=".explode("-",$_POST["cod_linea"])[0].
                            "&cod_sublinea=".explode("-",$_POST["cod_linea"])[1].
                            "&cod_marca=".$_POST["cod_marca"].
                            "&sts_inventario=".$_POST["sts_inventario"].
                            "&fec_actualiza=".date("Y-m-d H:i:s");
            
                    
                
                    $url = "ecmp_inventario?id=".$id."&nameId=cod_inventario&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
              
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "inventario");

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
