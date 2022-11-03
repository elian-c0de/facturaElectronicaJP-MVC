<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
                 <?php 
                    require_once("controllers/lineasdeproducto.controllers.php");
                    $create = new LineasdeproductoController();
                    $create ->create();
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE PRECIO -->
                <div class="form-group mt-2">
                    <label>Código</label>
                    <input 
                    type="text"
                    name="cod_linea" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_verif','ecmp_linea','cod_linea', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[0-9]{1,3}"
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input 
                    type="text"
                    name="txt_descripcion" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descrip')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
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
                    <a href="lineasdeproducto" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>