<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "gen_perfil?linkTo=cod_empresa,cod_perfil&equalTo=".$_SESSION['admin']->cod_empresa.",".trim($security[0]);
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        // echo '<pre>'; print_r($response); echo '</pre>';
        // return;

    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "perfiles";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "perfiles";
        </script>';
    }


    
    
}


?>




<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO PERFILES -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
<input type="hidden" value="<?php echo trim($admin->cod_perfil)?>" name="idAdmin">

    <div class="card-header">
             <?php 
                require_once("controllers/perfiles.controllers.php");
                $create = new PerfilesController();
                $create ->edit(trim($admin->cod_perfil));
                ?>
        <div class="col-md-8 offset-md-2"> 

            <!-- NUMERO DE CODIGO PERFIL -->
            <div class="form-group mt-2">
                <label>Codigo del Perfil</label>
                <input 
                type="text"
                name="cod_perfil"
                value="<?php echo trim($admin->cod_perfil)?>"
                class="form-control"
                onchange="validateRepeat(event,'cod_perfil','gen_local','cod_perfil', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[a-zA-Z0-9]{1,6}"
                required>
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback">Por favor, rellene este campo</div>
            </div>

            <!-- NOMBRE -->
            <div class="form-group mt-2">
                <label for="">NOMBRE</label>
                <input 
                type="text" 
                class="form-control"
                name="nom_perfil"
                value="<?php echo trim($admin->nom_perfil)?>"
                onchange="validateJS(event,'nom_perfil')"
                pattern="[a-zA-Z0-9 ]{1,50}"
                required>
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback">Por favor, rellene este campo</div>
            </div>

            <!-- ESTADO -->
            <div class="form-group mt-2">
                <label for="">Estado</label>
                <br>
                <input type="checkbox"<?php echo $admin->sts_perfil == 'A' ? 'checked':''?> data-on-text="SI" data-off-text="NO" name="sts_perfil" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="perfiles" class="btn btn-light border text-left">Cancelar</a>
                <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO PERFILES -->

</div>