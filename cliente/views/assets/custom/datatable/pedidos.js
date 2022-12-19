//Ingresar datos de calcular SubTotal-IVA-TOTAL
const form= document.getElementById("transactionForm");
// form.addEventListener("submit", function(event){
  document.getElementById("Guardar").addEventListener("click", myFunction);
  function myFunction() {
  //  event.preventDefault();
   let transactionFormData = new FormData(form);
   insertRowInTransactionTable(transactionFormData);
    document.getElementById('cod_inventario').value= ('');
    document.getElementById('txt_descripcion').value= ('');
    document.getElementById('qtx_cantidad').value= ('');
    document.getElementById('val_costo').value= ('');
    document.getElementById('subtot').value= ('');
    document.getElementById('iva').value= ('');
    document.getElementById('total').value= ('');
    document.getElementById('qtx_saldo').value= ('');
   // form.reset();
   total();

   };



function insertRowInTransactionTable(transactionFormData){
   let transactionTableRef = document.getElementById("pedidostable1");
   
   let newTransactionRowRef = transactionTableRef.insertRow(1);

   let newTypeCellRef = newTransactionRowRef.insertCell(0);
   newTypeCellRef.textContent = transactionFormData.get("cod_inventario")

   newTypeCellRef = newTransactionRowRef.insertCell(1);
   newTypeCellRef.textContent = transactionFormData.get("txt_descripcion")

   newTypeCellRef = newTransactionRowRef.insertCell(2);
   newTypeCellRef.textContent = transactionFormData.get("qtx_cantidad")
   
   newTypeCellRef = newTransactionRowRef.insertCell(3);
   newTypeCellRef.textContent = transactionFormData.get("val_costo")

   newTypeCellRef = newTransactionRowRef.insertCell(4);
   newTypeCellRef.textContent = transactionFormData.get("subtot")

   newTypeCellRef = newTransactionRowRef.insertCell(5);
   newTypeCellRef.textContent = transactionFormData.get("iva")

   newTypeCellRef = newTransactionRowRef.insertCell(6);
   newTypeCellRef.textContent = transactionFormData.get("total");

   newTypeCellRef = newTransactionRowRef.insertCell(7);
   newTypeCellRef.textContent = transactionFormData.get("qtx_saldo");
   
}

