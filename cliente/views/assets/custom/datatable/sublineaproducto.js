//execDataTable("flat");
function execDataTable (text) {

    var sublineasdeproductoTable = $("#sublineasdeproductotable").DataTable({
       "select": {style: 'single'},  
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-sublineaproducto.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod")+"&linea="+$("#linea").val(),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_sublinea"},
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
          //Monstrar Reportes [PDF-PRint-Etc]
         $("#sublineasdeproductotable").on("draw.dt",function(){
             setTimeout(() => {
              sublineasdeproductoTable.buttons().container().appendTo('#sublineasdeproductotable_wrapper .col-md-6:eq(0)');
     
             }, 100);
         })

         sublineasdeproductoTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = sublineasdeproductoTable.rows(indexes).data().toArray();
           console.log("rowData: ", rowData);
           document.getElementById("sublinea").value = rowData[0].cod_sublinea;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = sublineasdeproductoTable.rows(indexes).data().toArray();
           document.getElementById("sublinea").value = "";
         });

   }


   function edit(){
    var date = document.getElementById("linea1").value;
    var date2 = document.getElementById("sublinea").value;
    if(date != "" && date2 != ""){
      window.location.href = ("sublineaproducto/Editar/"+btoa(date+"~"+date2+"~"+localStorage.getItem("token_user")));
    }
  }

  
   var count = 0 ;
   

   function reload(){
    console.log("count: ", count);
    count = count + 1;
    if(count == 2){
      location.reload();
    }
    var lin = document.getElementById('linea').value;
    console.log("lin: ", lin);
    document.getElementById('linea1').value = lin;

    $("#sublineasdeproductotable").DataTable().clear().draw();
    $("#sublineasdeproductotable").DataTable().destroy();
    execDataTable("flat");
    // setTimeout(() => {
    //      execDataTable("flat");
    // }, 10);
    }

    
   //Eliminar registro
$(document).on("click",".removeItem2ids", function(){

  var cod_empresa = btoa(localStorage.getItem("cod"));
  var cod_linea = document.getElementById("linea1").value;
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
              if(response == 200){
                fncSweetAlert(
                  "success",
                  "el registro a sido borrado correctamente",
                  "sublineaproducto"
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