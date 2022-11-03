
function execDataTable() {
  var url =
    "ajax/data-itemsxestablecimiento.php?&between1=" +
    $("#between1").val() +
    "&between2=" +
    $("#between2").val() +
    "&token=" +
    localStorage.getItem("token_user") +
    "&code=" +
    localStorage.getItem("cod") +
    "&establecimiento=" +
    $("#establecimiento").val();
  var columns = [
    { data: "cod_inventario" },
    { data: "txt_descripcion" },
    { data: "sts_control_saldo" },
    { data: "sts_modifica_precio" },
    { data: "qtx_minimo" },
    { data: "qtx_maximo" },
    { data: "qtx_saldo" },
    { data: "val_costo" },
    { data: "val_descuento" },
    { data: "por_descuento" },
    { data: "sts_item_local" },
    { data: "actions" }
    
  ];

  var adminsTable = $("#itemsxestablecimientoTable").DataTable({
    responsive: false,
    lengthChange: true,
    select: { style: "single" },
    aLengthMenu: [
      [5, 10, 20, 50, 100],
      [5, 10, 20, 50, 100],
    ],
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: {
      url: url,
      type: "POST",
    },
    scrollY:        "500px",
    scrollX:        true,
    scrollCollapse: true,
    columnDefs: [
        { width: 200, targets: 0 }
    ],
    fixedColumns: true,
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
    columns: columns,
    buttons: [
      { extend: "copy", className: "btn-dark" },
      { extend: "csv", className: "btn-b" },
      { extend: "excel", className: "btn-g" },
      { extend: "pdf", className: "btn-g" },
      { extend: "print", className: "btn-g" },
      { extend: "colvis", className: "btn-g" },
    ],
    fnDrawCallback: function (oSettings) {
      if (oSettings.aoData.length == 0) {
        $(".dataTables_paginate").hide();
        $(".dataTables_info").hide();
      }
    },
  });

  $("#itemsxestablecimientoTable").on("draw.dt", function () {
    setTimeout(() => {
      adminsTable
        .buttons()
        .container()
        .appendTo("#itemsxestablecimientoTable_wrapper .col-md-6:eq(0)");
    }, 100);
  });



  adminsTable
    .on("select", function (e, dt, type, indexes) {
      rowData = adminsTable.rows(indexes).data().toArray();
      console.log(rowData);
      document.getElementById("inventarioID").value = rowData[0].cod_inventario;
    })
    .on("deselect", function (e, dt, type, indexes) {
      rowData = adminsTable.rows(indexes).data().toArray();
      document.getElementById("inventarioID").value = "";
    });
}


$(document).on("click", "#coso", function () {
  var idItem = $(this).attr("idItem");
  console.log("idItem: ", idItem);
  var url ="ajax/data-itemsxestablecimiento_precio.php?token=" +localStorage.getItem("token_user") +"&code=" +localStorage.getItem("cod") +"&establecimiento="+$("#establecimiento").val()+"&idItem="+idItem;
  var columns = [
    { data: "cod_precio" },
    { data: "txt_descripcion" },
    { data: "val_costo" },
    { data: "val_porcentaje_costo" },
    { data: "val_precio" },
    { data: "sts_iva" },
    { data: "val_iva" },
    { data: "val_final" },
    { data: "actions" }
    
  ];

  var adminsTable = $("#itemsxestablecimiento_precio").DataTable({
    responsive: false,
    lengthChange: true,
    aLengthMenu: [
      [5, 10, 20, 50, 100],
      [5, 10, 20, 50, 100],
    ],

    autoWidth: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: url,
      type: "POST",
    }, 
    scrollY:        "500px",
    scrollX:        true,
    scrollCollapse: true,
    columnDefs: [
        { width: 200, targets: 0 }
    ],
    fixedColumns: true,
  
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
    columns: columns,
    buttons: [
      { extend: "copy", className: "btn-dark" },
      { extend: "csv", className: "btn-b" },
      { extend: "excel", className: "btn-g" },
      { extend: "pdf", className: "btn-g" },
      { extend: "print", className: "btn-g" },
      { extend: "colvis", className: "btn-g" },
    ],

  });

  // adminsTable
  //   .on("select", function (e, dt, type, indexes) {
  //     rowData = adminsTable.rows(indexes).data().toArray();
  //     document.getElementById("inventarioID").value = rowData[0].cod_inventario;
  //   })
  //   .on("deselect", function (e, dt, type, indexes) {
  //     rowData = adminsTable.rows(indexes).data().toArray();
  //     document.getElementById("inventarioID").value = "";
  //   });


  
})




var count = 0;

