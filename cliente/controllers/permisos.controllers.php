<?php
class PermisosController{

    public function perfiles(){
        $url = "gen_perfil?linkTo=cod_empresa,sts_perfil&equalTo=".$_SESSION["admin"]->cod_empresa.",A";
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url,$method,$fields)->result;
        return $response;
    }

    public function edit(){

        //editar 1
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


            }

            
        }
        
        //editar 2
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",D_02";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_inventario"])){
                    $_POST["sts_inventario"] = "A";
                }else{
                    $_POST["sts_inventario"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_inventario"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=D_02";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 3
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_01";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_mov_inventario"])){
                    $_POST["sts_mov_inventario"] = "A";
                }else{
                    $_POST["sts_mov_inventario"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_mov_inventario"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_01";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 4
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_02";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_pedidos"])){
                    $_POST["sts_pedidos"] = "A";
                }else{
                    $_POST["sts_pedidos"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_pedidos"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_02";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 5
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_03";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_facturacion"])){
                    $_POST["sts_facturacion"] = "A";
                }else{
                    $_POST["sts_facturacion"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_facturacion"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_03";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 6
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_04";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_nota_credito"])){
                    $_POST["sts_nota_credito"] = "A";
                }else{
                    $_POST["sts_nota_credito"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_nota_credito"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_04";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 7
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_05";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_caja"])){
                    $_POST["sts_caja"] = "A";
                }else{
                    $_POST["sts_caja"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_caja"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_05";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 8
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_06";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_gastos_compras"])){
                    $_POST["sts_gastos_compras"] = "A";
                }else{
                    $_POST["sts_gastos_compras"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_gastos_compras"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_06";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 9
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_07";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_comp_retencion"])){
                    $_POST["sts_comp_retencion"] = "A";
                }else{
                    $_POST["sts_comp_retencion"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_comp_retencion"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_07";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 10
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",O_08";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_guia_remision"])){
                    $_POST["sts_guia_remision"] = "A";
                }else{
                    $_POST["sts_guia_remision"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_guia_remision"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=O_08";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 11
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_01";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_kardex_inventario"])){
                    $_POST["sts_kardex_inventario"] = "A";
                }else{
                    $_POST["sts_kardex_inventario"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_kardex_inventario"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_01";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }
        
        //editar 12
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_02";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_comp_emitidos"])){
                    $_POST["sts_comp_emitidos"] = "A";
                }else{
                    $_POST["sts_comp_emitidos"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_comp_emitidos"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_02";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 13
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_03";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_info_ventas_gastos"])){
                    $_POST["sts_info_ventas_gastos"] = "A";
                }else{
                    $_POST["sts_info_ventas_gastos"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_info_ventas_gastos"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_03";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 14
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_04";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_precios"])){
                    $_POST["sts_precios"] = "A";
                }else{
                    $_POST["sts_precios"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_precios"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_04";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 15
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_05";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_historial_cliente"])){
                    $_POST["sts_historial_cliente"] = "A";
                }else{
                    $_POST["sts_historial_cliente"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_historial_cliente"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_05";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 16
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_06";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_top_ventas"])){
                    $_POST["sts_top_ventas"] = "A";
                }else{
                    $_POST["sts_top_ventas"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_top_ventas"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_06";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

        //editar 17
        if(isset($_POST["perfil"])){

            $url = "gen_perfil_opcion?linkTo=cod_perfil,cod_opcion&equalTo=".trim($_POST["perfil"]).",R_07";
            
            $method = "GET";
            $fields = array();
    
            $response = CurlController::request($url,$method,$fields);
           
            if($response->status == 200){

                if(isset($_POST["sts_ats_sri"])){
                    $_POST["sts_ats_sri"] = "A";
                }else{
                    $_POST["sts_ats_sri"] = "C";
                    
                }

                $data = 
                    "&sts_perfil_opcion=".trim($_POST["sts_ats_sri"]);

                $url = "gen_perfil_opcion?id=".trim($_POST["perfil"])."&nameId=cod_perfil&token=".$_SESSION["admin"]->token_usuario."&nameId2=cod_empresa&id2=".$_SESSION['admin']->cod_empresa."&nameId3=cod_opcion&id3=R_07";
         
                $method = "PUT";
                $fields = $data;
                
                $response = CurlController::request($url,$method,$fields);


            }

            
        }

  
    }

}
