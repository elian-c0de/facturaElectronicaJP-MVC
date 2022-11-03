
<div class="card">
  <div class="card-header">

    <input type="hidden" id="usuarios" name="usuarios">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="usuarios/Crear"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem" title="Eliminar"><i class='fas fa-trash-alt'></i></a>    
    </h3>

  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="usuariostable" class="table table-bordered table-striped">
      <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Perfil</th>
            <th>Establecimiento</th>
            <th>Punto de Emisión</th>
            <th>Estado</th>
            <th>Administrador</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/usuarios.js"></script>