function reload() {
  console.log("count: ", count);
  count = count +1;
  if (count == 2) {
    location.reload();
  }

  $("#itemsxestablecimientoTable").DataTable().clear().draw();
  $("#itemsxestablecimientoTable").DataTable().destroy();
  execDataTable();
  // var table = $("#itemsxestablecimientoTable").DataTable();
  // table.ajax.reload();
  // setTimeout(() => {
  //   execDataTable();
  // }, 10);
}


function recalcular(){
  

  var v1 = document.getElementById("val_costo").value;
  var v2 = document.getElementById("val_porcentaje_costo").value;
  if(v2 != 0){
    document.getElementById("val_precio").value = v1*v2;

    if ($('#sts_iva').prop('checked')) {
      document.getElementById("iva").value = ((v1*v2)*0.12);
      document.getElementById("valor_final").value = ((v1*v2)*0.12)+(v1*v2);
    }else{
      document.getElementById("iva").value = "";
      document.getElementById("valor_final").value = (v1*v2);
    }
 
  }else{

    var v3 = document.getElementById("val_precio").value;
    if (v3 == v1) {


      document.getElementById("val_precio").value = v1;
      console.log("v1: ", v1);
      if ($('#sts_iva').prop('checked')) {
        document.getElementById("iva").value = ((v1)*0.12);
        document.getElementById("valor_final").value = ((v1)*0.12) +v1;
      }else{
        document.getElementById("iva").value = "";
        document.getElementById("valor_final").value = (v1);
      }
  
    }else{

      v3 = parseInt(v3);

      if ($('#sts_iva').prop('checked')) {
        document.getElementById("iva").value = ((v3)*0.12);
        document.getElementById("valor_final").value = ((v3)*0.12) +v3;
      }else{
        document.getElementById("iva").value = "";
        document.getElementById("valor_final").value = (v3);
      }

    }


   
  }

  // document.getElementById("val_porcentaje_costo").value;
  // document.getElementById("val_costo").value;
  // document.getElementById("val_precio").value;
  // document.getElementById("sts_iva").value;
  // document.getElementById("valor_final").value;
  // document.getElementById("iva").value;


}







function edit() {
  console.log(document.getElementById("inventarioID").value);

  var cod_inventario = document.getElementById("inventarioID").value;
  if (cod_inventario != "") {
    window.location.href =
      "itemsxestablecimiento/edit/" +
      btoa(
        cod_inventario +
          "~" +
          $("#establecimiento").val() +
          "~" +
          localStorage.getItem("token_user")
      );
  }
}

//rango de fechas
$("#daterange-btn").daterangepicker(
  {
    ranges: {
      Today: [moment(), moment().add(1, "days")],
      Yesterday: [moment().subtract(1, "days"), moment()],
      "Last 7 Days": [moment().subtract(6, "days"), moment().add(1, "days")],
      "Last 30 Days": [moment().subtract(29, "days"), moment().add(1, "days")],
      "This Month": [moment().startOf("month"), moment().endOf("month")],
      "Last Month": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
      Todo: [moment().subtract(10, "year"), moment().add(1, "days")],
    },
    startDate: moment($("#between1").val()),
    endDate: moment($("#between2").val()),
  },
  function (start, end) {
    // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    window.location =
      "itemsxestablecimiento?start=" +
      start.format("YYYY-MM-DD") +
      "&end=" +
      end.format("YYYY-MM-DD");
  }
);

$(document).on("click", ".removeItem", function () {
  var cod_inventario = document.getElementById("inventarioID").value;

  if (cod_inventario != "") {
    fncSweetAlert(
      "confirm",
      "estas seguro de eliminar este registro?",
      ""
    ).then((resp) => {
      if (resp) {
        var data = new FormData();
        data.append("idItem", btoa(cod_inventario+"~"+$("#establecimiento").val()+"~"+localStorage.getItem("token_user")));
        data.append("table", "ecmp_item_local");
        data.append("cod_empresa", btoa(localStorage.getItem("cod")));
        data.append("column", "cod_inventario");
        data.append("column1", "cod_establecimiento");
        data.append("token", localStorage.getItem("token_user"));

        $.ajax({
          url: "ajax/ajax-delete2ids.php",
          method: "POST",
          data: data,
          contentType: false,
          cache: false,
          processData: false,
          success: function (response) {
            console.log("response: ", response);
            if (response == 200) {
              fncSweetAlert(
                "success",
                "el registro a sido borrado correctamente",
                "itemsxestablecimiento"
              );
            } else {
              fncNotie(3, "error deleating the record");
            }
          },
        });
      } else {
        location.reload();
      }
    });
  }
});
