<?php
if(isset($_GET["start"]) && isset($_GET["end"])){
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
}else{
  $between1 = date("d-m-Y",strtotime("-29 day", strtotime(date("d-m-Y"))));

  $between2 = date("d-m-Y");
}



?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">
<div class="card">
  <div class="card-header">

  <?php



?>



    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="admins/create">Crear</a>
      <a class="btn bg-blue btn-small" href="">xml</a>
    </h3>
  

      <div class="card-tools">
        <div class="d-flex">
        <div class="d-flex mr-2">
          <span class="mr-3">Resportes:</span><input type="checkbox" onchange="reportActive(event);" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
        </div>

        <div class="input-group">
          <button type="button" class="btn btn-default float-right" id="daterange-btn">
            <i class="far fa-calendar-alt"></i> Date range picker
            <i class="fas fa-caret-down"></i>
          </button>
        </div>
        </div>
        

      </div>


    


  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="cajastable" class="table table-bordered table-striped">
      <thead>
        <tr>

          <th>cod_empresa</th>
          <th>cod_caja</th>
          <th>txt_descripcion</th>
          <th>cod_usuario</th>
          <th>fec_actualiza</th>
          <th>actions</th>
        </tr>
      </thead>


    </table>
  </div>
  <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/datatable.js"></script>