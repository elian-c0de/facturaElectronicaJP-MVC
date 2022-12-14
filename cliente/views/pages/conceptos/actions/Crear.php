<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php 
                require_once("controllers/conceptos.controllers.php");
                $create = new ConceptosController();
                $create ->create();
                ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE CONCEPTO -->
                <div class="form-group mt-2">
                    <label>Código de Concepto</label>
                    <input 
                    type="text"
                    name="cod_concepto" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_concepto','srja_concepto','cod_concepto', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[0-9]{1,2}"
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
                    onchange="validateJS(event,'txt_descripcionConcepto')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,125}" 
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- FACTURACIÓN -->              
                <div class="form-group mt-2">
                    <label for="">Facturación</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_facturacion" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75" data-on-text="SI" data-off-text="NO"
                    >
                </div>

                <!-- VALIDAR TIPO DE CONCEPTO -->
                <div class="form-group mt-2">
                    <label>Tipo de Concepto</label>
                    <?php 
                    $tipo_concep = file_get_contents("views/assets/json/tipo_concepto.json");
                    $tipo_concep = json_decode($tipo_concep, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_tipo_concepto" >
                        <option value>Seleccione Tipo de Concepto</option>
                        <?php foreach ($tipo_concep as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Válido</div>
                </div>

                <!-- VALIDAR TIPO DE PROCESO -->
                <div class="form-group mt-2">
                    <label>Tipo de Proceso</label>
                    <?php 
                    $tipo_proces = file_get_contents("views/assets/json/tipo_proceso.json");
                    $tipo_proces = json_decode($tipo_proces, true);
                    ?>
                    <select class="form-control select2 changeCountry" name="sts_proceso" >
                        <option value>Seleccione Tipo de Concepto</option>
                        <?php foreach ($tipo_proces as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Válido</div>
                </div>

                <!-- AFECTA INVENTARIO -->
                <div class="form-group mt-2">
                    <label for="">Afecta Inventario</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_inventario" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75" data-on-text="SI" data-off-text="NO"
                    >
                </div>

                <!-- ESTADO DEL CONCEPTO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_concepto" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"  data-on-text="SI" data-off-text="NO"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="conceptos" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO CONCEPTOS -->
</div>