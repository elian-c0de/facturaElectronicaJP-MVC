<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">
<div class="card">
<div class="card-header">

<?php
?>

    <!-- <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="marcas/create"><i class="bi bi-file-earmark-plus-fill"></i></a>
      <a class="btn bg-green btn-small" href=""><i class="bi bi-filetype-xml"></i></a>
    </h3> -->
        <div class="card-title">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="w-auto" style="padding: 20px;">
                                <form id="user-form">
                                    <input type="hidden" id="userId">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <p>Año:</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control mb-3" id="año" placeholder="" required>
                                        </div>
                                        <div class="col-md-1">
                                            <p>Mes:</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control mb-3" id="mes" placeholder="" required>
                                        </div>
                                        <div class="form-check" style="margin-left: 10px;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio1" checked>
                                            <label class="form-check-label" for="radio1">
                                                Compras    
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-left: 10px;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio2" >
                                            <label class="form-check-label" for="radio2">
                                                Ventas  
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-left: 10px;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio3" >
                                            <label class="form-check-label" for="radio3">
                                                Anulados  
                                            </label>
                                        </div>
                                    </div>

                                </form>
                        </div>

        <!-- <div class="d-flex">
            <div class="row">
                <div class="col-md-4">
                    <p>Usuario:</p>
                </div>
                <div class="col-md-6">
                    <select class="form-control mb-3" id="usuario"  name="usuario" placeholder="Usuario" required></select>
                </div>
            </div>
            
        <div class="d-flex mr-2">
          <span class="mr-3">Acciones:</span><input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
        </div>
        <div class="input-group">
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
    <!-- <table id="marcastable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Codigo de Marca</th>
          <th>Nombre de Marca</th>
          <th>Editar/Eliminar</th>
        </tr>
      </thead>
    </table> -->
  </div>
  <!-- /.card-body -->
</div>