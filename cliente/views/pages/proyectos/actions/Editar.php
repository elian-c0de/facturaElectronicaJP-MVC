<?php
    if(isset($routesArray1[5])){
        // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
        $security = explode("~",base64_decode($routesArray1[5]));
        if($security[1] == $_SESSION["admin"]->token_usuario){

            $url = "ecmp_proyecto?linkTo=cod_empresa,cod_proyecto&equalTo=".$_SESSION['admin']->cod_empresa.",".trim($security[0]);
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
            window.location = "proyectos";
            </script>';
        }
        }else{
            echo '<script>
            window.location = "proyectos";
            </script>';
        }    
    }
?>

<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO PROYECTOS -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
<input type="hidden" value="<?php echo trim($admin->cod_proyecto)?>" name="idAdmin">

    <div class="card-header">
             <?php 
                require_once("controllers/proyectos.controllers.php");
                $create = new ProyectosController();
                $create ->edit(trim($admin->cod_proyecto));
                ?>
        <div class="col-md-8 offset-md-2"> 

            <!-- NUMERO DE CODIGO PROYECTO -->
            <div class="form-group mt-2">
                <label>Codigo de Proyecto</label>
                <input 
                type="text"
                name="cod_proyecto"
                value="<?php echo trim($admin->cod_proyecto)?>"
                class="form-control"
                onchange="validateRepeat(event,'cod_proyecto','ecmp_proyecto','cod_proyecto', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[a-zA-Z0-9]{1,3}"
                disabled>
                <div class="valid-feedback">V??lido</div>
                <div class="invalid-feedback">Por favor, rellene este campo.</div>
            </div>

            <!-- NOMBRE -->
            <div class="form-group mt-2">
                <label for="">Nombre</label>
                <input 
                type="text" 
                class="form-control"
                name="nom_proyecto"
                value="<?php echo trim($admin->nom_proyecto)?>"
                onchange="validateJS(event,'txt_descripcion_inventario')"
                pattern="[0-9A-Za-z???????????????????????? ]{1,255}"
                required>
                <div class="valid-feedback">V??lido</div>
                <div class="invalid-feedback">Por favor, rellene este campo</div>
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="proyectos" class="btn btn-light border text-left">Cancelar</a>
                <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO PROYECTOS -->

</div>