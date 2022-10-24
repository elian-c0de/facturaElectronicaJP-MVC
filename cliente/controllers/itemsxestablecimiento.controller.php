<?php
class ItemsxestablecimientoController{



    public function create(){
        date_default_timezone_set("America/Guayaquil");

        if(isset($_POST["cod_inventario_hidden"])){


            echo '<script>

            matPreloader("on");
            fncSweetAlert("loading", "Loading...", "");

            </script>';


            $url = "ecmp_item_local?linkTo=cod_empresa,cod_establecimiento,cod_inventario&equalTo=".$_SESSION['admin']->cod_empresa.",".$_POST["cod_establecimiento"].",".$_POST["cod_inventario_hidden"];
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url,$method,$fields);
            

            if($response->status == 200){

                echo '<script>

                fncFormatInputs();
                matPreloader("off");
                fncSweetAlert("close", "", "");
                fncSweetAlert("error", "Datos Repetido, por favor elige otro", "itemsxestablecimiento/create");

            </script>';

            }else{

        


                $data = array(
                    
                    "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                    "cod_establecimiento" => trim($_POST["cod_establecimiento"]),
                    "cod_inventario" => trim($_POST["cod_inventario_hidden"]),
                    "sts_control_saldo" => "A",
                    "sts_modifica_precio" => "A",
                    "qtx_minimo" => 0,
                    "qtx_maximo" => 0,
                    "val_descuento" => 0,
                    "por_descuento" => 0,
                    "sts_item_local" => "A"
                );
                echo '<pre>'; print_r( $data); echo '</pre>';
                
         
                $url = "ecmp_item_local?token=".$_SESSION["admin"]->token_usuario;
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url,$method,$fields);
                echo '<pre>'; print_r($response); echo '</pre>';
      
              


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

    public function getestablecimientos(){
        $url = "gen_local?select=cod_establecimiento,txt_descripcion&linkTo=cod_empresa&equalTo=".$_SESSION["admin"]->cod_empresa."";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }











    public function edit($id,$id2){

        if(isset($_POST["idAdmin"]) &&  isset($_POST["idAdmin1"]) ){
            
          if($id == $_POST["idAdmin"] && $id2 == $_POST["idAdmin1"] ){

            $url = "ecmp_item_local?linkTo=cod_empresa,cod_inventario,cod_establecimiento&equalTo=".$_SESSION['admin']->cod_empresa.",".$id.",".$id2;
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                echo '<script>

                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");
    
                </script>';

                if(preg_match('/^[0-9]{1,3}([.][0-9]{1,2})?$/',$_POST["qtx_minimo"]) &&
                preg_match('/^[0-9]{1,3}([.][0-9]{1,2})?$/',$_POST["qtx_maximo"]) &&
                preg_match('/^[0-9]{1,3}([.][0-9]{1,2})?$/',$_POST["val_descuento"]) &&
                preg_match('/^[0-9]{1,3}([.][0-9]{1,2})?$/',$_POST["por_descuento"])  )   
                {
                 

                    if(isset($_POST["sts_control_saldo"])){
                        $_POST["sts_control_saldo"] = "A";
                    }else{
                        $_POST["sts_control_saldo"] = "C";
                    }
    
                    if(isset($_POST["sts_modifica_precio"])){
                        $_POST["sts_modifica_precio"] = "A";
                    }else{
                        $_POST["sts_modifica_precio"] = "C";
                        
                    }

                    if(isset($_POST["sts_item_local"])){
                        $_POST["sts_item_local"] = "A";
                    }else{
                        $_POST["sts_item_local"] = "C";
                        
                    }



                   

                        $data = "sts_control_saldo=".$_POST["sts_control_saldo"].
                        
                            "&sts_modifica_precio=".$_POST["sts_modifica_precio"].
                            "&qtx_minimo=".trim($_POST["qtx_minimo"]).
                            "&qtx_maximo=".trim($_POST["qtx_maximo"]).
                            "&val_descuento=".trim($_POST["val_descuento"]).
                            "&por_descuento=".trim($_POST["por_descuento"]).
                            "&sts_item_local=".$_POST["sts_item_local"];
                           
    
                
                    $url = "ecmp_item_local?id=".$id."&nameId=cod_inventario&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_establecimiento&id3=".$id2;
         
                    $method = "PUT";
                    $fields = $data;
                
                    $response = CurlController::request($url,$method,$fields);
                    echo '<pre>'; print_r( $response); echo '</pre>';
             

                    


                    if($response->status == 200){
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Edicion con exito", "itemsxestablecimiento");

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

          }
            
        }

  
    }

}
