<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "gen_local?linkTo=cod_empresa,cod_establecimiento&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        // echo '<pre>'; print_r($response); echo '</pre>';

    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "establecimientos";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "establecimientos";
        </script>';
    }
}


?>




<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO ESTABLECIMIENTOS -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
<input type="hidden" value="<?php echo $admin->cod_establecimiento?>" name="idAdmin">

    <div class="card-header">
             <?php 
                require_once("controllers/establecimientos.controllers.php");
                $create = new EstablecimientosController();
                $create ->edit($admin->cod_establecimiento);
                ?>
        <div class="col-md-8 offset-md-2"> 

            <!-- NUMERO DE CODIGO ESTABLECIMIENTO -->
            <div class="form-group mt-2">
                <label>Codigo de Establecimiento</label>
                <input 
                type="text"
                name="cod_establecimiento"
                value="<?php echo $admin->cod_establecimiento?>"
                class="form-control"
                onchange="validateRepeat(event,'cod_establecimiento','gen_local','cod_establecimiento', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[a-zA-Z0-9]{1,3}"
                disabled>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback"> Please fill out this field.</div>
            </div>


            <!-- DESCRIPCION -->
            <div class="form-group mt-2">
                <label for="">Descripcion</label>
                <input 
                type="text" 
                class="form-control"
                name="txt_descripcion"
                value="<?php echo $admin->txt_descripcion?>"
                onchange="validateJS(event,'txt_descripcion_inventario')"
                pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}"
                required
                >
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback"> Por favor, rellene este campo</div>
            </div>

            <!-- DIRECCION -->
            <div class="form-group mt-2">
                <label for="">Direccion</label>
                <input type="text" class="form-control"
                onchange="validateJS(event,'txt_descripcion_inventario')"
                pattern='[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}' 
                name="txt_direccion"
                value="<?php echo $admin->txt_direccion?>"
                required
                >
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback"> Por favor, rellene este campo</div>
            </div>

            <!-- MATRIZ -->
            <div class="form-group mt-2">
                <label for="">Matriz</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"<?php echo $admin->sts_matriz == 'A' ? 'checked':''?>data-on-text="SI" data-off-text="NO"  name="sts_matriz" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>

            <!-- ESTADO -->
            <div class="form-group mt-2">
                <label for="">Estado</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"<?php echo $admin->sts_local == 'A' ? 'checked':''?> data-on-text="SI" data-off-text="NO"  name="sts_local" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="establecimientos" class="btn btn-light border text-left">Cancelar</a>
                <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO ESTABLECIMIENTOS -->

</div>