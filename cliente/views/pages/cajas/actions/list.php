<div class="card">
<div class="card-header">

<?php
?>
    <input type="hidden" id="caja" name="caja">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="cajas/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem" title="Eliminar"><i class='fas fa-trash-alt'></i></a>
      <a class="btn bg-green btn-small" href="cajas/XML"><i class="bi bi-filetype-xml"></i></a>
    <!-- </h3>
      <div class="card-tools">
        <div class="d-flex">
        <div class="d-flex mr-2">
          <input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked>
        </div>
        </div>
      </div> -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="cajastable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <!-- <th>Editar/Eliminar</th> -->
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/cajas.js"></script>