
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
function validateRepeat1(event,type,table,columna) {

  var data = new FormData();
  data.append("data", event.target.value);
  data.append("table", table);
  data.append("columna", columna);
  $.ajax({
    type: "POST",
    url: "ajax/ajax-validate1.php",
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
function validateRepeat(event,type,table,columna,id) {


    var data = new FormData();
    data.append("data", event.target.value);
    data.append("table", table);
    data.append("columna", columna);
    data.append("id", id);
    
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


function validateRepeatSublinea(event,type,table,columna,id) {

    
    if($("#linea").val() != ""){

      var data = new FormData();
      data.append("data", event.target.value);
      data.append("table", table);
      data.append("columna", columna);
      data.append("id", id);
      data.append("linea", $("#linea").val());
        $.ajax({
          type: "POST",
          url: "ajax/ajax-validate_linea.php",
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
    }else{
      validateJS(event,type);
    }   
    
    

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
  if(type == "cod_tipo_id_representante") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,13}$/;
  if(type == "txt_descripcion") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,60}$/;
  if(type == "nom_marca") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,70}$/;
  if(type == "txt_descripcion_inventario") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/;
  if(type == "cod_pre") pattern = /^[a-zA-Z0-9]{1,2}$/;
  if(type == "cod_verif") pattern = /^[0-9]{1,3}$/;
  if(type == "txt_descrip") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/;
  if(type == "cod_inventario") pattern = /^[-\\A-Z0-9]{1,30}$/;
  if(type == "cod_barras") pattern = /^[-0-9]{1,30}$/;
  if(type == "qtx_saldo") pattern = /^[0-9]{1,18}([.][0]{1,2})?$/
  if(type == "val_costo") pattern = /^[0-9]{1,18}([.][0-9]{1,5})?$/
  if(type == "num_id") pattern = /^[0,1,2,3,4,5,6,7,8,9]{1,13}$/;
  if(type == "nom_apellido_rsocial") pattern = /^[-//0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/;
  if(type == "nom_persona_nombre") pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/;
  if(type == "txt_direccion_cliente") pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,150}$/;
  if(type == "num_telefono_cliente") pattern = /^[-\\(\\)\\0-9 ]{1,15}$/;
  if(type == "txt_descripcionforma_pago") pattern = /^[-//0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/;
  if(type == "txt_descripcionConcepto") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,125}$/;
  if(type == "txt_descripcionParametro") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/;
  if(type == "valorParametro") pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\#\\?\\¿\\!\\¡\\:\\,\\.\\//\\'\\@\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}$/;
  if(type == "cod_for_pag") pattern = /^[A-Z]{1,2}$/;
  if(type == "cod_parametro") pattern = /^[A-Z\\_]{1,10}$/;
  if(type == "cod_concepto") pattern = /^[0-9]{1,2}$/;
  if(type == "cod_establecimiento") pattern = /^[a-zA-Z0-9]{1,3}$/;
  if(type == "cod_caja") pattern = /^[0-9]{1,2}$/;
  if(type == "cod_proyecto") pattern = /^[a-zA-Z0-9]{1,5}$/;
  if(type == "cod_perfil") pattern = /^[a-zA-Z0-9]{1,6}$/;
  if(type == "nom_perfil") pattern = /^[a-zA-Z0-9]{1,50}$/;
  if(type == "cod_rete") pattern = /^[a-zA-Z1-9]{1,5}$/;
  if(type == "cod_marca") pattern = /^[0-9]{1,3}$/;
  if(type == "descrip_formapag") pattern = /^[-//%0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}$/;
  if(type == "por_reten") pattern = /^[0-9]{1,3}([.][0-9]{1,2})?$/;
  if(type == "nom_usuario") pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}$/;
  if(type == "cod_usuario") pattern = /^[a-zñÑáéíóúÁÉÍÓÚ ]{1,20}$/;
  if(type == "cod_punto_emision") pattern = /^[a-zA-Z0-9]{1,3}$/;
  if(type == "num_factura") pattern = /^[0-9]{1,9}$/;

  if (!pattern.test(event.target.value)) {
 
    $(event.target).parent().addClass("was-validated");
    $(event.target).parent().children(".invalid-feedback").html("Field syntax error");
  }

}




  //activacion de boostrar switch
  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })