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
            $("#gen_perfil").val(response[0]["cod_perfil"])
           $("#gen_local").val(response[0]["cod_establecimiento"])
           $("#sts_administrador").val(response[0]["sts_administrador"])

           if (response[0]["sts_usuario"]=='A') {
            
            $('#sts_usuario').prop('checked', true);
           }
           if (response[0]["sts_administrador"]=='A') {
            
            $('#sts_administrador').prop('checked', true);
           }
        }
      })
}


