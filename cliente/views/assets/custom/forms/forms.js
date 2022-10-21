
//validacion desde boostraro 4

(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();



function obtenerdata(cod_empresa){
  var data = new FormData();
  data.append("coddata", cod_empresa);

  $.ajax({
    url: "ajax/ajax-delete.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response){
      return response;
    }
  })

}


function validateRepeat(event,type,table,columna,id) {

    var data = new FormData();
    data.append("data", event.target.value);
    data.append("table", table);
    data.append("columna", columna);
    data.append("id", id);
    console.log(event.target.value);
    $.ajax({
      type: "POST",
      url: "ajax/ajax-validate.php",
      data: data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        if(response == 200){
          event.target.value = "";
          $(event.target).parent().addClass("was-validated");
          $(event.target).parent().children(".invalid-feedback").html("Datos ya creado");
        }else{
          validateJS(event,type);
        }
      }
    });
}


function validateJS(event, type) {
  var pattern;

  if(type == "num_ruc") pattern = /^[0-9]{1,13}$/;
  if(type == "nom_empresa") pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}$/;
  if(type == "nom_abreviado") pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,15}$/;
  if(type == "txt_direccion") pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,225}$/;
  if(type == "num_telefono") pattern = /^[-\\(\\)\\0-9 ]{1,10}$/;
  if(type == "txt_email") pattern = /^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;
  if(type == "num_res_agente_ret") pattern = /^[0-9]{1,30}$/;
  if(type == "txt_path_logo") pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}$/;
  if(type == "cod_tipo_id_representante") pattern = /^[A-Z]{1,1}$/;
  if(type == "txt_descripcion") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,60}$/;
  if(type == "cod_pre") pattern = /^[a-zA-Z0-9]{1,2}$/;
  if(type == "cod_verif") pattern = /^[0-9]{1,3}$/;
  if(type == "txt_descrip") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/;
  




  if (!pattern.test(event.target.value)) {
    console.log("estamos aqui");
    $(event.target).parent().addClass("was-validated");
    $(event.target).parent().children(".invalid-feedback").html("Field syntax error");
  }

}




  //activacion de boostrar switch
  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })