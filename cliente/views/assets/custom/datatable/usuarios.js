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
            $("#cod_usuario").val(response[0]["cod_usuario"])
            $("#nom_usuario").val(response[0]["nom_usuario"])

            // document.ready = document.getElementById("gen_perfil").value = response[0]["cod_perfil"];
            $("#gen_perfil").val(response[0]["cod_perfil"])
            //document.ready = document.getElementById("gen_local").value = response[0]["cod_establecimiento"];
           $("#gen_local").val(response[0]["cod_establecimiento"])

           //$("#sts_usuario").val(response[0]["sts_usuario"])
           $("#sts_administrador").val(response[0]["sts_administrador"])
           document.getElementById("sts_usuario").value = response[0]["sts_usuario"].checked = true;
          //  console.log("checkboxUsuario: ", checkboxUsuario);
          //  console.log("", response[0]["sts_usuario"]);
           if (response[0]["sts_usuario"]=='A') {
            
              // checkboxUsuario.checked=true;
           }
           if (response[0]["sts_usuario"]=='C') {
            
           }
        }
      })
}


