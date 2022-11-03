// execDataTable("flat");
function execDataTable (text) {
  var puntoemisionTable = $("#puntoemisiontable").DataTable({
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
     columns:[
       {data:"cod_punto_emision"},
       {data:"txt_descripcion"},
       {data:"cod_caja"},
       {data:"sts_ambiente"},
       {data:"sts_tipo_emision"},
       {data:"num_factura"},
       {data:"num_nota_credito"},
       {data:"num_retencion"},
       {data:"num_guia"},
       {data:"sts_tipo_facturacion"},
       {data:"sts_impresion"},
       {data:"sts_punto_emsion"},
       {data:"num_factura_prueba"},
       {data:"num_nota_credito_prueba"},
       {data:"num_retencion_prueba"},
       {data:"num_guia_prueba"},
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
      ]
    })

     //Monstrar Reportes [PDF-PRint-Etc]
    $("#puntoemisiontable").on("draw.dt",function(){
        setTimeout(() => {
          puntoemisionTable.buttons().container().appendTo('#puntoemisiontable_wrapper .col-md-6:eq(0)');

        }, 100);
    })

    //Obtener ID del punto de emision
    puntoemisionTable
    .on("select", function (e, dt, type, indexes) {
      var rowData = puntoemisionTable.rows(indexes).data().toArray();
      document.getElementById("puntoemision").value = rowData[0].cod_punto_emision;
    })
    .on("deselect", function (e, dt, type, indexes) {
      var rowData = puntoemisionTable.rows(indexes).data().toArray();
      document.getElementById("puntoemision").value = "";
    });
 }

 //Recargar tabla al seleccionar combobox
 var count = 0;
  function reload(){
    console.log("count: ", count);
    count = count +1;
    if (count == 2) {
      location.reload();
    }
    var lin = document.getElementById('cod_establecimiento').value;
    console.log("lin: ", lin);
    document.getElementById('establecimiento').value = lin;
    $("#puntoemisiontable").DataTable().clear().draw();
    $("#puntoemisiontable").DataTable().destroy(); $
    execDataTable();
  }


 //Editar Punto de Emision
 function edit(){
  var date = document.getElementById("establecimiento").value;
  var date2 = document.getElementById("puntoemision").value;
  if(date != "" && date2 != ""){
    window.location.href = ("puntosEmision/Editar/"+btoa(date+"~"+date2+"~"+localStorage.getItem("token_user")));
  }
}

//Elinianr registro
$(document).on("click",".removeItem2ids", function(){
  var cod_establecimiento = document.getElementById("establecimiento").value;
  var cod_punto_emision = document.getElementById("puntoemision").value;
  console.log(localStorage.getItem("cod"));
  console.log("cod_punto_emision: ", cod_punto_emision);
  if(cod_establecimiento != "" && cod_punto_emision != ""){
    fncSweetAlert("confirm","Estas seguro de eliminar este registro?","").then(resp=>{
  
      if(resp){
        var data = new FormData();
        //MODIFICAR PARAMETROS
        data.append("idItem", btoa(cod_establecimiento+"~"+cod_punto_emision+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
        data.append("table", "gen_punto_emision"); // nombre de la tabla
        data.append("cod_empresa", btoa(localStorage.getItem("cod"))); // nombre de la empresa
        data.append("column", "cod_establecimiento"); // columna donde se va a buscar el id pk
        data.append("column1", "cod_punto_emision"); // columna donde se va a buscar el id pk
        data.append("token", localStorage.getItem("token_user"));
  
        $.ajax({
          url: "ajax/ajax-delete2ids.php",
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
                "puntosEmision"
              );
            }else{
              fncNotie(3,"error deleating the record")
            }
          }
        })
  
  
      }
  
  
    })
  }
})
