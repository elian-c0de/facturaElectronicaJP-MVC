<?php
    $url = "gen_usuario?equalTo=" . $_SESSION["admin"]->cod_empresa . "&linkTo=cod_empresa";
    $method = "GET";
    $fields = array();
    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
    $admin = $response->result[0];
    // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    } else {
    echo '<script>
        
            window.location = "home";
            </script>';
    }
?>

<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO USUARIOS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $admin->cod_empresa ?>" name="idAdmin"> 


        <div class="card-header">

            <?php
            require_once("controllers/usuarios.controller.php");
            $create = new UsuariosController();
            $create->edit($admin->cod_empresa);
            ?>

            <div class="col-md-8 offset-md-2">

                <!-- USUARIO -->
                <div class="form-group mt-2">
                    <label>Usuario</label>
                    <input type="text" name="num_ruc" value="<?php echo trim($admin->cod_usuario) ?>"  class="form-control"
                    onchange="validateJS(event,'num_ruc')"
                    pattern = "[0-9]{1,13}"
                    disabled
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo.</div>
                </div>


                <!-- NOMBRE -->
                <div class="form-group mt-2">
                    <label>Nombre</label>
                    <input type="text" name="nom_empresa" value="<?php echo trim($admin->nom_usuario) ?>"  class="form-control"
                    onchange="validateJS(event,'nom_empresa')"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}"
                    disabled
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo.</div>
                </div>


                <!-- CLAVE ACTUAL -->
                <div class="form-group mt-2">
                    <label for="">Clave Actual</label>
                    <input type="password" class="form-control" name="cod_passwd" 
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,15}"
                    onchange="validateJS(event,'nom_abreviado')"
                    required
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- CLAVE NUEVA -->
                <div class="form-group mt-2">
                    <label for="">Clave Nueva</label>
                    <input type="text" class="form-control"
                     name="txt_direccion" 
                     pattern= '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}'
                     onchange="validateJS(event,'txt_direccion')"
                     required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- CONFIRMACION -->
                <div class="form-group mt-2">
                    <label for="">Confirmacion</label>
                    <input type="phone" class="form-control"
                    pattern='[-\\(\\)\\0-9 ]{1,10}' 
                    onchange="validateJS(event,'num_telefono')"
                    name="num_telefono" 
                    required
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

            <!-- BOTONES DE REGRESAR Y GUARDAR -->
            <div class="card-header">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group mt-3">
                        <a href="claveusuario" class="btn btn-light border text-left">Cancelar</a>
                        <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                    </div>
                </div>
            </div>
    </form>
    <!-- FIN DE FORMULARIO USUARIO -->

</div>