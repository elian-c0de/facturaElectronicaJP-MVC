

execDataTable();
function execDataTable () {

    var url = "ajax/data-inventario.php?&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod");
    var columns = [

   
      {"data":"cod_inventario"},
      {"data":"cod_barras"},
      {"data":"txt_descripcion"},
      {"data":"sts_iva"},
      {"data":"sts_tipo"},
      {"data":"qtx_saldo"},
      {"data":"val_costo"},
      {"data":"cod_linea_sublinea"},
      {"data":"cod_marca"},
      {"data":"sts_inventario"},
      
    ];
  
   var adminsTable = $("#inventarioTable").DataTable({
      "responsive": true, 
      "lengthChange": true,
      "select": {style: 'single'},
      "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
      "autoWidth": false, 
      "processing": true,
      "serverSide": true,
      "ajax":{
        "url": url,        
        "type":"POST"
      },
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ Entradas",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        "select-info": "",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
        // url: 'dataTables.spanish.json'
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
    
        $("#inventarioTable").on("draw.dt",function(){
            setTimeout(() => {
                adminsTable.buttons().container().appendTo('#inventarioTable_wrapper .col-md-6:eq(0)');
            }, 100);
    
        })




        adminsTable
        .on("select", function (e, dt, type, indexes) {
          var rowData = adminsTable.rows(indexes).data().toArray();
          document.getElementById("inventarioID").value = rowData[0].cod_inventario;
        })
        .on("deselect", function (e, dt, type, indexes) {
          var rowData = adminsTable.rows(indexes).data().toArray();
          document.getElementById("inventarioID").value = "";
        });
     
}




function edit(){
  var date = document.getElementById("inventarioID").value;
  if(date != ""){
    window.location.href = ("inventario/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
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
    window.location = "inventario?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
  }
)





//Elinianr registro
$(document).on("click",".removeItem", function(){
  var cod_inventario = document.getElementById("inventarioID").value;

  fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

    if(resp){
      var data = new FormData();
      data.append("idItem",btoa(cod_inventario+"~"+localStorage.getItem("token_user")));
      data.append("table","ecmp_inventario");
      data.append("cod_empresa",btoa(localStorage.getItem("cod")));
      data.append("column","cod_inventario");
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
              "inventario"
            );
          }else{
            fncNotie(3,"error deleating the record")
          }
        }
      })


    }else{
      location.reload();
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
          console.log("response: ", response);
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
      location.reload();
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
      location.reload();
    }


  })




});







