<div class="card">
<div class="card-header">

<?php
?>
    <input type="hidden" id="establecimiento" name="establecimiento">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="establecimientos/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small" href="establecimientos/delete"><i class='fas fa-trash-alt'></i></a>
      <a class="btn bg-green btn-small" href="establecimientos/XML"><i class="bi bi-filetype-xml"></i></a>
    </h3>
    
      <!-- <div class="card-tools">
        <div class="d-flex">
          <div class="d-flex mr-2">
            <input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked>
          </div>
        </div>
      </div> -->
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
          <!-- <th>Editar/Eliminar</th> -->
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/establecimientos.js"></script>