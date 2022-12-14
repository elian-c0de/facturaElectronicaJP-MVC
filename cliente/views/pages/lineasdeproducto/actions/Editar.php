<?php

    if(isset($routesArray1[5])){
        // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
        $security = explode("~",base64_decode($routesArray1[5]));
        
        if($security[2] == $_SESSION["admin"]->token_usuario){

            $url = "ecmp_linea?linkTo=cod_empresa,cod_linea,cod_sublinea&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0].",".$security[1];
            $method = "GET";
            $fields = array();
        
            $response = CurlController::request($url,$method,$fields);
            
        if($response->status == 200){
            $admin = $response->result[0];
            // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
        }else{
            echo '<script>
        
            window.location = "lineasdeproducto";
            </script>';
        }

        }else{
            echo '<script>
        
            window.location = "lineasdeproducto";
            </script>';
        }
    
}


?>

<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_linea?>" name="idAdmin">
    <input type="hidden" value="<?php echo $admin->cod_sublinea?>" name="idAdmin2">

        <div class="card-header">
                 <?php 
                    require_once("controllers/lineasdeproducto.controllers.php");
                    $create = new LineasdeproductoController();
                    $create ->edit($admin->cod_linea,$admin->cod_sublinea);
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE PRECIO -->
                <div class="form-group mt-2">
                    <label>Código</label>
                    <input 
                    value="<?php echo$admin->cod_linea?>" 
                    type="text"
                    name="cod_linea" 
                    class="form-control"
                    disabled>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input
                    value="<?php echo$admin->txt_descripcion?>" 
                    type="text"
                    name="txt_descripcion" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descrip')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="lineasdeproducto" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>