<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php 
                require_once("controllers/formadepago.controllers.php");
                $create = new FormadepagoController();
                $create ->create();
                ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE FORMA DE PAGO -->
                <div class="form-group mt-2">
                    <label>Código Formas de Pago</label>
                    <input 
                    type="text"
                    name="cod_forma_pago" 
                    class="form-control"
                    onchange="validateRepeat1(event,'cod_for_pag','gen_forma_pago','cod_forma_pago')"
                    pattern="[A-Z]{1,2}"
                    required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input 
                    type="text"
                    name="nom_forma_pago" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descripcionforma_pago')"
                    pattern="[-//0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- DEFECTO -->              
                <div class="form-group mt-2">
                    <label for="">Defecto</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_defecto" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- VALIDAR CÓDIGO DE SRI -->
                <div class="form-group mt-2">
                    <label>S.R.I</label>
                    <?php 
                    $tipoformadepago = file_get_contents("views/assets/json/tipo_SRIformadepago.json");
                    $tipoformadepago = json_decode($tipoformadepago, true);
                    ?>
                    <select class="form-control changeCountry" name="cod_sri" required>
                        <option value>Seleccione S.R.I</option>
                        <?php foreach ($tipoformadepago as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!-- ESTADO DE FORMA DE PAGO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_forma_pago" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- VALIDAR TIPO DE RETENCIÓN -->
                <div class="form-group mt-2">
                    <label>Retención</label>
                    <?php 
                    $tiporetencionformadepago = file_get_contents("views/assets/json/tipo_Retencionformadepago.json");
                    $tiporetencionformadepago = json_decode($tiporetencionformadepago, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_retencion" required>
                        <option value>Seleccione la Retención</option>
                        <?php foreach ($tiporetencionformadepago as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="formadepago" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO CAJAS -->
</div>