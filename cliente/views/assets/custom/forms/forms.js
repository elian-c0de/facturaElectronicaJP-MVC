
//validacion desde boostraro 4

(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();


  function validateJS(event,type){


    if(type == "text"){
      var pattern = new RegExp("^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}$");
        console.log("pattern: ", pattern);
        console.log("event.target: ", event.target.value);
        
        if(!pattern.test(event.target.value)){
            console.log("entre aqui")
            $(event.target).parent().addClass("was-validate");
            $(event.target).parent().children(".invalid-feedback").html("el usuario esta mal escrito");
        }
    }
   

  }


  //activacion de boostrar switch
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })