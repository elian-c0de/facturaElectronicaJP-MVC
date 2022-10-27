
<div class="card">
  <div class="card-header">
  <input type="hidden" id="formadepago" name="formadepago">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="formadepago/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem1" title="Eliminar"><i class='fas fa-trash-alt'></i></a>
    </h3>
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
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/formadepagos.js"></script>