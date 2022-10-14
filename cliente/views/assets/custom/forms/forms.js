
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


  if (type == "CodUsuarioValidate") {
    var pattern = new RegExp("^[a-zA-Z,0,1,2,3,4,5,6,7,9_]{1,20}$");
  }

  if (type == "number") {
    var pattern = new RegExp("^[0,1,2,3,4,5,6,7,8,9]{1,3}$");
  }

  if (type == "text") {
    var pattern = new RegExp("^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}$");
  }

  if (!pattern.test(event.target.value)) {

    $(event.target).parent().addClass("was-validated");
    $(event.target).parent().children(".invalid-feedback").html("Field syntax error");
  }

}




  //activacion de boostrar switch
  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })