<?php

if (isset($routesArray1[5])) {
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~", base64_decode($routesArray1[5]));


    if ($security[2] == $_SESSION["admin"]->token_usuario) {




        $hola = array();
        $select = "ecmp_item_local.cod_establecimiento,ecmp_inventario.cod_empresa,ecmp_inventario.cod_inventario,ecmp_inventario.txt_descripcion,ecmp_item_local.sts_control_saldo,ecmp_item_local.sts_modifica_precio,ecmp_item_local.qtx_minimo,ecmp_item_local.qtx_maximo,ecmp_item_local.qtx_saldo,ecmp_inventario.val_costo,ecmp_item_local.val_descuento,ecmp_item_local.por_descuento,ecmp_item_local.sts_item_local,ecmp_item_local.cod_inventario%20as%20cod_inventario_local";
        $rel = "ecmp_inventario,ecmp_item_local";
        $type = "cod_empresa,cod_empresa";


        $url = "relations?rel=" . $rel . "&type=" . $type .  "&select=" . $select;
        $method = "GET";
        $fields = array();

        $data = CurlController::request($url, $method, $fields);



        if ($data->status == 200) {

            foreach ($data->result as $key1 => $value1) {

                if ($value1->cod_inventario == $value1->cod_inventario_local && $value1->cod_empresa == $_SESSION["admin"]->cod_empresa  && $value1->cod_establecimiento == $security[1] && $value1->cod_inventario == $security[0]) {
                    array_push($hola, $value1);
                }
            }









            $admin = $hola[0];
           

            // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
        } else {
            echo '<script>
    
        window.location = "inventario";
        </script>';
        }
    } else {
        echo '<script>
    
        window.location = "inventario";
        </script>';
    }
}


?>

<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $admin->cod_inventario ?>" name="idAdmin"> 
        <input type="hidden" value="<?php echo $admin->cod_establecimiento ?>" name="idAdmin1"> 


        <div class="card-header">

            <?php
            require_once("controllers/itemsxestablecimiento.controller.php");
            $create = new ItemsxestablecimientoController();
            $create->edit($admin->cod_inventario,$admin->cod_establecimiento);
            ?>
            <div class="col-md-8 offset-md-2">


                <!-- INICIO DISABLED NO SE VAN A TOCAR -->

                <!-- CODIGO NO SE ENVIA-->
                <div class="form-group mt-2">
                    <label>Codigo</label>
                    <input type="text" name="cod_inventario" value="<?php echo $admin->cod_establecimiento ?>" class="form-control" disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- DESCRIPCION NO SE ENVIA-->
                <div class="form-group mt-2">
                    <label>Descripcion</label>
                    <input type="text" name="txt_descripcion" value="<?php echo $admin->txt_descripcion ?>" class="form-control" disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                  <!-- FIN DISABLED NO SE VAN A TOCAR -->








                <!-- CONTROLA SALDO -->
                <div class="form-group mt-2">
                    <label for="">Controla Saldo</label>
                    <br>
                    <input type="checkbox" name="sts_control_saldo" <?php echo $admin->sts_control_saldo == 'A' ? 'checked' : '' ?> data-on-text="SI" data-off-text="NO" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
                </div>

                <!-- MODIFICA PRECIO -->
                <div class="form-group mt-2">
                    <label for="">Modifica Precio</label>
                    <br>
                    <input type="checkbox" name="sts_modifica_precio" <?php echo $admin->sts_modifica_precio == 'A' ? 'checked' : '' ?>  data-on-text="SI" data-off-text="NO" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
                </div>



                <!-- MINIMA EXISTENCIA -->
                <div class="form-group mt-2">
                    <label>Minima Existencia</label>
                    <input type="text" name="qtx_minimo" value="<?php echo $admin->qtx_minimo ?>" 
                    onchange="validateJS(event,'por_reten')"
                    pattern="[0-9]{1,3}([.][0-9]{1,2})?"
                    class="form-control" >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- MAXIMA EXISTENCIA -->
                <div class="form-group mt-2">
                    <label>Maxima Existencia</label>
                    <input type="text" name="qtx_maximo" value="<?php echo $admin->qtx_maximo ?>" 
                    class="form-control" 
                    onchange="validateJS(event,'por_reten')"
                    pattern="[0-9]{1,3}([.][0-9]{1,2})?"
                    required
                    >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>





                <!-- INICIO DISABLED NO SE VAN A TOCAR -->

                <!-- SALDO NO SE ENVIA -->
                <div class="form-group mt-2">
                    <label>Saldo</label>
                    <input type="text" name="qtx_saldo" value="<?php echo $admin->qtx_saldo ?>" class="form-control" disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- V/COSTO NO SE ENVIA -->
                <div class="form-group mt-2">
                    <label>V/costo</label>
                    <input type="text" name="val_costo" value="<?php echo $admin->val_costo ?>" class="form-control" disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- FIN DISABLED NO SE VAN A TOCAR -->









                <!-- Valor Descuento -->
                <div class="form-group mt-2">
                    <label>val_descuento</label>
                    <input type="text" name="val_descuento" value="<?php echo $admin->val_descuento ?>" class="form-control" 
                    onchange="validateJS(event,'por_reten')"
                    pattern="[0-9]{1,3}([.][0-9]{1,2})?">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- % Descuento -->
                <div class="form-group mt-2">
                    <label>V/costo</label>
                    <input type="text" name="por_descuento" value="<?php echo $admin->por_descuento ?>" class="form-control" 
                    onchange="validateJS(event,'por_reten')"
                    pattern="[0-9]{1,3}([.][0-9]{1,2})?">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>




                
                <!-- ESTADO -->
                <div class="form-group mt-2">
                    <label for="">Estado </label>
                    <br>
                    <input type="checkbox" name="sts_item_local" <?php echo $admin->sts_modifica_precio == 'A' ? 'checked' : '' ?> data-on-text="SI" data-off-text="NO" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
                </div>




            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="itemsxestablecimiento" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>

<script src="views/assets/custom/datatable/itemsxestablecimiento.datatable.js"></script>