execDataTable("flat");
function execDataTable (text) {
    
    var usuariosTable = $("#usuariostable").DataTable({
       "select": {style: 'single'},
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-usuarios.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),  
         "type":"POST"
       },
       "columns":[
         {"data":"cod_usuario"},
         {"data":"nom_usuario"},
         {"data":"cod_perfil"},
         {"data":"cod_establecimiento"},
         {"data":"cod_punto_emision"},
         {"data":"sts_usuario"},
         {"data":"sts_administrador"},
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
 
 
         $("#usuariostable").on("draw.dt",function(){
             setTimeout(() => {
              usuariosTable.buttons().container().appendTo('#usuariostable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })

         usuariosTable
         .on("select", function (e, dt, type, indexes) {
           var rowData = usuariosTable.rows(indexes).data().toArray();
           document.getElementById("usuarios").value = rowData[0].cod_usuario;
         })
         .on("deselect", function (e, dt, type, indexes) {
           var rowData = usuariosTable.rows(indexes).data().toArray();
           document.getElementById("usuarios").value = "";
         });

   }

   function edit(){
    var date = document.getElementById("usuarios").value;
    if(date != ""){
      window.location.href = ("usuarios/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
    }
  }

//Elinianr registro
$(document).on("click",".removeItem", function(){
  // var idItem = $(this).attr("idItem");
  // var table = $(this).attr("table");
  // var cod_empresa = $(this).attr("cod_empresa");
  // var column = $(this).attr("column");
  // var page = $(this).attr("page");
  var cod_usuario = document.getElementById("usuarios").value;
  console.log(localStorage.getItem("cod"));
  console.log("cod_usuario: ", cod_usuario);
  if(cod_usuario != ""){
    fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

      if(resp){
        var data = new FormData();
        //MODIFICAR PARAMETROS
        data.append("idItem", btoa(cod_usuario+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
        data.append("table", "gen_usuario"); // nombre de la tabla
        data.append("cod_empresa", btoa(localStorage.getItem("cod"))); // codigo empresa encriptado papa
        data.append("column", "cod_usuario"); // columna donde se va a buscar el id pk
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
                "el registro a sido borrado correctamente",
                "usuarios"
              );
            }else{
              fncNotie(3,"error deleating the record")
            }
          }
        })


      }


    });
  }

});




function rellenar(){
    //var cod_usuario = document.getElementById('gen_usuario');

    var data = new FormData();

      data.append("cod_usuario",$("#gen_usuario").val());
      
      data.append("cod_empresa",localStorage.getItem('cod'));

      $.ajax({
        url: "ajax/data-usuariosRellenar.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        dataType: 'json',
        processData: false,
        success: function(response){
            console.log("response: ", response[0]["cod_perfil"]);
            console.log("response: ", response);
            

            // document.getElementById("cod_usuario").value=response[0]["cod_usuario"];
            $("#cod_usuario").val(response[0]["cod_usuario"]);
            $("#nom_usuario").val(response[0]["nom_usuario"]);
            $("#gen_perfil").val(response[0]["cod_perfil"]);
            $("#gen_punto_emision1").val(response[0]["cod_establecimiento"])
           $("#gen_punto_emision").val(response[0]["cod_punto_emision"]);
           $("#sts_administrador").val(response[0]["sts_administrador"]);

           if (response[0]["sts_usuario"]=='A') {
            
            $('#sts_usuario').prop('checked', true);
           }else{
            $('#sts_usuario').prop('checked', false);
           }
           if (response[0]["sts_administrador"]=='A') {
            
            $('#sts_administrador').prop('checked', true);
           }else{
            $('#sts_administrador').prop('checked', false);
           }
        }
      })
}
// $(document).ready(function(){
//   $('#gen_local').val(1);
//   recargarLista();

//   $('#gen_local').change(function(){
//     recargarLista();
//   });
// })
// function recargarLista(){
//   $.ajax({
//     type:"POST",
//     url:"ajax/data-moviminetoInventario.php",
//     data:"continente=" + $('#gen_local').val(),
//     success:function(r){
//       $('#gen_punto_emision').html(r);
//     }
//   });
// }

$(document).ready(function(e){
  $("#gen_punto_emision1").change(function(){
    var data = new FormData();

      data.append("cod_usuario",$("#gen_usuario").val());
      
      data.append("cod_empresa",localStorage.getItem('cod'));
      
     data = "id="+$("#gen_punto_emision1").val();
    console.log("data: ", data);
    $.ajax({
          url: "ajax/data-puntoemisionRellenar.php",
          method: "POST",
          data: data,
          // contentType: false,
          // cache: false,
          // dataType: 'json',
          // processData: false,
          beforeSend: function(){
            $("gen_punto_emision").html("Procesando, espere por favor..");
            //alert("Enviando");
          },
          success: function(response){
            console.log("response: ", response);
            $("#gen_punto_emision").html(response);
      
          },
          error: function(){
            alert("ERROR LPM");
          }
        })
  })
})


// function rellenar2(){
//   //var cod_usuario = document.getElementById('gen_usuario');

//   var data = new FormData();

//     data.append("cod_usuario",$("#gen_usuario").val());
    
//     data.append("cod_empresa",localStorage.getItem('cod'));

//     $.ajax({
//       url: "ajax/data-usuarios.php",
//       method: "POST",
//       data: data,
//       contentType: false,
//       cache: false,
//       dataType: 'json',
//       processData: false,
//       success: function(response){
//           console.log("response: ", response[0]["cod_perfil"]);
//           console.log("response: ", response);
          

//           // document.getElementById("cod_usuario").value=response[0]["cod_usuario"];
//           $("#cod_usuario").val(response[0]["cod_usuario"]);
//           $("#nom_usuario").val(response[0]["nom_usuario"]);
//           $("#gen_perfil").val(response[0]["cod_perfil"]);
//           $("#gen_punto_emision1").val(response[0]["cod_establecimiento"])
//          $("#gen_punto_emision").val(response[0]["cod_punto_emision"]);
//          $("#sts_administrador").val(response[0]["sts_administrador"]);

//          if (response[0]["sts_usuario"]=='A') {
          
//           $('#sts_usuario').prop('checked', true);
//          }else{
//           $('#sts_usuario').prop('checked', false);
//          }
//          if (response[0]["sts_administrador"]=='A') {
          
//           $('#sts_administrador').prop('checked', true);
//          }else{
//           $('#sts_administrador').prop('checked', false);
//          }
//       }
//     })
// }




// function obtenerDatos() {
//   var data = new FormData();

//   data.append("cod_usuario",$("#gen_usuario").val());
//       //data.append("cod_punto_emision",$("#gen_punto_emision1").val());
//       data.append("cod_empresa",localStorage.getItem('cod'));
//       // console.log("data: ", data);
//   $.ajax({
//     url: "ajax/data-puntoemision.php",
//     method: "POST",
//     data: data,
//     contentType: false,
//     cache: false,
//     dataType: 'json',
//     processData: false,
//     success: function(response){
//       //  if ($("#gen_punto_emision").val(response[0]["cod_establecimiento"])) {
//       //   $("#gen_punto_emision").val(response[0]["cod_punto_emision"])
//       //   console.log("response:", response[0]["cod_establecimiento"]);
//       //  }
//       // 
//       //console.log("response[0][cod_punto_emision]: ", response[0]["cod_punto_emision"]); 
//       $("#gen_punto_emision2").val(response[0]["cod_punto_emision"])
//       // console.log("response: ", response[0]["cod_punto_emision"]); 
//       // console.log("response: ", response[0]["cod_establecimiento"]); 

      
//     }
//   })
  
// }


