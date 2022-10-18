


function execDataTable (text) {

    var url = "ajax/data-clientes.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");
    var columns = [
      {"data":"num_id"},
      {"data":"cod_tipo_id"},
      {"data":"nom_apellido_rsocial"},
      {"data":"nom_persona_nombre"},
      {"data":"txt_direccion"},
      {"data":"num_telefono"},
      {"data":"txt_email"},
      {"data":"cod_precio"},
      {"data":"actions"}
    ];
  
   var adminsTable = $("#clientesTable").DataTable({
      "responsive": true, 
      "lengthChange": true, 
    
      "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
      "autoWidth": false, 
      "processing": true,
      "serverSide": true,
      "ajax":{
        "url": url,        
        "type":"POST"
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

    if(text == "flat"){
        $("#clientesTable").on("draw.dt",function(){
            setTimeout(() => {
                adminsTable.buttons().container().appendTo('#clientesTable_wrapper .col-md-6:eq(0)');
            }, 100);
    
        })
    }  
}



// parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
function reportActive(event){
    if(event.target.checked){
        $("#clientesTable").dataTable().fnClearTable();
        $("#clientesTable").dataTable().fnDestroy();
        setTimeout(() => {
            execDataTable("flat");
        }, 10);
    }else{
        $("#clientesTable").dataTable().fnClearTable();
        $("#clientesTable").dataTable().fnDestroy();
        setTimeout(() => {
            execDataTable("html");

        }, 10);
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
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment($("#between1").val()),
      endDate  : moment($("#between2").val())
    },
    function (start, end) {
      // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      window.location = "clientes?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
    }
  )






//Elinianr registro
$(document).on("click",".removeItem", function(){
  var idItem = $(this).attr("idItem");
  var table = $(this).attr("table");
  var cod_empresa = $(this).attr("cod_empresa");
  var column = $(this).attr("column");
  var page = $(this).attr("page");

  fncSweetAlert("confirm","estas seguro de eliminar este registro?","").then(resp=>{

    if(resp){
      var data = new FormData();
      data.append("idItem",idItem);
      data.append("table",table);
      data.append("cod_empresa",cod_empresa);
      data.append("column",column);
      data.append("token",localStorage.getItem("token_user"))

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
              "el registro a sido borrado correctamente",
              page
            );
          }else{
            fncNotie(3,"error deleating the record")
          }
        }
      })


    }


  })

})
