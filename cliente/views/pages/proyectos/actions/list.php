<div class="card">
<div class="card-header">

<?php
?>

    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="proyectos/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn bg-green btn-small" href="proyectos/XML"><i class="bi bi-filetype-xml"></i></a>
    </h3>
      <div class="card-tools">
        <div class="d-flex">
        <div class="d-flex mr-2">
          <span class="mr-3">Acciones:</span><input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
        </div>
        </div>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="proyectostable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Nombre</th>
          <!-- <th>Editar/Eliminar</th> -->
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/proyectos.js"></script>