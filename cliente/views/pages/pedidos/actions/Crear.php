<?php
//********REVISARRRRRR AQUI PORQUE NO DEJA INGRESAR AL CREAR SI EN LA BD LA TABLA ESTA VACIA */
$url = "ecmp_detalle_pedido?equalTo="  . trim($_SESSION["admin"]->cod_empresa) . "&linkTo=cod_empresa";
$method = "GET";
$fields = array();
$response = CurlController::request($url, $method, $fields);


if ($response->status == 200) {
    $admin = end($response->result);
} else {
    echo '<script>
          window.location = "pedidos";
          </script>';
}
?>

<div class="card card-dark card-outline">
    <form method="POST" id="transactionForm" class="needs-validation" novalidate>
        <div class="row">
            <div class="card-body">
                <div class="col-md-8 offset-md-2">
                    <!-- <div class="form-group mt-2">
                        <label for="">Número de pedido:</label>
                        <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback"> Por favor, rellene este campo</div>
                    </div> -->
                    <!-- VALIDAR NÚMERO DE PEDIDO -->
                    <div class="form-group mt-2">
                        <?php
                        require_once("controllers/pedidos.controller.php");
                        $create = new PedidosController();
                        $create->edit($admin->cod_empresa);
                        ?>

                        <label for="">Número de pedido:</label>
                        <input type="text" class="form-control" value="<?php echo $admin->num_pedido + 1 ?>" disabled>
                        <div class="valid-feedback">Válido</div>
                        <div class="invalid-feedback"> Por favor, rellene este campo</div>
                    </div>
                    <input type="hidden" class="form-control" name="num_documento" id="num_documento" value="<?php echo $admin->num_pedido + 1 ?>">

                    <!-- FECHA -->
                    <div class="form-group mt-2">
                        <label for="">Fecha:</label>
                        <input type="date" class="form-control" id="fec_documento" name="fec_documento">
                    </div>
                    <!-- DATOS DEL CLIENTE -->
                    <label for="">Cliente:</label>
                    <button type="button" class="btn btn-outline-info agregarproductos" data-toggle="modal" data-target="#agregarProductos">
                        <i class="bi bi-people-fill"></i>
                    </button>

                    <!-- Modal AGREGAR PRODUCTOS-->



                    <div class="form-group mt-2">
                        <div class="modal fade bd-example-modal-lg" id="agregarProductos" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Buscar Productos</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table id="clientesTable" class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>num_id</th>
                                                        <th>nom_persona_nombre</th>
                                                        <th>nom_apellido_rsocial</th>
                                                        <th>txt_direccion</th>
                                                        <th>num_telefono</th>
                                                        <th>txt_email</th>
                                                        <th>cod_precio</th>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal AGREGAR-->
                        <?php
                        require_once("controllers/pedidos.controller.php");
                        $create = new PedidosController();
                        $tipo = $create->cod_inventario();
                        $tipo = json_encode($tipo);
                        $tipo = json_decode($tipo, true);
                        ?>

                        <input type="text" class="form-control" name="num_id" id="num_id"><br>
                        <input type="text" class="form-control" name="NombreApellido" id="NombreApellido">
                    </div>

                    <!-- DIRECCION -->
                    <div class="form-group mt-2">
                        <label for="">Direccion</label>
                        <input type="text" class="form-control" onchange="validateJS(event,'txt_direccion_cliente')" pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,150}' name="txt_direccion" id="txt_direccion" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback"> Please fill out this field</div>
                    </div>

                    <!-- TELEFONO -->
                    <div class="form-group mt-2">
                        <label for="">Telefono</label>
                        <input type="text" class="form-control" name="num_telefono" id="num_telefono" onchange="validateJS(event,'num_telefono_cliente')" pattern="[-\\(\\)\\0-9 ]{1,15}" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback"> Please fill out this field</div>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group mt-2">
                        <label for="">Dirección E-Mail: </label>
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input type="text" class="form-control" pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" onchange="validateJS(event,'txt_email')" name="txt_email" id="txt_email" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"> Please fill out this field</div>
                        </div>
                    </div>

                    <!-- PRECIO -->
                    <div class="form-group mt-2">
                        <label for="">Precio:</label>
                        <select class="form-control mb-3" id="Precio" name="Precio" placeholder="Precio" required>
                            <option value="">PRECIO DE VENTA AL PÚBLICO</option>
                            <option value="">2DA OPCIÓN</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mt-2">
                    <?php
                    require_once("controllers/pedidos.controller.php");
                    $create = new PedidosController();
                    $tipo = $create->cod_inventario();
                    $tipo = json_encode($tipo);
                    $tipo = json_decode($tipo, true);
                    ?>
                    <label for="">Código:</label>
                    <select class="form-control select2 changeCountry" name="cod_inventario" id="cod_inventario" onchange="rellenar()">
                        <option value>Seleccione el Código Inventario</option>
                        <?php foreach ($tipo as $key => $value) : ?>
                            <option value="<?php echo $value["cod_inventario"] ?>">


                                <?php echo $value["cod_inventario"] ?>


                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>
                <!-- Descripción -->
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
                    <label for="">V/Unitario:</label>
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
                <!-- Existencia -->
                <div class="form-group mt-2">
                    <label for="">Existencia</label>
                    <input type="text" id="qtx_saldo" name="qtx_saldo" class="form-control">
                </div>
                
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <div class="form-group mt-3">
                            <button type="button" id="Guardar" class="btn bg-dark float-lg-right"><i class="bi bi-plus-lg"></i> Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <table id="pedidostable1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Codigo Inventario</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>V/Unitario</th>
                        <th>Subtotal</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Existencia</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="1" style="text-align:right ">SubTotal 0%</td>
                        <td id="SubTotal0%" style="text-align:right;color:blue "> 0.00</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="1" style="text-align:right">SubTotal IVA</td>
                        <td id="SubTotalIVA" style="text-align:right;color:blue"></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="1" style="text-align:right">IVA</td>
                        <td id="IVA" style="text-align:right;color:blue"></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="1" style="text-align:right">Total</td>
                        <td id="Total" style="text-align:right;color:blue"></td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="pedidos" class="btn btn-light border text-left">Cancelar</a>
                    <button type="button" onclick="obtenerDatos()" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>


