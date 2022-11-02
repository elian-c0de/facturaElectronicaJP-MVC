<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO PUNTOS DE EMISION-->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
                 <?php 
                    require_once("controllers/puntoemision.controllers.php");
                    $create = new PuntoemisionController();
                    $create ->create();
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE ESTABLECIMIENTO -->
                <div class="form-group mt-2">
					<label>Seleccione el Establecimiento</label>
					<?php 
                    $lista = $create -> getListaEstablecimiento();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_establecimiento"required>
						<option value>Seleccione el Establecimiento</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_establecimiento"] ?>" ><?php echo $value["cod_establecimiento"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback"> Por favor, rellene este campo</div>
	            </div>

                <!-- CODIGO DE PUNTO DE EMISION -->
                <div class="form-group mt-2">
                    <label>Código</label>
                    <input 
                    type="text"
                    name="cod_punto_emision" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_verif','gen_punto_emision','cod_punto_emision', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[0-9]{1,3}"
                    required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
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
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>

                <!-- CAJA -->
                <div class="form-group mt-2">
					<label>Seleccione la Caja</label>
					<?php 
                    $lista = $create -> getListaCajas();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_caja">
						<option value>Seleccione la Caja</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_caja"] ?>" ><?php echo $value["cod_caja"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
	            </div>

                <!-- VALIDAR CÓDIGO DE AMBIENTE -->
                <div class="form-group mt-2">
                    <label>Ambiente</label>
                    <?php 
                    $ambiente = file_get_contents("views/assets/json/tipo_ambientePuntoemision.json");
                    $ambiente = json_decode($ambiente, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_ambiente" >
                        <option value>Seleccione el Ambiente</option>
                        <?php foreach ($ambiente as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- VALIDAR TIPO EMISION -->
                <div class="form-group mt-2">
                    <label>Tipo de Emision</label>
                    <?php 
                    $tipopuntoemision = file_get_contents("views/assets/json/tipo_emisionPuntoemision.json");
                    $tipopuntoemision = json_decode($tipopuntoemision, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_tipo_emision" >
                        <option value>Seleccione Tipo de Emision</option>
                        <?php foreach ($tipopuntoemision as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO FACTURA -->
                <div class="form-group mt-2">
                    <label for="">Numero de Factura</label>
                    <input 
                    type="text"
                    name="num_factura" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO NOTA DE CREDITO -->
                <div class="form-group mt-2">
                    <label for="">Numero Nota de Credito</label>
                    <input 
                    type="text"
                    name="num_nota_credito" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO DE RETENCION -->
                <div class="form-group mt-2">
                    <label for="">Numero de Retencion</label>
                    <input 
                    type="text"
                    name="num_retencion" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO GUIA REMISION -->
                <div class="form-group mt-2">
                    <label for="">Numero Guia de Remision</label>
                    <input 
                    type="text"
                    name="num_guia" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- ESTADO TIPO FACTURACION -->
                <div class="form-group mt-2">
                    <label>Tipo de Facturacion</label>
                    <?php 
                    $tipofacturacion = file_get_contents("views/assets/json/tipo_facturacionPuntoemision.json");
                    $tipofacturacion = json_decode($tipofacturacion, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_tipo_facturacion" >
                        <option value>Seleccione Tipo de Facturacion</option>
                        <?php foreach ($tipofacturacion as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- ESTADO TIPO IMPRESION -->
                <div class="form-group mt-2">
                    <label>Tipo de Impresion</label>
                    <?php 
                    $tipoimpresion = file_get_contents("views/assets/json/tipo_impresionPuntoemision.json");
                    $tipoimpresion = json_decode($tipoimpresion, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_tipo_facturacion" >
                        <option value>Seleccione Tipo de Impresion</option>
                        <?php foreach ($tipoimpresion as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- ESTADO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" checked data-on-text="SI" data-off-text="NO"  name="sts_punto_emsion" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- NO FACTURA PRUEBA-->
                <div class="form-group mt-2">
                    <label for="">Numero de Factura Prueba</label>
                    <input 
                    type="text"
                    name="num_factura_prueba" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO NOTA DE CREDITO PRUEBA-->
                <div class="form-group mt-2">
                    <label for="">Numero Nota de Credito Prueba</label>
                    <input 
                    type="text"
                    name="num_nota_credito_prueba" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO DE RETENCION PRUEBA-->
                <div class="form-group mt-2">
                    <label for="">Numero de Retencion Prueba</label>
                    <input 
                    type="text"
                    name="num_retencion_prueba" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- NO GUIA REMISION PRUEBA-->
                <div class="form-group mt-2">
                    <label for="">Numero Guia de Remision Prueba</label>
                    <input 
                    type="text"
                    name="num_guia_prueba" 
                    class="form-control"
                    onchange="validateJS(event,'num_factura')"
                    pattern="[0-9]{1,9}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <!-- <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>
                
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="puntosEmision" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO PUNTO EMISION -->

</div>