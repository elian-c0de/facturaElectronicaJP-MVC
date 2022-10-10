function execDataTable (text) {

    var proyectosTable = $("#proyectostable").DataTable({
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-proyectos.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val(),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_proyecto"},
         {"data":"nom_proyecto"},
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
         $("#proyectostable").on("draw.dt",function(){
             setTimeout(() => {
              proyectosTable.buttons().container().appendTo('#proyectostable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })
     }
   }
 
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
 function reportActive(event){
     if(event.target.checked){
         $("#proyectostable").dataTable().fnClearTable();
         $("#proyectostable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("flat");
         }, 10);
     }else{
         $("#proyectostable").dataTable().fnClearTable();
         $("#proyectostable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("html");
         }, 10);
     }
 }
 
 //rango de fechas
 $('#daterangee-btn').daterangepicker(
     {
       ranges   : {
         'Today'       : [moment(), moment()],
         'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month'  : [moment().startOf('month'), moment().endOf('month')],
         'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       },
       startDate: moment($("#between1").val()),
       endDate  : moment($("#between2").val())
     },
     function (start, end) {
       // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
       window.location = "proyectos?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
     }
   )