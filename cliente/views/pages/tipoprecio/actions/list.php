
<div class="card">
<div class="card-header">

    <input type="hidden" id="tipoprecio" name="tipoprecio">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="tipoprecio/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem" title="Eliminar"><i class='fas fa-trash-alt'></i></a>
    </h3>

  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="tipopreciotable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Código</th>
          <th>Descripcion</th>
          <th>Defecto</th>
          <th>Estado</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/tipoprecio.js"></script>