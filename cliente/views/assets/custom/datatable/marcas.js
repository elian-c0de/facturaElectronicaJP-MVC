execDataTable("flat");
function execDataTable (text) {

    var marcasTable = $("#marcastable").DataTable({
       "select": {style: 'single'},  
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-marca.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user"),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_marca"},
         {"data":"nom_marca"},
         {"data":"actions"}
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
     ]
     })
 
         $("#marcastable").on("draw.dt",function(){
             setTimeout(() => {
              marcasTable.buttons().container().appendTo('#marcastable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })

         marcasTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = marcasTable.rows(indexes).data().toArray();
           document.getElementById("marcas").value = rowData[0].cod_marca;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = marcasTable.rows(indexes).data().toArray();
           document.getElementById("marcas").value = "";
         });
   }
   function edit(){
    var date = document.getElementById("marcas").value;
    if(date != ""){
      window.location.href = ("marcas/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
    }
  }
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
//  function reportActive(event){
//      if(event.target.checked){
//          $("#marcastable").dataTable().fnClearTable();
//          $("#marcastable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("flat");
//          }, 10);
//      }else{
//          $("#marcastable").dataTable().fnClearTable();
//          $("#marcastable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("html");
//          }, 10);
//      }
//  }
//Eliminar registro
$(document).on("click",".removeItem1", function(){
    // var idItem = $(this).attr("idItem");
    // var table = $(this).attr("table");
    // var column = $(this).attr("column");
    // var page = $(this).attr("page");

    var cod_marca = document.getElementById("marcas").value;
    console.log("cod_marca: ",cod_marca);

    if(cod_marca != ""){

      fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{
  
        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_marca+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "ecmp_marca"); // nombre de la tabla
          data.append("column", "cod_marca"); // columna donde se va a buscar el id pk
          data.append("token", localStorage.getItem("token_user")); // el token enviado desde aqui para validar
            
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
                  "el registro a sido borrado correctamente",
                  "marcas"
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
  