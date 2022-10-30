
<div class="card">
<div class="card-header">

<?php
?>
    <input type="hidden" id="puntoEmision" name="puntoEmision">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="puntosEmision/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn btn-warning btn-small" onclick="edit()"><i class='fas fa-pencil-alt'></i></a>
      <a class="btn btn-danger btn-small " href="puntosEmision/delete"><i class='fas fa-trash-alt'></i></a>
      <a class="btn bg-green btn-small" href=""><i class="bi bi-filetype-xml"></i></a>
    </h3>
      <!-- <div class="card-tools">
        <div class="d-flex">
          <div class="d-flex mr-2">
            <input type="checkbox" onchange="reportActive(event)" name="my-checkbox" checked>
          </div>
        </div>
      </div> -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="form-group mt-2">
					<label>Establecimiento</label>
					<?php 
                    require_once("controllers/puntoemision.controllers.php");
                    $create = new PuntoemisionController();
                    $lista = $create -> getListaEstablecimiento();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_establecimiento" id="cod_establecimiento" onchange="reload()" required>
						<option value>Seleccione el Establecimiento</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_establecimiento"] ?>" ><?php echo $value["cod_establecimiento"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
	  </div>
    <table id="puntoemisionTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Caja</th>
          <th>Ambiente</th>
          <th>Tipo Emision</th>
          <th>No. Factura</th>
          <th>No. Nota Credito</th>
          <th>No. Retencion</th>
          <th>No. guia</th>
          <th>Tipo Facturacion</th>
          <th>Impresion</th>
          <th>Estado</th>
          <th>No. Factura Prueba</th>
          <th>No. NC Prueba</th>
          <th>No. Retencion Prueba</th>
          <th>No. Guia de Remision Prueba</th>
          <th></th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/puntoemision.js"></script>