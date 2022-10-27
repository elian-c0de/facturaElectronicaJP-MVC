execDataTable("flat");
function execDataTable (text) {
    
    var conceptosTable = $("#conceptostable").DataTable({
       "select": {style: 'single'},
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-conceptos.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),  
         "type":"POST"
       },
       "columns":[
         {"data":"cod_concepto"},
         {"data":"txt_descripcion"},
         {"data":"sts_facturacion"},
         {"data":"sts_tipo_concepto"},
         {"data":"sts_proceso"},
         {"data":"sts_inventario"},
         {"data":"sts_concepto"},
         //{"data":"actions"}
       ],
       "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ Entradas",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "select-info": "",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }

    },
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
 
 
         $("#conceptostable").on("draw.dt",function(){
             setTimeout(() => {
              conceptosTable.buttons().container().appendTo('#conceptostable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })

         conceptosTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = conceptosTable.rows(indexes).data().toArray();
           document.getElementById("conceptos").value = rowData[0].cod_concepto;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = conceptosTable.rows(indexes).data().toArray();
           document.getElementById("conceptos").value = "";
         });

   }

   function edit(){
    var date = document.getElementById("conceptos").value;
    if(date != ""){
      window.location.href = ("conceptos/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
    }
  }
 
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
//  function reportActive(event){
//      if(event.target.checked){
//          $("#conceptostable").dataTable().fnClearTable();
//          $("#conceptostable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("flat");
//          }, 10);
//      }else{
//          $("#conceptostable").dataTable().fnClearTable();
//          $("#conceptostable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("html");
//          }, 10);
//      }
//  }
 
 //rango de fechas
//  $('#daterangee-btn').daterangepicker(
//      {
//        ranges   : {
//          'Today'       : [moment(), moment()],
//          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
//          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
//          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//        },
//        startDate: moment($("#between1").val()),
//        endDate  : moment($("#between2").val())
//      },
//      function (start, end) {
//        // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
//        window.location = "conceptos?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
//      }
//    )

//Elinianr registro
$(document).on("click",".removeItem", function(){
    // var idItem = $(this).attr("idItem");
    // var table = $(this).attr("table");
    // var cod_empresa = $(this).attr("cod_empresa");
    // var column = $(this).attr("column");
    // var page = $(this).attr("page");
    var cod_concepto = document.getElementById("conceptos").value;
    console.log(localStorage.getItem("cod"));
    console.log("cod_concepto: ", cod_concepto);
    if(cod_concepto != ""){
      fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_concepto+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "srja_concepto"); // nombre de la tabla
          data.append("cod_empresa", btoa(localStorage.getItem("cod"))); // codigo empresa encriptado papa
          data.append("column", "cod_concepto"); // columna donde se va a buscar el id pk
          data.append("token", localStorage.getItem("token_user")); // el token enviado desde aqui para validar cualquier vaina 

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
                  "conceptos"
                );
              }else{
                fncNotie(3,"error deleating the record")
              }
            }
          })


        }


      });
    }
  
  });
  