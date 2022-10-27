execDataTable("flat");
function execDataTable (text) {

    var retenciondeImpuestosTable = $("#retenciondeImpuestostable").DataTable({
      "select": {style: 'single'},
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-retenciondeImpuestos.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_impuesto"},
         {"data":"cod_retencion"},
         {"data":"txt_descripcion"},
         {"data":"por_retencion"},
         {"data":"sts_impuesto"},
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
 
  
         $("#retenciondeImpuestostable").on("draw.dt",function(){
             setTimeout(() => {
                retenciondeImpuestosTable.buttons().container().appendTo('#retenciondeImpuestostable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })

         retenciondeImpuestosTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = retenciondeImpuestosTable.rows(indexes).data().toArray();
           console.log("rowData: ", rowData);
           document.getElementById("retenciondeImpuestos").value = rowData[0].cod_impuesto;
           document.getElementById("retenciondeImpuestos1").value = rowData[0].cod_retencion;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = retenciondeImpuestosTable.rows(indexes).data().toArray();
           document.getElementById("retenciondeImpuestos").value = "";
           document.getElementById("retenciondeImpuestos1").value = "";
         });
   }
 
   function edit(){
    var date = document.getElementById("retenciondeImpuestos").value;
    var date2 = document.getElementById("retenciondeImpuestos1").value;
    if(date != "" && date2 != ""){
      window.location.href = ("retenciondeImpuestos/edit/"+btoa(date+"~"+date2+"~"+localStorage.getItem("token_user")));
    }
  }


 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
//  function reportActive(event){
//      if(event.target.checked){
//          $("#retenciondeImpuestostable").dataTable().fnClearTable();
//          $("#retenciondeImpuestostable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("flat");
//          }, 10);
//      }else{
//          $("#retenciondeImpuestostable").dataTable().fnClearTable();
//          $("#retenciondeImpuestostable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("html");
//          }, 10);
//      }
//  }
 


//Elinianr registro
$(document).on("click",".removeItem1", function(){
    // var idItem = $(this).attr("idItem");
    // var table = $(this).attr("table");
    // var column = $(this).attr("column");
    // var column1 = $(this).attr("column1");
    // var page = $(this).attr("page");
    var cod_impuesto = document.getElementById("retenciondeImpuestos").value;
    var cod_retencion = document.getElementById("retenciondeImpuestos1").value;
    // console.log(localStorage.getItem("cod"));
    // console.log("cod_concepto: ", cod_concepto);
    if(cod_impuesto != "" && cod_retencion != ""){
      fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{
    
        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_impuesto+"~"+cod_retencion+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "ecmp_impuesto"); // nombre de la tabla
          data.append("column", "cod_impuesto"); // columna donde se va a buscar el id pk
          data.append("column1", "cod_retencion"); // columna donde se va a buscar el id pk
          data.append("token", localStorage.getItem("token_user"));
    
          $.ajax({
            url: "ajax/ajax-delete3.php",
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
                  "retenciondeImpuestos"
                );
              }else{
                fncNotie(3,"error deleating the record")
              }
            }
          })
    
    
        }
    
    
      })
    }
  })
