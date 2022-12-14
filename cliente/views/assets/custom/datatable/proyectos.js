execDataTable("flat");
function execDataTable (text) {
    var proyectosTable = $("#proyectostable").DataTable({
      select: {
        style: "single",
      },
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-proyectos.php?text="+text+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod"),

         "type":"POST"
       },
       columns:[
         {"data":"cod_proyecto"},
         {"data":"nom_proyecto"},
        //  {"data":"actions"}
       ],
       language: {
         sProcessing: "Procesando...",
         sLengthMenu: "Mostrar _MENU_ Entradas",
         sZeroRecords: "No se encontraron resultados",
         sEmptyTable: "Ningún dato disponible en esta tabla",
         sInfo: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
         sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
         sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
         "select-info": "",
         sInfoPostFix: "",
         sSearch: "Buscar:",
         sUrl: "",
         sInfoThousands: ",",
         sLoadingRecords: "Cargando...",
         oPaginate: {
           sFirst: "Primero",
           sLast: "Último",
           sNext: "Siguiente",
           sPrevious: "Anterior",
         },
         oAria: {
           sSortAscending:
             ": Activar para ordenar la columna de manera ascendente",
           sSortDescending:
             ": Activar para ordenar la columna de manera descendente",
         },
         // url: 'dataTables.spanish.json'
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

    //Monstrar Reportes [PDF-PRint-Etc]
    $("#proyectostable").on("draw.dt",function(){
      setTimeout(() => {
        proyectosTable.buttons().container().appendTo('#proyectostable_wrapper .col-md-6:eq(0)');
      }, 100);

  })

  //Obtener ID del Proyecto
  proyectosTable
    .on("select", function (e, dt, type, indexes) {
      var rowData = proyectosTable.rows(indexes).data().toArray();
      console.log("rowData: ", rowData);
      document.getElementById("proyecto").value = rowData[0].cod_proyecto;
    })
    .on("deselect", function (e, dt, type, indexes) {
      var rowData = proyectosTable.rows(indexes).data().toArray();
      document.getElementById("proyecto").value = "";
    });
  }

  //Editar Proyecto
  function edit(){
    var date = document.getElementById("proyecto").value;
    if(date != ""){
      window.location.href = ("proyectos/Editar/"+btoa(date+"~"+localStorage.getItem("token_user")));
    }
  }
 
  //Elinianr registro
  $(document).on("click",".removeItem", function(){
    var cod_proyecto = document.getElementById("proyecto").value;
    console.log(localStorage.getItem("cod"));
    console.log("cod_proyecto: ", cod_proyecto);
    if(cod_proyecto != ""){
      fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(cod_proyecto+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "ecmp_proyecto"); // nombre de la tabla
          data.append("cod_empresa", btoa(localStorage.getItem("cod"))); // codigo empresa encriptado papa
          data.append("column", "cod_proyecto"); // columna donde se va a buscar el id pk
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
                  "El registro a sido borrado correctamente",
                  "proyectos"
                );
              }else{
                fncNotie(3,"Error al eliminar el registro")
              }
            }
          })
        }
      });
    }
  });