<?php
if(isset($_GET["start"]) && isset($_GET["end"])){
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
}else{
  $between1 = date("Y-m-d",strtotime("-29 day", strtotime(date("Y-m-d"))));

  $between2 = date("Y-m-d");
}
?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">
<div class="card">
<div class="card-header">

<?php
?>

    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="establecimientos/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn bg-green btn-small" href=""><i class="bi bi-filetype-xml"></i></a>
    </h3>
      <div class="card-tools">
        <div class="d-flex">
        <div class="d-flex mr-2">
          <span class="mr-3">Acciones:</span><input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
        </div>
        <div class="input-group">
          <button type="button" class="btn btn-default float-right" id="daterangee-btn">
            <i class="far fa-calendar-alt"></i> Date range picker
            <i class="fas fa-caret-down"></i>
          </button>
        </div>
        </div>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="establecimientostable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Establecimiento</th>
          <th>Descripcion</th>
          <th>Direccion</th>
          <th>Matriz</th>
          <th>Estado</th>
          <th>Editar/Eliminar</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/establecimientos.js"></script>