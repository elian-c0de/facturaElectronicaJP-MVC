<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "srja_caja?linkTo=cod_empresa,cod_caja&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        // echo '<pre>'; print_r($response); echo '</pre>';

    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "cajas";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "cajas";
        </script>';
    }


    
    
}


?>




<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
<input type="hidden" value="<?php echo $admin->cod_caja?>" name="idAdmin">

    <div class="card-header">
             <?php 
                require_once("controllers/cajas.controllers.php");
                $create = new CajasController();
                $create ->edit($admin->cod_caja);
                ?>
        <div class="col-md-8 offset-md-2">

            <!-- NUMERO DE CODIGO CAJA -->
            <div class="form-group mt-2">
                <label>Codigo de Caja</label>
                <input 
                type="text"
                name="cod_caja"
                value="<?php echo $admin->cod_caja?>"
                class="form-control"
                onchange="validateRepeat(event,'cod_caja','srja_caja','cod_caja', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[0-9]{1,2}"
                required>
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback">Por favor, rellene este campo.</div>
            </div>

            <!-- DESCRIPCION -->
            <div class="form-group mt-2">
                <label for="">Descripcion</label>
                <input 
                type="text" 
                class="form-control"
                name="txt_descripcion"
                value="<?php echo $admin->txt_descripcion?>"
                onchange="validateJS(event,'nom_empresa')"
                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}}"
                required
                >
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback">Por favor, rellene este campo</div>
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="cajas" class="btn btn-light border text-left">Cancelar</a>
                <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO CAJAS -->

</div>