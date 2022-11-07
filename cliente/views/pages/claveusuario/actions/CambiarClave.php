<?php
    $url = "gen_usuario?equalTo=" . trim($_SESSION["admin"]->cod_empresa) .",".trim($_SESSION["admin"]->cod_usuario). "&linkTo=cod_empresa,cod_usuario";
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
        <input type="hidden" value="<?php echo $admin->cod_usuario ?>" name="idAdmin"> 


        <div class="card-header">

            <?php
            require_once("controllers/usuarios.controller.php");
            $create = new UsuariosController();
            $create->editpass($admin->cod_usuario);
            ?>

            <div class="col-md-8 offset-md-2">

                <!-- USUARIO -->
                <div class="form-group mt-2">
                    <label>Usuario</label>
                    <input type="text" name="num_ruc" value="<?php echo trim($admin->cod_usuario) ?>"  class="form-control"
                    onchange="validateJS(event,'num_ruc')"
                    pattern = "[0-9]{1,13}"
                    disabled>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo.</div>
                </div>


                <!-- NOMBRE -->
                <div class="form-group mt-2">
                    <label>Nombre</label>
                    <input type="text" name="nom_empresa" value="<?php echo trim($admin->nom_usuario) ?>"  class="form-control"
                    onchange="validateJS(event,'nom_empresa')"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}"
                    disabled>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo.</div>
                </div>


                <!-- CLAVE ACTUAL -->
                <div class="form-group mt-2">
                    <label for="">Clave Actual</label>
                    <input type="password" class="form-control"
                    name="cod_passwd"
                    placeholder="Ingrese clave actual"
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- CLAVE NUEVA -->
                <div class="form-group mt-2">
                    <label for="">Clave Nueva</label>
                    <input type="password"
                    class="form-control"
                    onchange="validateJS(event,'cod_passwd')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{8,20}" 
                    name="txt_passwdnew"
                    placeholder="Ingrese nueva clave como minino 8 digitos"
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- CONFIRMACION -->
                <div class="form-group mt-2">
                    <label for="">Confirmacion</label>
                    <input type="password"
                    class="form-control"
                    onchange="validateJS(event,'cod_passwd')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{8,20}"
                    name="txt_passwdnewconfi"
                    placeholder="Confirme nueva clave"
                    required>
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