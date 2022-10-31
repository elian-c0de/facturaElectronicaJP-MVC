execDataTable("flat");
function execDataTable (text) {
    var puntoemisionTable = $("#puntoemisionTable").DataTable({
        select: {
            style: "single",
          },
       responsive: true, 
       lengthChange: true, 
       aLengthMenu: [[5,10,20,50,100],[5,10,20,50,100]],
       autoWidth: false, 
       processing: true,
       serverSide: true,
       ajax:{
         url:"ajax/data-puntoemision.php?text="+text+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod")+"&cod_establecimiento="+$("#cod_establecimiento").val(),
         type:"POST"
       },
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
       columns:[
         {"data":"cod_punto_emision"},
         {"data":"txt_descripcion"},
         {"data":"cod_caja"},
         {"data":"sts_ambiente"},
         {"data":"sts_tipo_emision"},
         {"data":"num_factura"},
         {"data":"num_nota_credito"},
         {"data":"num_retencion"},
         {"data":"num_guia"},
         {"data":"sts_tipo_facturacion"},
         {"data":"sts_impresion"},
         {"data":"num_factura_prueba"},
         {"data":"num_nota_credito_prueba"},
         {"data":"num_retencion_prueba"},
         {"data":"num_guia_prueba"},
         {"data":"sts_punto_emsion"},
         {"data":"actions"}
       ],
       buttons: [
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
    $("#puntoemisionTable").on("draw.dt",function(){
        setTimeout(() => {
            puntoemisionTable.buttons().container().appendTo('#puntoemisionTable_wrapper .col-md-6:eq(0)');
        }, 100);

    })

    //Obtener ID del Punto de Emision
    puntoemisionTable
      .on("select", function (e, dt, type, indexes) {
        var rowData = puntoemisionTable.rows(indexes).data().toArray();
        document.getElementById("puntoEmision").value = rowData[0].cod_punto_emision;
      })
      .on("deselect", function (e, dt, type, indexes) {
        var rowData = puntoemisionTable.rows(indexes).data().toArray();
        document.getElementById("puntoEmision").value = "";
      });
    }

    //Editar Punto de Emision
    function edit(){
    var date = document.getElementById("puntoEmision").value;
      if(date != ""){
        window.location.href = ("puntosEmision/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
      }
    }

    //Elinianr Punto de Emision
    $(document).on("click", ".removeItem", function () {
      var idItem = $(this).attr("idItem");
      var table = $(this).attr("table");
      var cod_empresa = $(this).attr("cod_empresa");
      var column = $(this).attr("column");
      var page = $(this).attr("page");

      fncSweetAlert("confirm", "estas seguro de eliminar este registro?", "").then(
        (resp) => {
          if (resp) {
            var data = new FormData();
            data.append("idItem", idItem);
            data.append("table", table);
            data.append("cod_empresa", cod_empresa);
            data.append("column", column);
            data.append("token", localStorage.getItem("token_user"));

            $.ajax({
              url: "ajax/ajax-delete.php",
              method: "POST",
              data: data,
              contentType: false,
              cache: false,
              processData: false,
              success: function (response) {
                if (response == 200) {
                  fncSweetAlert(
                    "success",
                    "el registro a sido borrado correctamente",
                    page
                  );
                } else {
                  fncNotie(3, "Error al eliminar el registro");
                }
              },
            });
          }
        }
      );
    });