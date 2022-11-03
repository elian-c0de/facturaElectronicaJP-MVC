<?php

if (isset($routesArray1[5])) {

    $security = explode("~", base64_decode($routesArray1[5]));




    if ($security[3] == $_SESSION["admin"]->token_usuario) {


        $hola = array();
        $select = "ecmp_inventario.cod_empresa,ecmp_inventario.cod_inventario,ecmp_item_local.cod_establecimiento%20as%20cod_establecimiento_local,ecmp_item_local.cod_inventario%20as%20cod_inventario_local,ecmp_item_precio.cod_establecimiento%20as%20cod_establecimiento_precio,ecmp_item_precio.cod_inventario%20as%20cod_inventario_precio,ecmp_precio.cod_precio%20as%20cod_precio_precio,ecmp_item_precio.cod_precio,ecmp_precio.txt_descripcion,ecmp_inventario.val_costo,ecmp_item_precio.val_porcentaje_costo,ecmp_item_precio.val_precio,ecmp_inventario.sts_iva";
        $rel = "ecmp_inventario,ecmp_item_local,ecmp_item_precio,ecmp_precio";
        $type = "cod_empresa,cod_empresa,cod_empresa,cod_empresa";


        $url = "relations?rel=" . $rel . "&type=" . $type .  "&select=" . $select;
        $method = "GET";
        $fields = array();

        $data = CurlController::request($url, $method, $fields);


        if ($data->status == 200) {

            foreach ($data->result as $key => $value) {

                if ($value->cod_empresa == $_SESSION["admin"]->cod_empresa  && $value->cod_establecimiento_local == $value->cod_establecimiento_precio && $value->cod_inventario == $value->cod_inventario_local && $value->cod_inventario_local == $value->cod_inventario_precio && $value->cod_inventario_precio == $value->cod_inventario && $value->cod_precio == $value->cod_precio_precio) {

                    if ($value->cod_inventario == $security[0] && $value->cod_establecimiento_local == $security[2] && $value->cod_precio == $security[1]) {
                        array_push($hola, $value);
                    }
                }
            }

            $admin = $hola[0];
      
        } else {
            echo '<script>
    
        window.location = "itemsxestablecimiento";
        </script>';
        }
    } else {
        echo '<script>
    
        window.location = "itemsxestablecimiento";
        </script>';
    }
}


?>

<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $admin->cod_inventario ?>" name="idAdmin"> 
        <input type="hidden" value="<?php echo $admin->cod_establecimiento_local ?>" name="idAdmin1"> 
        <input type="hidden" value="<?php echo $admin->cod_precio ?>" name="idAdmin2"> 


        <div class="card-header">

            <?php
            require_once("controllers/itemsxestablecimiento.controller.php");
            $create = new ItemsxestablecimientoController();
            $create->editPrecio($admin->cod_inventario,$admin->cod_establecimiento_local,$admin->cod_precio);
            ?>
            <div class="col-md-8 offset-md-2">


                <!-- INICIO DISABLED NO SE VAN A TOCAR -->

                <!-- CODIGO NO SE ENVIA-->
                <div class="form-group mt-2">
                    <label>Codigo</label>
                    <input type="text" name="cod_inventario" value="<?php echo $admin->cod_precio ?>" class="form-control" disabled>
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

                <!-- DESCRIPCION NO SE ENVIA-->
                <div class="form-group mt-2">
                    <label>V/costo</label>
                    <input type="text"  name="val_costo" id="val_costo" value="<?php echo $admin->val_costo ?>" class="form-control" disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- DATOS A MODIFICAR -->
                
                <div class="form-group mt-2">
                    <label>% costo</label>
                    <input type="text" name="val_porcentaje_costo" onchange="recalcular()" id="val_porcentaje_costo" value="<?php echo $admin->val_porcentaje_costo ?>" class="form-control" 
                    pattern="[0-9]{1,18}([.][0-9]{1,5})?">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label>Precio</label>
                    <input type="text" name="val_precio" id="val_precio" onchange="recalcular()" value="<?php echo $admin->val_precio ?>" class="form-control" 
                    pattern="[0-9]{1,18}([.][0-9]{1,5})?">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                  <!-- CONTROLA SALDO -->
                  <div class="form-group mt-2">
                    <label for="">IVA</label>
                    <br>
                    <input type="checkbox" name="sts_iva" id="sts_iva" <?php echo $admin->sts_iva == 'A' ? 'checked' : '' ?>  data-on-text="SI" data-off-text="NO" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
                </div>


                <!-- DATOS A MODIFICAR -->

                <div class="form-group mt-2">
                    <label>V/IVA</label>
                    <input type="text" name="iva" id="iva" value="<?php echo $admin->sts_iva == 'A' ? $admin->val_precio*1.12 :''?>" class="form-control" disabled >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <div class="form-group mt-2">
                    <label>Precio Final</label>
                    <input type="text" name="valor_final" id="valor_final" value="<?php echo $admin->sts_iva == 'A' ? $admin->val_precio*1.12+$admin->val_precio : $admin->val_precio?>" class="form-control" >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>







            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="itemsxestablecimiento" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>

<script src="views/assets/custom/datatable/itemsxestablecimiento.datatable.js"></script>