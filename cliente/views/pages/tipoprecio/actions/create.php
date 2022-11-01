<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
                 <?php 
                    require_once("controllers/tipoprecio.controllers.php");
                    $create = new TipoprecioController();
                    $create ->create();
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE PRECIO -->
                <div class="form-group mt-2">
                    <label>Código de Precio</label>
                    <input 
                    type="text"
                    name="cod_precio" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_pre','ecmp_precio','cod_precio', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[a-zA-Z0-9]{1,2}"
                    required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input 
                    type="text"
                    name="txt_descripcion" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descripcion')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,60}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- DEFECTO -->              
                <div class="form-group mt-2">
                    <label for="">Defecto</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_defecto" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- PRECIO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_precio" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="tipoprecio" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>