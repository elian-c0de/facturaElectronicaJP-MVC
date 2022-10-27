
<div class="card">
  <div class="card-header">
  <input type="hidden" id="retenciondeImpuestos" name="retenciondeImpuestos">
  <input type="hidden" id="retenciondeImpuestos1" name="retenciondeImpuestos1">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="retenciondeImpuestos/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem1" title="Eliminar"><i class='fas fa-trash-alt'></i></a>    
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="retenciondeImpuestostable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Impuesto</th>
          <th>Codigo de Retención</th>
          <th>Descripción</th>
          <th>Porcentaje Retención</th>
          <th>Estado</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/retenciondeImpuestos.js"></script>