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
            		<div class="invalid-feedback">Please fill out this field.</div>
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
                    <div class="invalid-feedback"> Please fill out this field.</div>
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
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- CAJA -->
                <div class="form-group mt-2">
                    <label for="">Caja</label>
                    <input 
                    type="text"
                    name="txt_descripcion" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descrip')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- VALIDAR CÓDIGO DE AMBIENTE -->
                <div class="form-group mt-2">
                    <label>Ambiente</label>
                    <?php 
                    $tipopuntoemision = file_get_contents("views/assets/json/tipo_ambientePuntoemision.json");
                    $tipopuntoemision = json_decode($tipopuntoemision, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_ambiente" required>
                        <option value>Seleccione Ambiente</option>
                        <?php foreach ($tipopuntoemision as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
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
                    <div class="invalid-feedback"> Please fill out this field</div>
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
                    <div class="invalid-feedback"> Please fill out this field</div>
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
                    <div class="invalid-feedback"> Please fill out this field</div>
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
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>
                
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="sublineaproducto" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>