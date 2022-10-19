<?php

//ASIGANACION DE FECHAS 
if (isset($_GET["start"]) && isset($_GET["end"])) {
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
} else {
  $between1 = date("Y-m-d", strtotime("-1 year", strtotime(date("Y-m-d"))));
  $between2 = date("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d"))));
}
//FIN ASIGANACION DE FECHAS 


?>
<!-- ELEMTNOS OCULTOS PARA OBTENER FECHAS -->
<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">

<div class="form-group mt-2">
					<label>Establecimiento</label>
					<?php 
                    require_once("controllers/itemsxestablecimiento.controller.php");
                    $create = new ItemsxestablecimientoController();
                    $tipo_precio = $create -> getestablecimientos();
                    $tipo_precio = json_encode($tipo_precio);
                    $tipo_precio = json_decode($tipo_precio,true);
                    
                    ?>

					<select class="form-control select2 changeCountry" name="cod_precio" onchange="reload()" id="establecimiento" required>
						<option value>Seleccione Precio Aplicado</option>
						<?php foreach ($tipo_precio as $key => $value): ?>
          

              <?php if ($key == 0): ?>
							<option  value="<?php echo $value["cod_establecimiento"] ?>" selected> <?php echo $value["txt_descripcion"] ?></option>	
              <?php else: ?>
                <option  value="<?php echo $value["cod_establecimiento"] ?>" > <?php echo $value["txt_descripcion"] ?></option>	
              <?php endif ?>



						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
				</div>  



<div class="card">
  <div class="card-header">
0
    <!-- BOTONES SUPERIORES PARA CREAR Y HACER OTRAS COSAS -->
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="clientes/create">Crear</a>

    </h3>

    <!-- PARTE SUPERIOR DE LA TABLA -->
    <div class="card-tools">
      <div class="d-flex">

        <!-- INTERRUPTOR DE MOSTRAR O NO REPORTES -->
        <div class="d-flex mr-2">
          <span class="mr-3">Resportes:</span>
          <input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">
        </div>


        <!-- ASIGANACION DE RANGOS POR FECHAS -->
        <div class="input-group">
          <button type="button" class="btn float-right" id="daterange-btn">
            <i class="far fa-calendar-alt mr-2"></i>
            <?php echo $between1 ?> - <?php echo $between2 ?>
            <i class="fas fa-caret-down ml-2"></i>
          </button>
        </div>

      </div>
    </div>
  </div>

  <!-- /.card-header -->
  <!-- TABLA DONDE SE VAN A MOSTRAR LOS DATOS -->
  <div class="card-body">
    <table id="itemsxestablecimientoTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Boton dinero</th>
          <th>Controla Saldo</th>
          <th>Modifica Precio</th>
          <th>Minima Existencia</th>
          <th>Maxima Existencia</th>
          <th>Saldo</th>
          <th>V/Costo</th>
          <th>Valor Descuento</th>
          <th>% descuento</th>
          <th>Estado</th>
          <th>actions</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/itemsxestablecimiento.datatable.js"></script>