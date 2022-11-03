execDataTable("flat");
function execDataTable (text) {

    var formadepagoTable = $("#formadepagotable").DataTable({
       "select": {style: 'single'},
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-formadepago.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_forma_pago"},
         {"data":"nom_forma_pago"},
         {"data":"sts_defecto"},
         {"data":"cod_sri"},
         {"data":"sts_forma_pago"},
         {"data":"sts_retencion"},
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
 
  
        $("#formadepagotable").on("draw.dt",function(){
            setTimeout(() => {
            formadepagoTable.buttons().container().appendTo('#formadepagotable_wrapper .col-md-6:eq(0)');
    
            }, 100);
    
        })

        formadepagoTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = formadepagoTable.rows(indexes).data().toArray();
           document.getElementById("formadepago").value = rowData[0].cod_forma_pago;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = formadepagoTable.rows(indexes).data().toArray();
           document.getElementById("formadepago").value = "";
         });


}

function edit(){
  var date = document.getElementById("formadepago").value;
  if(date != ""){
    window.location.href = ("formadepago/Editar/"+btoa(date+"~"+localStorage.getItem("token_user")));
  }
}


//Elinianr registro
$(document).on("click",".removeItem1", function(){
    var cod_forma_pago = document.getElementById("formadepago").value;
    if(cod_forma_pago != ""){
      fncSweetAlert("confirm","Estas seguro de eliminar este registro?","").then(resp=>{
    
        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_forma_pago+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "gen_forma_pago"); // nombre de la tabla
          data.append("column", "cod_forma_pago"); // columna donde se va a buscar el id pk
          data.append("token", localStorage.getItem("token_user")); // el token enviado desde aqui para validar cualquier vaina 
    
          $.ajax({
            url: "ajax/ajax-delete2.php",
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
              if(response == 200){
                fncSweetAlert(
                  "success",
                  "El registro a sido borrado correctamente",
                  "formadepago"
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
