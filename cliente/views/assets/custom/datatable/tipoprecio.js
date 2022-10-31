execDataTable("flat");
function execDataTable (text) {

    var tipoprecioTable = $("#tipopreciotable").DataTable({
       "select": {style: 'single'}, 
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-tipoprecio.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&code="+localStorage.getItem("cod")+"&token="+localStorage.getItem("token_user"),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_precio"},
         {"data":"txt_descripcion"},
         {"data":"sts_defecto"},
         {"data":"sts_precio"},
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
 
         $("#tipopreciotable").on("draw.dt",function(){
             setTimeout(() => {
                tipoprecioTable.buttons().container().appendTo('#tipopreciotable_wrapper .col-md-6:eq(0)');
     
             }, 100);
         })

         tipoprecioTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = tipoprecioTable.rows(indexes).data().toArray();
           document.getElementById("tipoprecio").value = rowData[0].cod_precio;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = tipoprecioTable.rows(indexes).data().toArray();
           document.getElementById("tipoprecio").value = "";
         });
   }
   function edit(){
    var date = document.getElementById("tipoprecio").value;
    if(date != ""){
      window.location.href = ("tipoprecio/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
    }
  }
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
//  function reportActive(event){
//      if(event.target.checked){
//          $("#tipopreciotable").dataTable().fnClearTable();
//          $("#tipopreciotable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("flat");
//          }, 10);
//      }else{
//          $("#tipopreciotable").dataTable().fnClearTable();
//          $("#tipopreciotable").dataTable().fnDestroy();
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
//        window.location = "tipoprecio?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
//      }
//    )

   //Eliminar registro
$(document).on("click",".removeItem", function(){
  // var idItem = $(this).attr("idItem");
  // var table = $(this).attr("table");
  // var cod_empresa = $(this).attr("cod_empresa");
  // var column = $(this).attr("column");
  // var page = $(this).attr("page");
  var cod_precio = document.getElementById("tipoprecio").value;
  console.log(localStorage.getItem("cod"));
  console.log("cod_precio: ",cod_precio);
  if(cod_precio != ""){

      fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_precio+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "ecmp_precio"); // nombre de la tabla
          data.append("cod_empresa", btoa(localStorage.getItem("cod"))); // codigo empresa encriptado papa
          data.append("column", "cod_precio"); // columna donde se va a buscar el id pk
          data.append("token", localStorage.getItem("token_user")); // el token enviado desde aqui para validar

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
                  "El registro a sido borrado correctamente",
                  "tipoprecio",
                );
              }else{
                fncNotie(3,"Error al borrar el dato")
              }
            }
          })


        }


      })
  }

})
