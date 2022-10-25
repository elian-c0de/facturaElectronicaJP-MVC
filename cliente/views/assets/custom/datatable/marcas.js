
function execDataTable (text) {

    var marcasTable = $("#marcastable").DataTable({
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
       "buttons": [
         {extend:"copy",className:"btn-dark"},
         {extend:"csv",className:"btn-b"},
         {extend:"excel",className:"btn-g"},
         {extend:"pdf",className:"btn-g"},
         {extend:"print",className:"btn-g"},
         {extend:"colvis",className:"btn-g"}
     ]
     })
 
     if(text == "flat"){
         $("#marcastable").on("draw.dt",function(){
             setTimeout(() => {
              marcasTable.buttons().container().appendTo('#marcastable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })
     }
   }
 
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
 function reportActive(event){
     if(event.target.checked){
         $("#marcastable").dataTable().fnClearTable();
         $("#marcastable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("flat");
         }, 10);
     }else{
         $("#marcastable").dataTable().fnClearTable();
         $("#marcastable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("html");
         }, 10);
     }
 }
//Elinianr registro
$(document).on("click",".removeItem1", function(){
    var idItem = $(this).attr("idItem");
    var table = $(this).attr("table");
    var column = $(this).attr("column");
    var page = $(this).attr("page");
  
    fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{
  
      if(resp){
        var data = new FormData();
        data.append("idItem",idItem);
        data.append("table",table);
        data.append("column",column);
        data.append("token",localStorage.getItem("token_user"))
  
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
  