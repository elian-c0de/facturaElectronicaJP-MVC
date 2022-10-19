
<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
<form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

    <div class="card-header">
             <?php 
                require_once("controllers/clientes.controllers.php");
                $create = new ClientesController();
                $create ->create();
                ?>
        <div class="col-md-8 offset-md-2">

        <!-- VALIDAR TIPO DE IDENTIFICACION -->
            <div class="form-group mt-2">
                <label>Tipo de identificacion</label>
                <?php 
                $tipo_iden = file_get_contents("views/assets/json/tipo_iden.json");
                $tipo_iden = json_decode($tipo_iden, true);
                ?>
                <select class="form-control select2 changeCountry" name="cod_tipo_id" required>
                    <option value>Seleccione Tipo de identificacion</option>
                    <?php foreach ($tipo_iden as $key => $value): ?>
                        <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>	
                    <?php endforeach ?>
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>  

            <!-- NUMERO DE IDENTIFICACION -->
            <div class="form-group mt-2">
                <label>No. de Identificacion</label>
                <input 
                type="text"
                name="num_id" 
                class="form-control"
                onchange="validateRepeat(event,'number','ecmp_cliente','num_id', <?php echo $_SESSION['admin']->cod_empresa?>)"
                pattern="[0,1,2,3,4,5,6,7,8,9]{1,13}"
                required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback"> Please fill out this field.</div>
            </div>


            <!-- Razon Social -->
            <div class="form-group mt-2">
                <label for="">Apellido/Razon Social</label>
                <input 
                type="text" 
                class="form-control"
                name="nom_apellido_rsocial"
                pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}" 
                required
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <!-- CODIGO DE USUARIO -->
            <div class="form-group mt-2">
                <label for="">Nombres</label>
                <input type="text" 
                class="form-control"
                required
                name="nom_persona_nombre"
                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}" 
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <!-- DIRECCION -->
            <div class="form-group mt-2">
                <label for="">Direccion</label>
                <input type="text" class="form-control"
                pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}' 
                name="txt_direccion"
                required
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <div class="form-group mt-2">
                <label for="">Telefono</label>
                <input type="text" class="form-control"
                name="num_telefono"
                pattern="[-\\(\\)\\0-9 ]{1,15}"
                required
                >
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <div class="form-group mt-2">
                <label for="">Correo Electronico</label>
                <input type="text" class="form-control"
                pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                name="txt_email"
                required
                >
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"> Please fill out this field</div>
            </div>

            <div class="form-group mt-2">
                <label>Precio Aplicado</label>
                <?php 
                // require_once("controllers/admins.controllers.php");
                $create = new ClientesController();
                $tipo_precio = $create -> tipoprecio();
                $tipo_precio = json_encode($tipo_precio);
                $tipo_precio = json_decode($tipo_precio,true);
                ?>

                <select class="form-control select2 changeCountry" name="cod_precio" required>
                    <option value>Seleccione Precio Aplicado</option>
                    <?php foreach ($tipo_precio as $key => $value): ?>
                        <option value="<?php echo $value["cod_precio"] ?>"> <?php echo $value["txt_descripcion"] ?></option>	
                    <?php endforeach ?>
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>  
            <div class="form-group mt-2">
                <label for="">Estado</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"  name="sts_cliente" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>

            <div class="form-group mt-2">
                <label for="">Proveedor</label>
                <br>
                <!-- <input type="text" class="form-control" -->
                <input type="checkbox"  name="sts_proveedor"  data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                >
            </div>
        </div>
    </div>

    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
        <div class="col-md-8 offset-md-2">
            <div class="form-group mt-3">
                <a href="admins" class="btn btn-light border text-left">Back</a>
                <button type="submit" class="btn bg-dark float-lg-right">Save</button>
            </div>
        </div>
    </div>
</form>
<!-- FIN DE FORMULARIO CAJAS -->

</div>