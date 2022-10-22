
<div class="card">
<div class="card-header">

<?php
?>

    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="formadepago/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn bg-green btn-small" href=""><i class="bi bi-filetype-xml"></i></a>
    </h3>
      <div class="card-tools">
        <div class="d-flex">
        <div class="d-flex mr-2">
          <span class="mr-3">Acciones:</span><input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
        </div>
        <!-- <div class="input-group">
          <button type="button" class="btn btn-default float-right" id="daterangee-btn">
            <i class="far fa-calendar-alt"></i> Date range picker
            <i class="fas fa-caret-down"></i>
          </button>
        </div> -->
        </div>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="formadepagotable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Defecto</th>
          <th>S.R.I</th>
          <th>Estado</th>
          <th>Retencion</th>
          <th>Editar/Eliminar</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/formadepagos.js"></script>