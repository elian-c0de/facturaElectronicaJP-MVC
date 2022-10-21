<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php
            require_once("controllers/inventario.controller.php");
            $create = new InventarioController();
            $create->create();
            ?>
            <div class="col-md-8 offset-md-2">

                <!-- NUMERO DE IDENTIFICACION -->
                <div class="form-group mt-2">
                    <label>Codigo</label>
                    <input type="text" name="cod_inventario" 
                    class="form-control" onchange="validateRepeat(event,'cod_inventario','ecmp_inventario','cod_inventario', <?php echo $_SESSION['admin']->cod_empresa ?>)"
                     pattern="[-\\A-Z0-9]{1,30}" 
                     required
                     >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label>Codigo de barras</label>
                    <input type="text" name="cod_barras" 
                    class="form-control" onchange="validateRepeat(event,'cod_barras','ecmp_inventario','cod_barras', <?php echo $_SESSION['admin']->cod_empresa ?>)"
                     pattern="[-0-9]{1,30}" 
                     required
                     >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label>Descripcion</label>
                    <input type="text" name="txt_descripcion" 
                    class="form-control" onchange=" validateJS(event,'txt_descripcion_inventario')"
                     pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                     required
                     >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">IVA</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" name="sts_iva" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
                </div>


                <!-- VALIDAR TIPO DE IDENTIFICACION -->
                <div class="form-group mt-2">
                    <label>Tipo</label>
                    <?php
                    $tipo_iden = file_get_contents("views/assets/json/tipo_inventario.json");
                    $tipo_iden = json_decode($tipo_iden, true);
                    ?>
                    <select class="form-control select2 changeCountry" name="sts_tipo" required>
                        <option value>Seleccione Tipo de producto</option>
                        <?php foreach ($tipo_iden as $key => $value) : ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label>Existencia Total</label>
                    <input type="text" name="qtx_saldo" 
                        class="form-control" 
                        onchange="validateJS(event,'qtx_saldo')"
                     pattern="[0-9]{1,18}" 
                     required
                     >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label>V/costo</label>
                    <input type="text" name="val_costo" 
                        class="form-control" 
                        onchange="validateJS(event,'val_costo')"
                     pattern="[0-9]{1,18}([.][0-9]{1,2})?" 
                     required
                     >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- LINEA Y SUB LINEA -->
                <div class="form-group mt-2">
                    <label>LINEA Y SUB LINEA</label>
                    <?php
                    // require_once("controllers/admins.controllers.php");
                    $create = new InventarioController();
                    $tipo_precio = $create->linea_sublinea();
                    $tipo_precio = json_encode($tipo_precio);
                    $tipo_precio = json_decode($tipo_precio, true);
                    ?>

                    <select class="form-control select2 changeCountry" name="cod_linea" required>
                        <option value>Seleccione Precio Aplicado</option>
                        <?php foreach ($tipo_precio as $key => $value) : ?>
                            <option value="<?php echo $value["cod_linea"] ?>-<?php echo $value["cod_sublinea"] ?> ">

                            <?php echo $value["cod_linea"] ?> <?php echo $value["cod_sublinea"] ?> <?php echo $value["txt_descripcion"] ?>

                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>



                <div class="form-group mt-2">
                    <label>Marca</label>
                    <?php
                    // require_once("controllers/admins.controllers.php");
                    $create = new InventarioController();
                    $tipo_precio = $create->marca();
                    $tipo_precio = json_encode($tipo_precio);
                    $tipo_precio = json_decode($tipo_precio, true);
                    ?>

                    <select class="form-control select2 changeCountry" name="cod_marca" required>
                        <option value>Seleccione Precio Aplicado</option>
                        <?php foreach ($tipo_precio as $key => $value) : ?>
                            <option value="<?php echo $value["cod_marca"] ?>">

                           <?php echo $value["nom_marca"] ?>

                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>


                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" name="sts_inventario" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
                </div>
            






            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="inventario" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>