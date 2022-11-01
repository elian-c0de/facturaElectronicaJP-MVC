
<div class="card">
<div class="card-header">

    <input type="text" id="linea" name="linea">
    <input type="text" id="sublinea" name="sublinea">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="lineasdeproducto/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem2ids" title="Eliminar"><i class='fas fa-trash-alt'></i></a>
    </h3>
      
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="lineasdeproductotable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo de Linea</th>
          <th>Descripcion</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/lineasdeproducto.js"></script>