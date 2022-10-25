<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
                 <?php 
                    require_once("controllers/marca.controllers.php");
                    $create = new MarcaController();
                    $create ->create();
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE MARCA -->
                <div class="form-group mt-2">
                    <label>Código de Marca</label>
                    <input 
                    type="text"
                    name="cod_marca" 
                    class="form-control"
                    onchange="validateRepeat1(event,'cod_marca','ecmp_marca','cod_marca')"
                    pattern="[0-9]{1,3}"
                    required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- NOMBRE DE MARCA -->
                <div class="form-group mt-2">
                    <label for="">Nombre de Marca</label>
                    <input 
                    type="text"
                    name="nom_marca" 
                    class="form-control"
                    onchange="validateJS(event,'nom_marca')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,70}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="marcas" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>