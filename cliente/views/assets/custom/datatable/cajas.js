execDataTable("flat");
function execDataTable (text) {
  var cajasTable = $("#cajastable").DataTable({
    select: {
      style: "single",
    },
     "responsive": true, 
     "lengthChange": true, 
     "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
     "autoWidth": false, 
     "processing": true,
     "serverSide": true,
     "ajax":{
       "url":"ajax/data-cajas.php?text="+text+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),

       "type":"POST"
     },
     "columns":[
       {"data":"cod_caja"},
       {"data":"txt_descripcion"},
      //  {"data":"actions"}
     ],
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

   $("#cajasTable").on("draw.dt",function(){
    setTimeout(() => {
      cajasTable.buttons().container().appendTo('#cajasTable_wrapper .col-md-6:eq(0)');
    }, 100);

   })

   //Obtener ID de la Caja
   cajasTable
    .on("select", function (e, dt, type, indexes) {
      var rowData = cajasTable.rows(indexes).data().toArray();
      document.getElementById("caja").value = rowData[0].cod_caja;
    })
    .on("deselect", function (e, dt, type, indexes) {
      var rowData = cajasTable.rows(indexes).data().toArray();
      document.getElementById("caja").value = "";
    });
 }

//Editar Caja
function edit(){
  var date = document.getElementById("caja").value;
  if(date != ""){
    window.location.href = ("cajas/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
  }
}

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