<?php
class PermisosController{

    public function create(){

        // D_00
        if(isset($_POST["perfil"])){

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "D_00",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // D_01
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_clientes"])){
                $_POST["sts_clientes"] = "A";
            }else{
                $_POST["sts_clientes"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "D_01",
                "sts_perfil_opcion" => $_POST["sts_clientes"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // D_01_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "D_01_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }
        
        // D_02
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_inventario"])){
                $_POST["sts_inventario"] = "A";
            }else{
                $_POST["sts_inventario"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "D_02",
                "sts_perfil_opcion" => $_POST["sts_inventario"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_00
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_00",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_01
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_mov_inventario"])){
                $_POST["sts_mov_inventario"] = "A";
            }else{
                $_POST["sts_mov_inventario"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_01",
                "sts_perfil_opcion" => $_POST["sts_mov_inventario"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_01_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_01_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_02
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_pedidos"])){
                $_POST["sts_pedidos"] = "A";
            }else{
                $_POST["sts_pedidos"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_02",
                "sts_perfil_opcion" => $_POST["sts_pedidos"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_03
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_facturacion"])){
                $_POST["sts_facturacion"] = "A";
            }else{
                $_POST["sts_facturacion"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_03",
                "sts_perfil_opcion" => $_POST["sts_facturacion"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_03_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_03_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_04
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_nota_credito"])){
                $_POST["sts_nota_credito"] = "A";
            }else{
                $_POST["sts_nota_credito"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_04",
                "sts_perfil_opcion" => $_POST["sts_nota_credito"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_04_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_04_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_05
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_caja"])){
                $_POST["sts_caja"] = "A";
            }else{
                $_POST["sts_caja"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_05",
                "sts_perfil_opcion" => $_POST["sts_caja"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_05_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_05_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_06
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_gastos_compras"])){
                $_POST["sts_gastos_compras"] = "A";
            }else{
                $_POST["sts_gastos_compras"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_06",
                "sts_perfil_opcion" => $_POST["sts_gastos_compras"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_07
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_comp_retencion"])){
                $_POST["sts_comp_retencion"] = "A";
            }else{
                $_POST["sts_comp_retencion"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_07",
                "sts_perfil_opcion" => $_POST["sts_comp_retencion"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_07_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_07_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // O_08
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_guia_remision"])){
                $_POST["sts_guia_remision"] = "A";
            }else{
                $_POST["sts_guia_remision"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "O_08",
                "sts_perfil_opcion" => $_POST["sts_guia_remision"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_00
        if(isset($_POST["perfil"])){

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_00",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_01
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_kardex_inventario"])){
                $_POST["sts_kardex_inventario"] = "A";
            }else{
                $_POST["sts_kardex_inventario"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_01",
                "sts_perfil_opcion" => $_POST["sts_kardex_inventario"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_02
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_comp_emitidos"])){
                $_POST["sts_comp_emitidos"] = "A";
            }else{
                $_POST["sts_comp_emitidos"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_02",
                "sts_perfil_opcion" => $_POST["sts_comp_emitidos"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_03
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_info_ventas_gastos"])){
                $_POST["sts_info_ventas_gastos"] = "A";
            }else{
                $_POST["sts_info_ventas_gastos"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_03",
                "sts_perfil_opcion" => $_POST["sts_info_ventas_gastos"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_03_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_03_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_04
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_precios"])){
                $_POST["sts_precios"] = "A";
            }else{
                $_POST["sts_precios"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_04",
                "sts_perfil_opcion" => $_POST["sts_precios"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_05
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_historial_cliente"])){
                $_POST["sts_historial_cliente"] = "A";
            }else{
                $_POST["sts_historial_cliente"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_05",
                "sts_perfil_opcion" => $_POST["sts_historial_cliente"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_06
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_top_ventas"])){
                $_POST["sts_top_ventas"] = "A";
            }else{
                $_POST["sts_top_ventas"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_06",
                "sts_perfil_opcion" => $_POST["sts_top_ventas"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_06_L
        if(isset($_POST["perfil"])){


            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_06_L",
                "sts_perfil_opcion" => "A",

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }
        }

        // R_07
        if(isset($_POST["perfil"])){

            if(isset($_POST["sts_ats_sri"])){
                $_POST["sts_ats_sri"] = "A";
            }else{
                $_POST["sts_ats_sri"] = "C";
                
            }

            $data = array(
                    
                "cod_empresa" => $_SESSION["admin"]->cod_empresa,
                "cod_perfil" => trim($_POST["perfil"]),
                "cod_modulo" => "PECMP",
                "cod_opcion" => "R_07",
                "sts_perfil_opcion" => $_POST["sts_ats_sri"],

            );

            $url = "gen_perfil_opcion?token=".$_SESSION["admin"]->token_usuario;
            $method = "POST";
            $fields = $data;
            $response = CurlController::request($url,$method,$fields);
            if($response->status == 200){
                echo '<script>

                console.log("Funciona");

            </script>';
            }else{
                echo '<script>
                    console.log("No Funciona");

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


    public function edit(){

        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",D_01";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_clientes"])){
                    $_POST["sts_clientes"] = "A";
                }else{
                    $_POST["sts_clientes"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_clientes"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=D_01";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);
                echo '<pre>'; print_r($response); echo '</pre>';


            }else{
                echo '<script>
                    console.log("No Funciona");

                </script>';
            }

            
        }



        // if(isset($_POST["idAdmin"])){

        //     echo '<script>

		// 		matPreloader("on");
		// 		fncSweetAlert("loading", "Loading...", "");

		// 	</script>';
            
           
        //   if($id == $_POST["idAdmin"]){
         

        //     $url = "gen_perfil?linkTo=cod_empresa,cod_perfil&equalTo=".$_SESSION['admin']->cod_empresa.",".$id;
            
        //     $method = "GET";
        //     $fields = array();
    
        //     $response = CurlController::request($url,$method,$fields);
      
           
        //     if($response->status == 200){

        //         if(preg_match('/^[a-zA-Z0-9]{1,50}$/',$_POST["nom_perfil"]))
        //         {

        //         if(isset($_POST["sts_perfil"])){
        //             $_POST["sts_perfil"] = "A";
        //         }else{
        //             $_POST["sts_perfil"] = "C";
                    
        //         }
              
        //                 // AGRUPAMOS LA INFORMACION

        //                 $data = 
        //                     "nom_perfil=".trim($_POST["nom_perfil"]).
        //                     "&sts_perfil=".trim($_POST["sts_perfil"]).
        //                     "&cod_usuario_act=".$_SESSION["admin"]->cod_usuario;
            
                    
                     
                
        //             $url = "gen_perfil?id=".$id."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa;
         
        //             $method = "PUT";
        //             $fields = $data;
                
        //             $response = CurlController::request($url,$method,$fields);
             

                    


        //             if($response->status == 200){
        //                 echo '<script>

        //                 fncFormatInputs();
        //                 matPreloader("off");
        //                 fncSweetAlert("close", "", "");
        //                 fncSweetAlert("success", "Edicion con exito", "perfiles");

        //             </script>';
        //             }else{

        //          echo '<script>

        //                 fncFormatInputs();
        //                 matPreloader("off");
        //                 fncSweetAlert("close", "", "");
        //                 fncNotie(3, "Error editing the registry");

        //             </script>';
        //             }

    
        //         }else{

        //             echo '<script>

        //             fncFormatInputs();
        //             matPreloader("off");
        //             fncSweetAlert("close", "", "");
        //             fncNotie(3, "Error en los campos ingresados");

        //         </script>';
                  
        //         }

        //     }else{
        //         echo '<script>

        //         fncFormatInputs();
        //         matPreloader("off");
        //         fncSweetAlert("close", "", "");
        //         fncNotie(3, "Error en el sistema");

        //     </script>';
        //     }

        //   }else{

        //     echo '<script>

        //     fncFormatInputs();
        //     matPreloader("off");
        //     fncSweetAlert("close", "", "");
        //     fncNotie(3, "Error en el sistema");

        // </script>';
            
        //   }
            
        // }

  
    }

}
