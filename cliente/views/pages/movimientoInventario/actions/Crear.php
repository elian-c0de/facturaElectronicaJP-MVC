<?php
$url = "gen_usuario?equalTo=" . trim($_SESSION["admin"]->cod_establecimiento) . "," . trim($_SESSION["admin"]->cod_usuario) . "&linkTo=cod_establecimiento,cod_usuario";
$method = "GET";
$fields = array();
$response = CurlController::request($url, $method, $fields);

if ($response->status == 200) {
    $admin = $response->result[0];
    // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
} else {
    echo '<script>
          window.location = "movimientoInventario";
          </script>';
}
?>

<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" id="transactionForm" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php
            require_once("controllers/movimientoInventario.controller.php");
            $create = new MovimientoInventarioController();
            $create->create();
            ?>
            <div class="col-md-8 offset-md-2">

                <!-- VALIDAR CODIGO ETABLECIMIENTO -->
                <div class="form-group mt-2">
                    <?php
                    require_once("controllers/usuarios.controller.php");
                    $create = new UsuariosController();
                    $create->edit($admin->cod_empresa);
                    ?>
                    <label for="">Establecimiento:</label>
                    <input type="text" class="form-control" name="cod_establecimiento" id="cod_establecimiento" value="<?php echo $admin->cod_establecimiento ?>" disabled>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>



                <!-- CODIGO NUMERO DE MOVIMIENTO -->
                <div class="form-group mt-2">
                    <label for="">Número de movimiento:</label>
                    <input type="text" class="form-control" name="num_documento" id="num_documento" disabled>
                </div>

                <!-- TIPO DE MOVIMIENTO -->
                <div class="form-group mt-2">
                    <label for="">Tipo de movimineto:</label>
                    <?php
                    $tipo_concep = file_get_contents("views/assets/json/tipo_movimiento.json");
                    $tipo_concep = json_decode($tipo_concep, true);
                    ?>
                    <select class="form-control mb-3" id="tipoMovimiento" name="tipoMovimiento" placeholder="TipoMovimiento" required>
                        <option value>Seleccione Tipo de movimineto</option>
                        <?php foreach ($tipo_concep as $key => $value) : ?>
                            <option value="<?php echo $value["code"] ?>"> <?php echo $value["name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- FECHA -->
                <div class="form-group mt-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control" id="fechaActual">
                </div>

                <!-- DESCIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" name="txt_descripcion" class="form-control" onchange="validateJS(event,'txt_descripcionConcepto')" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,125}" required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por Favor, rellene este campo</div>
                </div>



                <!-- VALIDAR CODIGO INVENTARIO -->

                <div class="form-group mt-2">
                    <label>Código Inventario:</label>
                    <?php
                    // require_once("controllers/admins.controllers.php");

                    // $create = new MovimientoInventarioController();
                    // $tipo_precio = $create->cod_inventario();
                    // $tipo_precio = json_encode($tipo_precio);
                    // $tipo_precio = json_decode($tipo_precio, true);
                    require_once("controllers/inventario.controller.php");
                    $create = new InventarioController();
                    $tipo = $create->cod_inventario();
                    $tipo = json_encode($tipo);
                    $tipo = json_decode($tipo, true);
                    ?>
                    <select class="form-control select2 changeCountry" name="cod_inventario" id="cod_inventario" onchange="rellenar()">
                        <option value>Seleccione el Código Inventario</option>
                        <?php foreach ($tipo as $key => $value) : ?>
                            <option value="<?php echo $value["cod_inventario"] ?>">


                                <?php echo $value["cod_inventario"] ?>


                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" id="txt_descripcion" name="txt_descripcion" class="form-control">
                </div>

                <!-- CANTIDAD -->
                <div class="form-group mt-2">
                    <label for="">Cantidad:</label>
                    <input type="number" oninput="calcularSubtotal()" id="qtx_cantidad" name="qtx_cantidad" class="form-control">
                </div>

                <!-- COSTO -->
                <div class="form-group mt-2">
                    <label for="">Costo:</label>
                    <input type="number" id="val_costo" oninput="calcularSubtotal()" name="val_costo" class="form-control">
                </div>

                <!-- SUBTOTAL -->
                <div class="form-group mt-2">
                    <label for="">SubTotal:</label>
                    <input type="number" id="subtot" oninput="calcularSubtotal()" min="0" step="any" name="subtot" class="form-control" require="{2,0}" readonly>
                </div>

                <!-- IVA -->
                <div class="form-group mt-2">
                    <label for="">IVA:</label>
                    <input type="number" id="iva" name="iva" class="form-control" require="{1,2}" readonly>
                </div>

                <!-- TOTAL -->
                <div class="form-group mt-2">
                    <label for="">Total:</label>
                    <input type="number" id="total" name="total" class="form-control" require="{1,2}" readonly>
                </div>

                <!-- BOTON DE AÑADIR A LA TABLA INFERIOR -->
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <div class="form-group mt-3">
                            <button type="button" id="Guardar" class="btn bg-dark float-lg-right"><i class="bi bi-plus-lg"></i> Agregar</button>
                        </div>
                    </div>
                </div>

            </div>



            <!-- /.card-footer -->
            <div class="card-footer">
                <table id="movimientoInventariotable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Codigo Inventario</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Subtotal</th>
                            <th>IVA</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" style="text-align:right ">SubTotal 0%</td>
                            <td id="SubTotal0%" style="text-align:right;color:blue "> 0.00</td>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" style="text-align:right">SubTotal IVA</td>
                            <td id="SubTotalIVA" style="text-align:right;color:blue"></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" style="text-align:right">IVA</td>
                            <td id="IVA" style="text-align:right;color:blue"></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" style="text-align:right">Total</td>
                            <td id="Total" style="text-align:right;color:blue"></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <!-- <div class="card-footer text-right">
            <span class="mr-3">SubTotal 0%</span>
            <input type="number" id="SubTotal" value="0.00" name="SubTotal" class="mr-3" require="{1,2}" readonly>
        </div>
        <div class="card-footer text-right">
            <span class="mr-3">SubTotal IVA</span>
            <input type="number" id="SubTotalIVA" value="0.00" name="SubTotalIVA" class="mr-3" require="{1,2}" readonly>
        </div>
        <div class="card-footer text-right">
            <span class="mr-3">IVA</span>
            <input type="number" id="IVA" value="0.00" name="IVA" class="mr-3" require="{1,2}" readonly>
        </div>
        <div class="card-footer text-right">
            <span class="mr-3">Total</span>
            <input type="number" id="Total" value="0.00" name="Total" class="mr-3" require="{1,2}" readonly>
        </div> -->
            <!-- BOTONES DE REGRESAR Y GUARDAR -->
            <div class="card-header">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group mt-3">
                        <a href="movimientoInventario" class="btn btn-light border text-left">Cancelar</a>
                        <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN DE FORMULARIO RETENCION DE IMPUESTOS -->
</div>

<script src="views/assets/custom/datatable/CalculosmovimientoInventario.js"></script>
<script src="views/assets/custom/datatable/movimientoInventario.js"></script>