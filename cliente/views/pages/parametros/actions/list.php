
<div class="card">
<div class="card-header">
  <input type="hidden" id="parametros" name="parametros">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="parametros/Crear"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem" title="Eliminar"><i class='fas fa-trash-alt'></i></a>    
    </h3>
      
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="parametrostable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Nombre</th>
          <th>Valor</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/parametros.js"></script>