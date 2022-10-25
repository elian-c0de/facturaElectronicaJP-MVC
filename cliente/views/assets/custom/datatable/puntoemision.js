function execDataTable (text) {

    var puntoemisionTable = $("#puntoemisionTable").DataTable({
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-puntoemision.php?text="+text+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod")+"&cod_establecimiento="+$("#cod_establecimiento").val(),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_punto_emision"},
         {"data":"txt_descripcion"},
         {"data":"cod_caja"},
         {"data":"sts_ambiente"},
         {"data":"sts_tipo_emision"},
         {"data":"num_factura"},
         {"data":"num_nota_credito"},
         {"data":"num_retencion"},
         {"data":"num_guia"},
         {"data":"sts_tipo_facturacion"},
         {"data":"sts_impresion"},
         {"data":"num_factura_prueba"},
         {"data":"num_nota_credito_prueba"},
         {"data":"num_retencion_prueba"},
         {"data":"num_guia_prueba"},
         {"data":"sts_punto_emsion"},
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
         $("#puntoemisionTable").on("draw.dt",function(){
             setTimeout(() => {
              puntoemisionTable.buttons().container().appendTo('#puntoemisionTable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })
     }
   }
   function reload(){
    $("#puntoemisionTable").dataTable().fnClearTable();
    $("#puntoemisionTable").dataTable().fnDestroy();
    setTimeout(() => {
        execDataTable("flat");
    }, 10);
    }
 
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
 function reportActive(event){
     if(event.target.checked){
         $("#puntoemisionTable").dataTable().fnClearTable();
         $("#puntoemisionTable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("flat");
         }, 10);
     }else{
         $("#puntoemisionTable").dataTable().fnClearTable();
         $("#puntoemisionTable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("html");
         }, 10);
     }
 }