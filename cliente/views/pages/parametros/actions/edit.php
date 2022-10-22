<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "gen_control?linkTo=cod_empresa,cod_parametro&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        //Cntrl+shift+Q
        //echo '<pre>'; print_r($response); echo '</pre>';
        

    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "parametros";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "parametros";
        </script>';
    }


    
    
}


?>



<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_parametro?>" name="idAdmin"> 
        <div class="card-header">
            <?php 
                require_once("controllers/parametros.controllers.php");
                $create = new ParametrosController();
                $create ->edit($admin->cod_parametro);
                ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE CONCEPTO -->
                <div class="form-group mt-2">
                    <label>Código de Parametro</label>
                    <input 
                    type="text"
                    name="cod_parametro"
                    value="<?php echo $admin->cod_parametro?>" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_parametro','gen_control','cod_parametro', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[A-Z\\_]{1,10}"
                    disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- NOMBRE DEL PARAMETRO -->
                <div class="form-group mt-2">
                    <label for="">Nombre del Parametro</label>
                    <input 
                    type="text"
                    name="nom_parametro" 
                    value="<?php echo $admin->nom_parametro?>" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descripcionParametro')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    disabled>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- VALOR DEL PARAMETRO -->
                <div class="form-group mt-2">
                    <label for="">Valor del Parametro</label>
                    <input 
                    type="text"
                    name="val_parametro" 
                    value="<?php echo $admin->val_parametro?>"
                    class="form-control"
                    onchange="validateJS(event,'valorParametro')"
                    pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\#\\?\\¿\\!\\¡\\:\\,\\.\\//\\'\\@\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="parametros" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO PARAMETROS -->
</div>