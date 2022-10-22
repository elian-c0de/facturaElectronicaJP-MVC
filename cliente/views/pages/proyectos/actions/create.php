<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO PROYECTOS -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

    <div class="card-header">
             <?php 
                require_once("controllers/proyectos.controllers.php");
                $create = new ProyectosController();
                $create ->create();
                ?>
        <div class="col-md-8 offset-md-2"> 

            <!-- NUMERO DE CODIGO PROYECTO -->
            <div class="form-group mt-2">
                <label>Codigo de Proyecto</label>
                <input 
                type="text"
                name="cod_proyecto"
                class="form-control"
                onchange="validateRepeat(event,'cod_proyecto','ecmp_proyecto','cod_proyecto', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[a-zA-Z0-9]{1,3}"
                required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback"> Please fill out this field.</div>
            </div>

            <!-- NOMBRE -->
            <div class="form-group mt-2">
                <label for="">Nombre</label>
                <input 
                type="text" 
                class="form-control"
                name="nom_proyecto"
                onchange="validateJS(event,'txt_descripcion_inventario')"
                pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}"
                required
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="proyectos" class="btn btn-light border text-left">Back</a>
                <button type="submit" class="btn bg-dark float-lg-right">Save</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO PROYECTOS -->

</div>