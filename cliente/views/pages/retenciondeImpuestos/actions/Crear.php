<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php 
                require_once("controllers/retenciondeImpuestos.controllers.php");
                $create = new RetenciondeImpuestosController();
                $create ->create();
                ?>
            <div class="col-md-8 offset-md-2">

                <!-- VALIDAR CODIGO IMPUESTO -->
                <div class="form-group mt-2">
                    <label>Impuesto</label>
                    <?php 
                    $tipocodigoImpuesto = file_get_contents("views/assets/json/tipo_codigoImpuesto.json");
                    $tipocodigoImpuesto = json_decode($tipocodigoImpuesto, true);
                    ?>
                    <select class="form-control changeCountry" name="cod_impuesto" required>
                        <option value>Seleccione el Impuesto</option>
                        <?php foreach ($tipocodigoImpuesto as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- CODIGO RETENCIÓN -->
                <div class="form-group mt-2">
                    <label>Código Retención</label>
                    <input 
                    type="text"
                    name="cod_retencion" 
                    class="form-control"
                    onchange="validateRepeat1(event,'cod_rete','ecmp_impuesto','cod_retencion')"
                    pattern="[a-zA-Z1-9]{1,5}"
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
                    onchange="validateJS(event,'descrip_formapag')"
                    pattern="[-//%0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                 <!-- PORCENTAJE RETENCIÓN -->
                 <div class="form-group mt-2">
                    <label for="">Porcentaje Retención</label>
                    <input 
                    type="text"
                    name="por_retencion" 
                    class="form-control"
                    onchange="validateJS(event,'por_reten')"
                    pattern="[0-9]{1,3}([.][0-9]{1,2})" 
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>

                <!-- ESTADO DE FORMA DE PAGO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  name="sts_impuesto" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75" data-on-text="SI" data-off-text="NO"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="retenciondeImpuestos" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO RETENCION DE IMPUESTOS -->
</div>