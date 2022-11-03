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
    window.location.href = ("cajas/Editar/"+btoa(date+"~"+localStorage.getItem("token_user")));
  }
}

  //Elinianr registro
  $(document).on("click",".removeItem", function(){
    var cod_caja = document.getElementById("caja").value;
    console.log(localStorage.getItem("cod"));
    console.log("cod_caja: ", cod_caja);
    if(cod_caja != ""){
      fncSweetAlert("confirm","Estas seguro de eliminar este registro?","").then(resp=>{

        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_caja+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "srja_caja"); // nombre de la tabla
          data.append("cod_empresa", btoa(localStorage.getItem("cod"))); // codigo empresa encriptado papa
          data.append("column", "cod_caja"); // columna donde se va a buscar el id pk
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
                  "El registro se elimino correctamente",
                  "cajas"
                );
              }else{
                fncNotie(3,"Error al eliminar el registro")
              }
            }
          })
        }
      });
    }
  });