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
        processData: false,
        success: function(response){
            console.log("response: ", response[cod_usuario]);

            //document.getElementById("cod_usuario").value=response.cod_usuario;
        }
      })
}