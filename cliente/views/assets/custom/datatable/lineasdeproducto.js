execDataTable("flat");
function execDataTable (text) {

    var lineasdeproductoTable = $("#lineasdeproductotable").DataTable({
       "select": {style: 'single'},  
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-lineasdeproducto.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_linea"},
         {"data":"txt_descripcion"},
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
 
         $("#lineasdeproductotable").on("draw.dt",function(){
             setTimeout(() => {
                lineasdeproductoTable.buttons().container().appendTo('#lineasdeproductotable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })
         
         lineasdeproductoTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = lineasdeproductoTable.rows(indexes).data().toArray();
           document.getElementById("linea").value = rowData[0].cod_linea;
           document.getElementById("sublinea").value = "000";
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = lineasdeproductoTable.rows(indexes).data().toArray();
           document.getElementById("linea").value = "";
           document.getElementById("sublinea").value = "";
         });

   }


   function edit(){
    var date = document.getElementById("linea").value;
    var date2 = document.getElementById("sublinea").value;
    if(date != "" && date2 != ""){
      window.location.href = ("lineasdeproducto/edit/"+btoa(date+"~"+date2+"~"+localStorage.getItem("token_user")));
    }
  }
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
//  function reportActive(event){
//      if(event.target.checked){
//          $("#lineasdeproductotable").dataTable().fnClearTable();
//          $("#lineasdeproductotable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("flat");
//          }, 10);
//      }else{
//          $("#lineasdeproductotable").dataTable().fnClearTable();
//          $("#lineasdeproductotable").dataTable().fnDestroy();
//          setTimeout(() => {
//              execDataTable("html");
//          }, 10);
//      }
//  }
 
//  //rango de fechas
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
//        window.location = "lineasdeproducto?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
//      }
//    )

   //Eliminar registro
$(document).on("click",".removeItem2ids", function(){
  // var idItem = $(this).attr("idItem");
  // var table = $(this).attr("table");
  var cod_empresa = btoa(localStorage.getItem("cod"));
  console.log(cod_empresa);
  // var column = $(this).attr("column");
  // var column1 = $(this).attr("column1");
  // var page = $(this).attr("page");
  var cod_linea = document.getElementById("linea").value;
  console.log("cod_linea: ", cod_linea);
  var cod_sublinea = document.getElementById("sublinea").value;

  if(cod_linea != "" && cod_sublinea != ""){

    fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

      if(resp){
        var data = new FormData();
        //MODIFICAR PARAMETROS
        data.append("idItem", btoa(cod_linea+"~"+cod_sublinea+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
        data.append("table", "ecmp_linea"); // nombre de la tabla
        data.append("cod_empresa",cod_empresa);
        data.append("column", "cod_linea"); // columna donde se va a buscar el id pk
        data.append("column1", "cod_sublinea"); // columna donde se va a buscar el id pk
        data.append("token", localStorage.getItem("token_user"));

        $.ajax({
          url: "ajax/ajax-delete2ids.php",
          method: "POST",
          data: data,
          contentType: false,
          cache: false,
          processData: false,
          success: function(response){
            console.log("response: ", response);
            if(response == 200){
              fncSweetAlert(
                "success",
                "el registro a sido borrado correctamente",
                "lineasdeproducto"
              );
            }else{
              fncNotie(3,"error deleating the record")
            }
          }
        })
  
  
      }else{
        location.reload();
      }
  
  
    })

  }
  

})