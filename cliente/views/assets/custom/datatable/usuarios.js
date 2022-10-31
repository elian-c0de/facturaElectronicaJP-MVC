function rellenar(){
    //var cod_usuario = document.getElementById('gen_usuario');

    var data = new FormData();

      data.append("cod_usuario",$("#gen_usuario").val());
      
      data.append("cod_empresa",localStorage.getItem('cod'));

      $.ajax({
        url: "ajax/data-usuarios.php",
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
  $("#gen_punto_emision").change(function(){
    var data = "id="+$("#gen_punto_emision").val();
    console.log("data: ", data);
    $.ajax({
          url: "ajax/data-puntoemision.php",
          method: "POST",
          data: data,
          contentType: false,
          cache: false,
          dataType: 'json',
          processData: false,
          beforeSend: function(){
            $("gen_punto_emision").html("Procesando, espere por favor..");
          },
          success: function(response){
            //  if ($("#gen_punto_emision").val(response[0]["cod_establecimiento"])) {
            //   $("#gen_punto_emision").val(response[0]["cod_punto_emision"])
            //   console.log("response:", response[0]["cod_establecimiento"]);
            //  }
            // 
            //console.log("response[0][cod_punto_emision]: ", response[0]["cod_punto_emision"]); 
            $("#gen_punto_emision").html(response);
            // console.log("response: ", response[0]["cod_punto_emision"]); 
            // console.log("response: ", response[0]["cod_establecimiento"]); 
      
            
          }
        })
  })
})


function rellenar2(){
  //var cod_usuario = document.getElementById('gen_usuario');

  var data = new FormData();

    data.append("cod_usuario",$("#gen_usuario").val());
    
    data.append("cod_empresa",localStorage.getItem('cod'));

    $.ajax({
      url: "ajax/data-usuarios.php",
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


