execDataTable("flat");
function execDataTable(text) {
  var establecimientosTable = $("#establecimientostable").DataTable({
    select: {
      style: "single",
    },
    responsive: true,
    lengthChange: true,
    aLengthMenu: [
      [5, 10, 20, 50, 100],
      [5, 10, 20, 50, 100],
    ],
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: {
      url:
        "ajax/data-establecimientos.php?text=" +
        text +
        "&token=" +
        localStorage.getItem("token_user") +
        "&code=" +
        localStorage.getItem("cod"),

      type: "POST",
    },
    columns: [
      { data: "cod_establecimiento" },
      { data: "txt_descripcion" },
      { data: "txt_direccion" },
      { data: "sts_matriz" },
      { data: "sts_local" },
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
    buttons: [
      { extend: "copy", className: "btn-dark" },
      { extend: "csv", className: "btn-b" },
      { extend: "excel", className: "btn-g" },
      { extend: "pdf", className: "btn-g" },
      { extend: "print", className: "btn-g" },
      { extend: "colvis", className: "btn-g" },
    ],
  });

  //Obtener ID del establecimiento
    establecimientosTable
      .on("select", function (e, dt, type, indexes) {
        var rowData = establecimientosTable.rows(indexes).data().toArray();
        document.getElementById("establecimiento").value = rowData[0].cod_establecimiento;
      })
      .on("deselect", function (e, dt, type, indexes) {
        var rowData = establecimientosTable.rows(indexes).data().toArray();
        document.getElementById("establecimiento").value = "";
      });

}

//Editar Establecimiento
function edit(){
  var date = document.getElementById("establecimiento").value;
  if(date != ""){
    window.location.href = ("establecimientos/edit/"+btoa(date+"~"+localStorage.getItem("token_user")));
  }
}

//Elinianr Establecimiento
$(document).on("click", ".removeItem", function () {
  // var idItem = $(this).attr("idItem");
  // var table = $(this).attr("table");
  // var cod_empresa = $(this).attr("cod_empresa");
  // var column = $(this).attr("column");
  // var page = $(this).attr("page");
  var date = document.getElementById("establecimiento").value;
  if(date != ""){
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
  }
});
