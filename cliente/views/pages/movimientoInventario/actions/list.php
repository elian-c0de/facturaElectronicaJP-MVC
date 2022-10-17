<?php
if(isset($_GET["start"]) && isset($_GET["end"])){
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
}else{
  // d-m-Y  Paladines
  // m-d-Y  Ramirez
  $between1 = date("m-d-Y",strtotime("-29 day", strtotime(date("m-d-Y"))));

  $between2 = date("m-d-Y");
}
?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">
<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="#"><i class="bi bi-file-earmark-plus-fill"></i> Guardar</a>
      <a class="btn bg-green btn-small" href=""><i class="bi bi-filetype-xml"></i></a>
    </h3>
      <div class="card-tools">
        <div class="d-flex">
          <div class="d-flex mr-2">
            <span class="mr-3">Acciones:</span><input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
          </div>
        <!-- <div class="input-group">
          <button type="button" class="btn btn-default float-right" id="daterangee-btn">
            <i class="far fa-calendar-alt"></i> Date range picker
            <i class="fas fa-caret-down"></i>
          </button>
        </div> -->
        </div>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- <table id="movimientoInventariotable" class="table table-bordered table-striped">
      <thead>
        <tr>
            <th>Codigo Inventario</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Subtotal</th>
            <th>IVA</th>
            <th>Total</th>
            <th>Editar/Eliminar</th>
        </tr>
      </thead>
    </table> -->
    <div class="row">
      <div class="col-sm-6">
        <form method="POST" class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="card-body">
              <div class="col-sm-10">
                <div class="form-group mt-2">
                    <label for="">Establecimiento:</label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Número de movimiento:</label>
                    <input 
                    type="text" 
                    class="form-control"
                    require="[A-Za-z0-9]{1,}">
                </div>

                <div class="form-group mt-2">
                  <label for="">Tipo de movimineto:</label>
                      <select class="form-control mb-3" id="tipoMovimiento"  name="tipoMovimiento" placeholder="TipoMovimiento" required>
                      <option value="">Ingreso</option>
                      <option value="">Egreso</option>
                      </select>
                </div>

                <div class="form-group mt-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control">
                </div>

                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    
      <div class="col-sm-6">
        <form method="POST" id="transactionForm" class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="card-body">
              <div class="col-sm-10">
                <div class="form-group mt-2">
                    <label for="">Código Inventario:</label>
                    <input 
                    type="text"
                    id="codInven"
                    name="codInven" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <!-- <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div> -->
                </div>
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" id="descrip"
                    name="descrip" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Cantidad:</label>
                    <input 
                    type="number" 
                    oninput="calcularSubtotal()"
                    id="cant"
                    name="cant"
                    class="form-control"
                    require="{1,2}">
                </div>
                <div class="form-group mt-2">
                    <label for="">Costo:</label>
                    <input 
                    type="number"
                    id="cost"
                    oninput="calcularSubtotal()"
                    name="cost" 
                    class="form-control"
                    require="{1,2}"
                    >
                </div>
                <div class="form-group mt-2">
                    <label for="">SubTotal:</label>
                    <input 
                    type="number" 
                    id="subtot"
                    oninput="calcularSubtotal()"
                    min="0"
                    step="any"
                    name="subtot" 
                    class="form-control"
                    require="{2,0}"
                    readonly>                   
                </div>
                <div class="form-group mt-2">
                    <label for="">IVA:</label>
                    <input 
                    type="number"
                    id="iva"
                    name="iva" 
                    class="form-control"
                    require="{1,2}"
                    readonly>
                </div>
                <div class="form-group mt-2">
                    <label for="">Total:</label>
                    <input 
                    type="number"
                    id="total"
                    name="total" 
                    class="form-control"
                    require="{1,2}"
                    readonly>
                </div>
                <div class="card-header">
                  <div class="col-md-8 offset-md-4">
                      <div class="form-group mt-1">
                          <a href="#" class="btn btn-danger border text-center">Cancelar</a>
                          <button type="submit" id="Guardar" class="btn btn-primary float-lg-center">Guardar</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  
        </form>
      </div>
    </div>
  </div>
  <!-- /.card-footer -->
  <div class="card-footer">
  <table id="movimientoInventariotable" class="table table-bordered table-striped">
      <thead>
        <tr>
            <th>Codigo Inventario</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Subtotal</th>
            <th>IVA</th>
            <th>Total</th>
            <th>Editar/Eliminar</th>
        </tr>
      </thead>
    </table>

  </div>
  <div class="card-footer text-right">
    <span class="mr-3">SubTotal 0%</span>
    <input 
      type="number"
      id="total"
      value="0.00"
      name="total" 
      class="mr-3"
      require="{1,2}"
      readonly>
  </div>
  <div class="card-footer text-right">
    <span class="mr-3">SubTotal IVA</span>
    <input 
      type="number"
      id="total"
      value="0.00"
      name="total" 
      class="mr-3"
      require="{1,2}"
      readonly>
  </div>
  <div class="card-footer text-right">
    <span class="mr-3">IVA</span>
    <input 
      type="number"
      id="total"
      value="0.00"
      name="total" 
      class="mr-3"
      require="{1,2}"
      readonly>
  </div>
  <div class="card-footer text-right">
    <span class="mr-3">Total</span>
    <input 
      type="number"
      id="total"
      value="0.00"
      name="total" 
      class="mr-3"
      require="{1,2}"
      readonly>
  </div>
</div>

<script src="views/assets/custom/datatable/movimientoInventario.js"></script>
