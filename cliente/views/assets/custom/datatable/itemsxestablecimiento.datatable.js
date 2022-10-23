


function execDataTable (text) {

    var url = "ajax/data-itemsxestablecimiento.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod")+"&establecimiento="+$("#establecimiento").val();
    var columns = [

   
      {"data":"cod_inventario"},
      {"data":"txt_descripcion"},
      {"data":"sts_control_saldo"},
      {"data":"sts_modifica_precio"},
      {"data":"qtx_minimo"},
      {"data":"qtx_maximo"},
      {"data":"qtx_saldo"},
      {"data":"val_costo"},
      {"data":"val_descuento"},
      {"data":"por_descuento"},
      {"data":"sts_item_local"},
      {"data":"actions"}

      
    
      
      
    ];
  
   var adminsTable = $("#itemsxestablecimientoTable").DataTable({
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
      "buttons": [
        {extend:"copy",className:"btn-dark"},
        {extend:"csv",className:"btn-b"},
        {extend:"excel",className:"btn-g"},
        {extend:"pdf",className:"btn-g"},
        {extend:"print",className:"btn-g"},
        {extend:"colvis",className:"btn-g"}
    ],
    fnDrawCallback:function(oSettings){
      if(oSettings.aoData.length == 0){
          $('.dataTables_paginate').hide();
          $('.dataTables_info').hide();
      }

    }
    })

    if(text == "flat"){
        $("#itemsxestablecimientoTable").on("draw.dt",function(){
            setTimeout(() => {
                adminsTable.buttons().container().appendTo('#itemsxestablecimientoTable_wrapper .col-md-6:eq(0)');
            }, 100);
    
        })
    }  
}

function reload(){
  $("#itemsxestablecimientoTable").dataTable().fnClearTable();
  $("#itemsxestablecimientoTable").dataTable().fnDestroy();
  setTimeout(() => {
      execDataTable("flat");
  }, 10);
}

// parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
function reportActive(event){

    if(event.target.checked){
        $("#itemsxestablecimientoTable").dataTable().fnClearTable();
        $("#itemsxestablecimientoTable").dataTable().fnDestroy();
        setTimeout(() => {
            execDataTable("flat");
        }, 10);
    }else{
        $("#itemsxestablecimientoTable").dataTable().fnClearTable();
        $("#itemsxestablecimientoTable").dataTable().fnDestroy();
        setTimeout(() => {
            execDataTable("html");
        }, 10);
    }
}

//rango de fechas
$('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment().add(1,'days')],
        'Yesterday'   : [moment().subtract(1, 'days'), moment()],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment().add(1,'days')],
        'Last 30 Days': [moment().subtract(29, 'days'), moment().add(1,'days')],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Todo' : [moment().subtract(10,'year'),moment().add(1,'days')]
      },
      startDate: moment($("#between1").val()),
      endDate  : moment($("#between2").val())
    },
    function (start, end) {
      // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      window.location = "itemsxestablecimiento?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
    }
  )






//Elinianr registro
$(document).on("click",".removeItem", function(){
  var idItem = $(this).attr("idItem");
  var table = $(this).attr("table");
  var cod_empresa = $(this).attr("cod_empresa");
  var column = $(this).attr("column");
  var page = $(this).attr("page");

  fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

    if(resp){
      var data = new FormData();
      data.append("idItem",idItem);
      data.append("table",table);
      data.append("cod_empresa",cod_empresa);
      data.append("column",column);
      data.append("token",localStorage.getItem("token_user"))

      $.ajax({
        url: "ajax/ajax-delete.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response){
          if(response == 200){
            fncSweetAlert(
              "success",
              "el registro a sido borrado correctamente",
              page
            );
          }else{
            fncNotie(3,"error deleating the record")
          }
        }
      })


    }


  })

})



//STS IVA
$(document).on('click','.stsiva', function(e){

  var idItem = $(this).attr("idItem");
  var table = $(this).attr("table");
  var cod_empresa = $(this).attr("cod_empresa");
  var column = $(this).attr("column");
  var page = $(this).attr("page");
  var val = $(this).attr("val");



  

  fncSweetAlert("confirm","estas seguro de cambiar el estado del IVA?","").then(resp=>{


    if(resp){

      var data = new FormData();
      data.append("idItem",idItem);
      data.append("table",table);
      data.append("cod_empresa",cod_empresa);
      data.append("column",column);
      data.append("token",localStorage.getItem("token_user"))
      data.append("estado",val);
      data.append("donde","stsiva");

      $.ajax({
        url: "ajax/ajax-update.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response){
          if(response == 200){
            fncSweetAlert(
              "success",
              "Cambio Realizado! :D",
              page
            );
          }else{
            fncNotie(3,"error al realizar la modificacion, intente mas tarde")
          }
        }
      })


    }else{
      $(".stsiva").prop('checked',estado);
    }


  })




});

//STS INVENTARIO
$(document).on('click','.stsinventario', function(e){

  var idItem = $(this).attr("idItem");
  var table = $(this).attr("table");
  var cod_empresa = $(this).attr("cod_empresa");
  var column = $(this).attr("column");
  var page = $(this).attr("page");
  var val = $(this).attr("val");





  fncSweetAlert("confirm","estas seguro de cambiar el estado del inventario?","").then(resp=>{


    if(resp){

      var data = new FormData();
      data.append("idItem",idItem);
      data.append("table",table);
      data.append("cod_empresa",cod_empresa);
      data.append("column",column);
      data.append("token",localStorage.getItem("token_user"))
      data.append("estado",val);
      data.append("donde","stsinven");

      $.ajax({
        url: "ajax/ajax-update.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response){
          if(response == 200){
            fncSweetAlert(
              "success",
              "Cambio Realizado! :D",
              page
            );
          }else{
            fncNotie(3,"error al realizar la modificacion, intente mas tarde")
          }
        }
      })


    }else{
      window.location = "inventario";
    }


  })




});







