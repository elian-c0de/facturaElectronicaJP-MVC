
<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

    <div class="card-header">
             <?php 
                require_once("controllers/establecimientos.controllers.php");
                $create = new EstablecimientosController();
                $create ->create();
                ?>
        <div class="col-md-8 offset-md-2"> 

            <!-- NUMERO DE CODIGO ESTABLECIMIENTO -->
            <div class="form-group mt-2">
                <label>Codigo de Establecimiento</label>
                <input 
                type="text"
                name="cod_establecimiento"
                class="form-control"
                onchange="validateRepeat(event,'cod_establecimiento','gen_local','cod_establecimiento', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[a-zA-Z0-9]{1,3}"
                required>
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
                onchange="validateJS(event,'txt_descripcion_inventario')"
                pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}"
                required
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <!-- DIRECCION -->
            <div class="form-group mt-2">
                <label for="">Direccion</label>
                <input type="text" class="form-control"
                onchange="validateJS(event,'txt_descripcion_inventario')"
                pattern='[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}' 
                name="txt_direccion"
                required
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <!-- MATRIZ -->
            <div class="form-group mt-2">
                <label for="">Matriz</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"  name="sts_matriz" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>

            <!-- ESTADO -->
            <div class="form-group mt-2">
                <label for="">Estado</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"  name="sts_local" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="establecimientos" class="btn btn-light border text-left">Back</a>
                <button type="submit" class="btn bg-dark float-lg-right">Save</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO ESTABLECIMIENTOS -->

</div>