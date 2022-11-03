
<div class="card">
<div class="card-header">


    <input type="hidden" id="linea1" name="linea1">
    <input type="hidden" id="sublinea" name="sublinea">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" title="Crear" href="sublineaproducto/Crear"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" title="Editar" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small removeItem2ids" title="Eliminar"><i class='fas fa-trash-alt'></i></a>
    </h3>
      
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="form-group mt-2">
					<label>Lineas de Producto</label>
					<?php 
                    require_once("controllers/lineasdeproducto.controllers.php");
                    $create = new LineasdeproductoController();
                    $lista = $create -> getListaLinea();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="linea" id="linea" onchange="reload()" required>
						<option value="">Seleccione la linea de producto</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_linea"] ?>" ><?php echo $value["cod_linea"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
	  </div>
    <table id="sublineasdeproductotable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th></th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/sublineaproducto.js"></script>