<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">
            <?php
            require_once("controllers/itemsxestablecimiento.controller.php");
            $create = new ItemsxestablecimientoController();
            $create->create();
            ?>
            <div class="col-md-8 offset-md-2">



                <div class="form-group mt-2">
                    <label>Establecimientos</label>
                    <?php
                    require_once("controllers/establecimientos.controllers.php");
                    $create = new EstablecimientosController();
                    $tipo_precio = $create->establecimientos();
                    $tipo_precio = json_encode($tipo_precio);
                    $tipo_precio = json_decode($tipo_precio, true);
                    ?>


                    <select class="form-control select2 changeCountry" name="cod_establecimiento" required>
                        <option value>Seleccione Precio Aplicado</option>
                        <?php foreach ($tipo_precio as $key => $value) : ?>
                            <option value="<?php echo $value["cod_establecimiento"] ?>">

                                <?php echo $value["txt_descripcion"] ?>

                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>







                <div class="form-group mt-2">
                    <label>Codigo Item Iventario</label>
                    <input type="text" name="cod_inventario" id="cod_inventario"
                    
                    class="form-control" onchange="validateRepeat(event,'cod_barras','ecmp_inventario','cod_barras', <?php echo $_SESSION['admin']->cod_empresa ?>)"
                    required
                    disabled
                    >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>
                <input type="hidden"  name="cod_inventario_hidden" id="cod_inventario_hidden"> 



                <div class="card-body">
                <div id="events">
        
                </div>
                    <table id="itemxestablecimientoTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Existencia Total</th>
                                <th>V/costo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <html>


        

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="inventario" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>

<script>





function execDataTable () {


var url = "ajax/data-inventario_item.php?text=&code="+localStorage.getItem("cod");
var columns = [
  {"data":"cod_inventario"},
  {"data":"txt_descripcion"},
  {"data":"qtx_saldo"},
  {"data":"val_costo"},
  {"data":"sts_inventario"},
];


var adminsTable = $("#itemxestablecimientoTable").DataTable({
"select":{
    style: 'single'
},
  "responsive": true, 
  "lengthChange": true,
  "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
  "autoWidth": false, 
  "processing": true,
  "serverSide": true,
  "ajax":{
    "url": url,        
    "type":"POST"
  },
  "columns": columns,
  
fnDrawCallback:function(oSettings){
  if(oSettings.aoData.length == 0){
      $('.dataTables_paginate').hide();
      $('.dataTables_info').hide();
  }
}
});
var events = $('#cod_barras');


adminsTable
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = adminsTable.rows( indexes ).data().toArray();
            document.getElementById("cod_inventario").value =rowData[0].cod_inventario;
            document.getElementById("cod_inventario_hidden").value =rowData[0].cod_inventario;
            // events.prepend("value="+JSON.stringify(rowData[0].cod_inventario+""));
        } )
        .on( 'deselect', function ( e, dt, type, indexes ) {
            var rowData = adminsTable.rows( indexes ).data().toArray();
            document.getElementById("cod_inventario").value = "";
            document.getElementById("cod_inventario_hidden").value = "";
        } );
}

execDataTable();


</script>