function calcularSubtotal(){
  try {
      var a = parseFloat(document.getElementById("qtx_cantidad").value) || 0.00;
      b = parseFloat(document.getElementById("val_costo").value) || 0.00;

      document.getElementById("subtot").value = (a*b);

      var c = parseFloat(document.getElementById("subtot").value) || 0.00;
      document.getElementById("iva").value = ((c*12)/100);

      var d = parseFloat(document.getElementById("iva").value) || 0.00;
      document.getElementById("total").value = d+c;
  } catch (error) {  
  }
  
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

//   var myModal = document.getElementById('myModal')
// var myInput = document.getElementById('myInput')

// myModal.addEventListener('shown.bs.modal', function () {
//   myInput.focus()
// })


function rellenar(){
  //var cod_usuario = document.getElementById('gen_usuario');

  var data = new FormData();

    data.append("cod_inventario",$("#cod_inventario").val());
    
    data.append("cod_empresa",localStorage.getItem('cod'));

    $.ajax({
      url: "ajax/data-movimientoInventarioRellenar.php",
      method: "POST",
      data: data,
      contentType: false,
      cache: false,
      dataType: 'json',
      processData: false,
      success: function(response){
         //  console.log("response: ", response[0]["txt_descripcion"]);
         //  console.log("response: ", response);
          

        //   // document.getElementById("cod_usuario").value=response[0]["cod_usuario"];
          $("#txt_descripcion").val(response[0]["txt_descripcion"]);
          $("#val_costo").val(response[0]["val_costo"]);
          $("#qtx_saldo").val(response[0]["qtx_saldo"]);
          
          //$("#val_costo").val(response[0]["val_costo"]);
        //   $("#nom_usuario").val(response[0]["nom_usuario"]);
        //   $("#gen_perfil").val(response[0]["cod_perfil"]);
        //   $("#gen_punto_emision1").val(response[0]["cod_establecimiento"])
        //  $("#gen_punto_emision").val(response[0]["cod_punto_emision"]);
        //  $("#sts_administrador").val(response[0]["sts_administrador"]);

        //  if (response[0]["sts_usuario"]=='A') {
          
        //   $('#sts_usuario').prop('checked', true);
        //  }else{
        //   $('#sts_usuario').prop('checked', false);
        //  }
        //  if (response[0]["sts_administrador"]=='A') {
          
        //   $('#sts_administrador').prop('checked', true);
        //  }else{
        //   $('#sts_administrador').prop('checked', false);
        //  }
      }
    })
}

function total(){
  let total1 = 0;
  let total2 = 0;
  let total3 = 0;
  const table =document.getElementById("pedidostable1"); //Almacenamos la id de la tabla
  for (let i = 1; i < table.rows.length-4; i++) { //hacemos un recorrido por la tabla y no contamos la ultima fila (-N)
    //console.log(table.rows[i].innerHTML);
    let rowValue = table.rows[i].cells[4].innerHTML; // lo almacenamos en una variable el resultado de la columna [N]
    total1 += Number(rowValue); // sumamos los valores
    
    let rowValue2 = table.rows[i].cells[5].innerHTML; // lo almacenamos en una variable el resultado de la columna [5]
    total2 += Number(rowValue2); // sumamos los valores

    let rowValue3 = table.rows[i].cells[6].innerHTML; // lo almacenamos en una variable el resultado de la columna [5]
    total3 += Number(rowValue3); // sumamos los valores
  }
  // console.log("total1: ", total1);
  const SubTotalIVA =document.getElementById("SubTotalIVA"); //obtenemos y almacenamos en una valiable el id de la tabledata que hemos creado vacia
  SubTotalIVA.textContent = total1; // Hacemos que se muestre el total en la tabledata que hemos creado.

  const IVA =document.getElementById("IVA"); //obtenemos y almacenamos en una valiable el id de la tabledata que hemos creado vacia
  IVA.textContent = total2; // Hacemos que se muestre el total en la tabledata que hemos creado.

  const Total =document.getElementById("Total"); //obtenemos y almacenamos en una valiable el id de la tabledata que hemos creado vacia
  Total.textContent = total3; // Hacemos que se muestre el total en la tabledata que hemos creado.
}


function obtenerDatos(){
  const table = document.getElementById("pedidostable1"); //Almacenamos la id de la tabla
  var array = [];

  var data = new FormData();
  for (let i = 1; i < table.rows.length-4; i++) {
    var hola = "";
    for (let j = 0; j < table.rows[i].cells.length; j++) {
      hola = hola + table.rows[i].cells[j].innerHTML + ",";
    }

    array.push(hola);
  }

   console.log(array);

  for (var i = 0; i < array.length; i++) {
      data.append('array[]',array[i]);
    }

 





  // DATOS PARA CREATE 
  data.append("cod_empresa",localStorage.getItem("cod"));
  data.append("num_id",document.getElementById("num_id").value);
  data.append("num_pedido",document.getElementById("num_documento").value);
  data.append("token",localStorage.getItem("token_user"));
  data.append("cod_usuario",localStorage.getItem("codus"));

  //INVENTARIO CABECERA
  data.append("nom_nombre_rsocial",document.getElementById("NombreApellido").value);
  data.append("fec_actualiza",document.getElementById("fec_documento").value);
  // data.append("txt_descripcion",document.getElementById("txt_descripcion1").value);

  // //DATOS DE LA TABLA
  // data.append("data",array);
  console.log("data: ", data);
 
  

  $.ajax({
    url: "controllers/pedidosmovimiento.controllers.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response){
      console.log("response: ", response);
      if(response == 200){
        fncSweetAlert(
          "success",
          "el registro a sido ingresado correctamente",
          "pedidos"
        );
      }else{
        fncNotie(3,"Error al ingresar el registro")
      }
    }
  })


}