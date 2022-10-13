function execDataTable (text) {

    var moviminetoInventarioTable = $("#moviminetoInventariotable").DataTable({
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-moviminetoInventario.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val(),
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
         $("#moviminetoInventariotable").on("draw.dt",function(){
             setTimeout(() => {
              moviminetoInventarioTable.buttons().container().appendTo('#moviminetoInventariotable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })
     }
   }
 
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
 function reportActive(event){
     if(event.target.checked){
         $("#moviminetoInventariotable").dataTable().fnClearTable();
         $("#moviminetoInventariotable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("flat");
         }, 10);
     }else{
         $("#moviminetoInventariotable").dataTable().fnClearTable();
         $("#moviminetoInventariotable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("html");
         }, 10);
     }
 }
 