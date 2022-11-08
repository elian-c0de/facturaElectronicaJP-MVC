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
                    <input type="text" class="form-control" name="cod_establecimiento" id="cod_establecimiento" 
                    value="<?php echo $admin->cod_establecimiento?>" disabled>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>



                <!-- CODIGO NUMERO DE MOVIMIENTO -->
                <div class="form-group mt-2">
                    <label for="">Número de movimiento:</label>
                    <input type="text" class="form-control" require="[A-Za-z0-9]{1,}">
                </div>

                <!-- TIPO DE MOVIMIENTO -->
                <div class="form-group mt-2">
                    <label for="">Tipo de movimineto:</label>
                    <select class="form-control mb-3" id="tipoMovimiento" name="tipoMovimiento" placeholder="TipoMovimiento" required>
                        <option value="">Ingreso</option>
                        <option value="">Egreso</option>
                    </select>
                </div>

                <!-- FECHA -->
                <div class="form-group mt-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control">
                </div>

                <!-- DESCIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="card-header">
            <div class="col-md-8 offset-md-2">

                <!-- VALIDAR CODIGO INVENTARIO -->
                <div class="form-group mt-2">
                    <label for="">Código Inventario:</label>
                    <input type="text" id="codInven" name="codInven" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}" required>
                    <!-- <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" id="descrip" name="descrip" class="form-control">
                </div>

                <!-- CANTIDAD -->
                <div class="form-group mt-2">
                    <label for="">Cantidad:</label>
                    <input type="number" oninput="calcularSubtotal()" id="cant" name="cant" class="form-control" require="{1,2}">
                </div>

                <!-- COSTO -->
                <div class="form-group mt-2">
                    <label for="">Costo:</label>
                    <input type="number" id="cost" oninput="calcularSubtotal()" name="cost" class="form-control" require="{1,2}">
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
                            <button type="submit" id="Guardar" class="btn bg-dark float-lg-right"><i class="bi bi-plus-lg"></i> Agregar</button>
                        </div>
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
            </table>

        </div>
        <div class="card-footer text-right">
            <span class="mr-3">SubTotal 0%</span>
            <input type="number" id="total" value="0.00" name="total" class="mr-3" require="{1,2}" readonly>
        </div>
        <div class="card-footer text-right">
            <span class="mr-3">SubTotal IVA</span>
            <input type="number" id="total" value="0.00" name="total" class="mr-3" require="{1,2}" readonly>
        </div>
        <div class="card-footer text-right">
            <span class="mr-3">IVA</span>
            <input type="number" id="total" value="0.00" name="total" class="mr-3" require="{1,2}" readonly>
        </div>
        <div class="card-footer text-right">
            <span class="mr-3">Total</span>
            <input type="number" id="total" value="0.00" name="total" class="mr-3" require="{1,2}" readonly>
        </div>
        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="movimientoInventario" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN DE FORMULARIO RETENCION DE IMPUESTOS -->
</div>

<script src="views/assets/custom/datatable/CalculosmovimientoInventario.js"></script>