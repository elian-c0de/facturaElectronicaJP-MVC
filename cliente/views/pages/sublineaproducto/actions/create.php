<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
                 <?php 
                    require_once("controllers/sublineaproducto.controllers.php");
                    $crear = new SubLineasdeproductoController();
                    $crear ->create();
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE LINEA -->
                <div class="form-group mt-2">
					<label>Seleccione el codigo de linea</label>
					<?php 
                    require_once("controllers/lineasdeproducto.controllers.php");
                    $create = new LineasdeproductoController();
                    $lista = $create -> getListaLinea();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_linea" id="linea" required>
						<option value>Seleccione Precio Aplicado</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_linea"] ?>" <?php echo $key == 0 ?"selected":"" ?> ><?php echo $value["cod_linea"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
	            </div>

                <!-- CODIGO DE SUBLINEA -->
                <div class="form-group mt-2">
                    <label>Código</label>
                    <input 
                    type="text"
                    name="cod_sublinea" 
                    class="form-control"
                    onchange="validateRepeatSublinea(event,'cod_verif','ecmp_linea','cod_sublinea', <?php echo $_SESSION['admin']->cod_empresa?>)"
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