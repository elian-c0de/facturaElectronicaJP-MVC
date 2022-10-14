<?php
if(isset($_GET["start"]) && isset($_GET["end"])){
  $between1 = $_GET["start"];
  $between2 = $_GET["end"];
}else{
  $between1 = date("Y-m-d",strtotime("-29 day", strtotime(date("Y-m-d"))));
  $between2 = date("Y-m-d",strtotime("+1 day", strtotime(date("Y-m-d"))));
  echo '<pre>'; print_r($between1); echo '</pre>';
  echo '<pre>'; print_r($between2); echo '</pre>';

  // SELECT * FROM srja_caja where fec_actualiza BETWEEN '2022-1-10' AND '2022-12-10' 
  
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
      <a class="btn bg-blue btn-small" href="admins/create">xml</a>
    </h3>
  

      <div class="card-tools">
        <div class="d-flex">
        <div class="d-flex mr-2">
          <span class="mr-3">Resportes:</span>
          <input type="checkbox"
           onchange="reportActive(event);" 
           name="my-checkbox" 
           checked data-bootstrap-switch data-off-color="light" 
           data-on-color="dark"
          
           data-handle-width="75">
        </div>

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
  <div class="card-body">
    <table id="cajastable" class="table table-bordered table-striped tableCajas">
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