

execDataTable();
function execDataTable () {

    var url = "ajax/data-pedidos.php?&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user")+"&code="+localStorage.getItem("cod");
    var columns = [

   
      {"data":"num_pedido"},
      {"data":"num_detalle"},
      {"data":"cod_inventario"},
      {"data":"txt_descripcion"},
      {"data":"val_cantidad"},
      {"data":"val_unitario"},
      {"data":"val_porcentaje_iva"},
      
    ];
  
   var pedidostable = $("#pedidostable").DataTable({
      "responsive": true, 
      "lengthChange": true,
      "select": {style: 'single'},
      "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
      "autoWidth": false, 
      "processing": true,
      "serverSide": true,
      "ajax":{
        "url": url,        
        "type":"POST"
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
      "columns": columns,
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
    
        $("#pedidostable").on("draw.dt",function(){
            setTimeout(() => {
                pedidostable.buttons().container().appendTo('#pedidostable_wrapper .col-md-6:eq(0)');
            }, 100);
    
        })




        pedidostable
        .on("select", function (e, dt, type, indexes) {
          var rowData = pedidostable.rows(indexes).data().toArray();
          console.log("rowData: ", rowData);
          document.getElementById("pedidosID").value = rowData[0].num_documento;
          document.getElementById("pedidosID1").value = rowData[0].cod_inventario;
        })
        .on("deselect", function (e, dt, type, indexes) {
          var rowData = pedidostable.rows(indexes).data().toArray();
          document.getElementById("pedidosID").value = "";
          document.getElementById("pedidosID1").value = "";
        });
     
}




function edit(){
    var date = document.getElementById("pedidosID").value;
    var date2 = document.getElementById("pedidosID1").value;
    if(date != "" && date2 != ""){
      window.location.href = ("pedidos/Editar/"+btoa(date+"~"+date2+"~"+localStorage.getItem("token_user")));
    }
  }




//rango de fechas
$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Today'       : [moment(), moment().add(1,'days')],
      'Yesterday'   : [moment().subtract(1, 'days'), moment()],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment().add(1,'days')],
      'Last 30 Days': [moment().subtract(29, 'days'), moment().add(1,'days')],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      'Todo' : [moment().subtract(10,'year'),moment().add(1,'days')]
    },
    startDate: moment($("#between1").val()),
    endDate  : moment($("#between2").val())
  },
  function (start, end) {
    // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    window.location = "pedidos?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
  }
)





//Elinianr registro
$(document).on("click",".removeItem1", function(){
    var num_documento = document.getElementById("pedidosID").value;
    var cod_inventario = document.getElementById("pedidosID1").value;
    if(num_documento != "" && cod_inventario != ""){
      fncSweetAlert("confirm","Estas seguro de eliminar este registro?","").then(resp=>{
    
        if(resp){
          var data = new FormData();
          //MODIFICAR PARAMETROS
          data.append("idItem", btoa(num_documento+"~"+cod_inventario+"~"+localStorage.getItem("token_user"))); // id pk de la tabla + toke encriptrado
          data.append("table", "ecmp_detalle_inventario"); // nombre de la tabla
          data.append("column", "num_documento"); // columna donde se va a buscar el id pk
          data.append("column1", "cod_inventario"); // columna donde se va a buscar el id pk
          data.append("token", localStorage.getItem("token_user"));
    
          $.ajax({
            url: "ajax/ajax-delete3.php",
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
                  "movimientoInventario"
                );
              }else{
                fncNotie(3,"Error al eliminar el registro")
              }
            }
          })
    
    
        }
    
    
      })
    }
  })

  window.onload = function(){
    //FECHA ACTUAL
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('fec_documento').value=ano+"-"+mes+"-"+dia;
  
    // var num_documento= document.getElementById("num_documento");
    // if (num_documento==" ") {
    //    num_documento="1";
    // } else {
    //    num_documento = substr(num_documento,3);
    //    num_documento = intval(num_documento);
    //    num_documento = (num_documento+1);
 
    // }
    //Incremento NUMERO
    
  }

  var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})