<?php
//ASIGANACION DE FECHAS 
if (isset($_GET["start"]) && isset($_GET["end"])) {
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
} else {
  // d-m-Y  Paladines
  // m-d-Y  Ramirez
  $between1 = date("d-m-Y", strtotime("-10 year", strtotime(date("d-m-Y"))));
  $between2 = date("d-m-Y", strtotime("+1 day", strtotime(date("d-m-Y"))));
}
//FIN ASIGANACION DE FECHAS 
?>
<!-- ELEMTNOS OCULTOS PARA OBTENER FECHAS -->
<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">


<div class="card">
  <div class="card-header">
    <input type="hidden" id="pedidosID" name="pedidosID">
    <input type="hidden" id="pedidosID1" name="pedidosID1">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="pedidos/Crear"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem1"><i class='fas fa-trash-alt'></i></a>
      <a class="btn bg-green btn-small" href="pedidos/XML"><i class="bi bi-filetype-xml"></i></a>
    </h3>

    <!-- PARTE SUPERIOR DE LA TABLA -->
    <div class="card-tools">
      <div class="d-flex">

        <div class="input-group">
          <button type="button" class="btn btn-default float-right" id="daterangee-btn">
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
    <table id="pedidostable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Número Pedido</th>
          <th>Número Detalle</th>
          <th>Código Inventario</th>
          <th>Descripción</th>
          <th>V. Cantidad</th>
          <th>V. Unitario</th>
          <th>V. Porcentaje/IVA</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<script src="views/assets/custom/datatable/pedidos.js"></script>