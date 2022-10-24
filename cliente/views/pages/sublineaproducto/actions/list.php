
<div class="card">
<div class="card-header">



    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="sublineaproducto/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn bg-green btn-small" href=""><i class="bi bi-filetype-xml"></i></a>
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
    <div class="form-group mt-2">
					<label>Lineas de Producto</label>
					<?php 
                    require_once("controllers/lineasdeproducto.controllers.php");
                    $create = new LineasdeproductoController();
                    $lista = $create -> getListaLinea();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_linea" id="linea" onchange="reload()" required>
						<option value>Seleccione la linea de producto</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_linea"] ?>" ><?php echo $value["cod_linea"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
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