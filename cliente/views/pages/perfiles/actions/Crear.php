<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO PERFILES -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

    <div class="card-header">
             <?php 
                require_once("controllers/perfiles.controllers.php");
                $create = new PerfilesController();
                $create ->create();
                ?>
        <div class="col-md-8 offset-md-2"> 

            <!-- NUMERO DE CODIGO PERFIL -->
            <div class="form-group mt-2">
                <label>Codigo del Perfil</label>
                <input 
                type="text"
                name="cod_perfil"
                class="form-control"
                onchange="validateRepeat(event,'cod_perfil','gen_local','cod_perfil', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[a-zA-Z0-9]{1,6}"
                required>
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback">Por favor, rellene este campo</div>
            </div>

            <!-- NOMBRE -->
            <div class="form-group mt-2">
                <label for="">Descripcion</label>
                <input 
                type="text" 
                class="form-control"
                name="nom_perfil"
                onchange="validateJS(event,'nom_perfil')"
                pattern="[a-zA-Z0-9]{1,50}"
                required>
                <div class="valid-feedback">Válido</div>
                <div class="invalid-feedback">Por favor, rellene este campo</div>
            </div>

            <!-- ESTADO -->
            <div class="form-group mt-2">
                <label for="">Estado</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"  name="sts_perfil" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
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