<script src="views/assets/custom/datatable/pedidos.js"></script>
<script>
    function execDataTable() {


        var url = "ajax/data-clientes_Pedidos.php?text=&code=" + localStorage.getItem("cod");
        var columns = [{
                "data": "num_id"
            },
            {
                "data": "nom_persona_nombre"
            },
            {
                "data": "nom_apellido_rsocial"
            },
            {
                "data": "txt_direccion"
            },
            {
                "data": "num_telefono"
            },
            {
                "data": "txt_email"
            },
            {
                "data": "cod_precio"
            },
        ];


        var adminsTable = $("#clientesTable").DataTable({
            "select": {
                style: 'single'
            },
            "responsive": true,
            "lengthChange": true,
            "aLengthMenu": [
                [5, 10, 20, 50, 100],
                [5, 10, 20, 50, 100]
            ],
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url,
                "type": "POST"
            },
            "columns": columns,

            fnDrawCallback: function(oSettings) {
                if (oSettings.aoData.length == 0) {
                    $('.dataTables_paginate').hide();
                    $('.dataTables_info').hide();
                }
            }
        });
        var events = $('#cod_barras');


        adminsTable
            .on('select', function(e, dt, type, indexes) {
                var rowData = adminsTable.rows(indexes).data().toArray();
                document.getElementById("num_id").value = rowData[0].num_id;
                document.getElementById("NombreApellido").value = rowData[0].nom_persona_nombre + " " + rowData[0].nom_apellido_rsocial;
                document.getElementById("txt_direccion").value = rowData[0].txt_direccion;
                document.getElementById("num_telefono").value = rowData[0].num_telefono;
                document.getElementById("txt_email").value = rowData[0].txt_email;


                // events.prepend("value="+JSON.stringify(rowData[0].cod_inventario+""));
            })
            .on('deselect', function(e, dt, type, indexes) {
                var rowData = adminsTable.rows(indexes).data().toArray();
                document.getElementById("num_id").value = "";
                // document.getElementById("cod_inventario_hidden").value = "";
            });
    }

    execDataTable();
</script>