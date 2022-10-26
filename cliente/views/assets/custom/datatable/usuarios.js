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

            document.ready = document.getElementById("gen_perfil").value = response[0]["cod_perfil"];

        }
      })
}


