<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php 
                require_once("controllers/parametros.controllers.php");
                $create = new ParametrosController();
                $create ->create();
                ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE CONCEPTO -->
                <div class="form-group mt-2">
                    <label>Código de Parametro</label>
                    <input 
                    type="text"
                    name="cod_parametro" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_parametro','gen_control','cod_parametro', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[A-Z\\_]{1,10}"
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- NOMBRE DEL PARAMETRO -->
                <div class="form-group mt-2">
                    <label for="">Nombre del Parametro</label>
                    <input 
                    type="text"
                    name="nom_parametro" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descripcionParametro')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- VALOR DEL PARAMETRO -->
                <div class="form-group mt-2">
                    <label for="">Valor del Parametro</label>
                    <input 
                    type="text"
                    name="val_parametro" 
                    class="form-control"
                    onchange="validateJS(event,'valorParametro')"
                    pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\#\\?\\¿\\!\\¡\\:\\,\\.\\//\\'\\@\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}" 
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
                    <a href="parametros" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO PARAMETROS -->
</div>