<?php

//ASIGANACION DE FECHAS 
if (isset($_GET["start"]) && isset($_GET["end"])) {
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
} else {
  $between1 = date("Y-m-d", strtotime("-10 year", strtotime(date("Y-m-d"))));
  $between2 = date("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d"))));
}
//FIN ASIGANACION DE FECHAS 


?>
<!-- ELEMTNOS OCULTOS PARA OBTENER FECHAS -->
<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">




<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card-body">
          <table id="itemsxestablecimiento_precio" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>V/COSTO</th>
                <th>% COSTO</th>
                <th>PRECIO</th>
                <th>IVA</th>
                <th>V/IVA</th>
                <th>PRECIO FINAL</th>
                <th>actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="card">
  <div class="card-header">

    <!-- BOTONES SUPERIORES PARA CREAR Y HACER OTRAS COSAS -->

    <input type="hidden" id="inventarioID" name="inventarioID">



    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="itemsxestablecimiento/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem"><i class='fas fa-trash-alt'></i></a>
      <a class="btn bg-green btn-small" href="establecimientos/XML"><i class="bi bi-filetype-xml"></i></a>
      <a class="btn bg-block btn-outline-primary btn-small ml-5" href="inventario">Inventario</a>
      <a class="btn bg-block btn-outline-primary btn-small" href="itemsxestablecimiento">Items x Establecimiento</a>

      <!-- LINEA Y SUB LINEA -->
      <div class="form-group">
        <br>
        <?php
        require_once("controllers/establecimientos.controllers.php");
        $create = new EstablecimientosController();
        $tipo_precio = $create->establecimientos();
        $tipo_precio = json_encode($tipo_precio);
        $tipo_precio = json_decode($tipo_precio, true);
        ?>

        <select class="form-control select2 changeCountry" name="establecimiento" id="establecimiento" onchange="reload()" required>
          <option value>Seleccione Establecimiento</option>
          <?php foreach ($tipo_precio as $key => $value) : ?>
            <option value="<?php echo $value["cod_establecimiento"] ?>">

              <?php echo $value["txt_descripcion"] ?>

            </option>
          <?php endforeach ?>
        </select>
      </div>



    </h3>

    <!-- PARTE SUPERIOR DE LA TABLA -->
    <div class="card-tools">
      <div class="d-flex">

        <!-- ASIGANACION DE RANGOS POR FECHAS -->
        <div class="input-group">
          <button type="button" class="btn float-right" id="daterange-btn">
            <i class="far fa-calendar-alt mr-2"></i>
            <?php echo $between1 ?> - <?php echo $between2 ?>
            <i class="fas fa-caret-down ml-2"></i>
          </button>
        </div>

      </div>
    </div>
  </div>

  <!-- /.card-header -->
  <!-- TABLA DONDE SE VAN A MOSTRAR LOS DATOS -->
  <div class="card-body">
    <table id="itemsxestablecimientoTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Controla Saldo</th>
          <th>Modifica Precio</th>
          <th>Minima Existencia</th>
          <th>Maxima Existencia</th>
          <th>Saldo</th>
          <th>V/Costo</th>
          <th>Valor Descuento</th>
          <th>% Descuento</th>
          <th>Estado</th>
          <th></th>

        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/itemsxestablecimiento.datatable.js"></script>