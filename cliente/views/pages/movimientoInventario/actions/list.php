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



<div class="card">
  <div class="card-header">

    <input type="hidden" id="movimientoInventarioID" name="movimientoInventarioID">
    <input type="hidden" id="movimientoInventarioID1" name="movimientoInventarioID1">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="movimientoInventario/Crear"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem1"><i class='fas fa-trash-alt'></i></a>
      <a class="btn bg-green btn-small" href="movimientoInventario/XML"><i class="bi bi-filetype-xml"></i></a>
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
    <table id="movimientoInventarioTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Código Establecimiento</th>
          <th>Numero Documento</th>
          <th>Código Inventario</th>
          <th>Cantidad</th>
          <th>Costo</th>
          <th>Porcentaje</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/movimientoInventario.js"></script>