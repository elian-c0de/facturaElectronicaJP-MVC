

//Ingresar datos de calcular SubTotal-IVA-TOTAL
const form= document.getElementById("transactionForm");
form.addEventListener("submit", function(event){
   event.preventDefault();
   let transactionFormData = new FormData(form);
   insertRowInTransactionTable(transactionFormData);
    document.getElementById('cod_inventario').value= ('');
    document.getElementById('txt_descripcion').value= ('');
    document.getElementById('cant').value= ('');
    document.getElementById('cost').value= ('');
    document.getElementById('subtot').value= ('');
    document.getElementById('iva').value= ('');
    document.getElementById('total').value= ('');
   // form.reset();
  //  SubTotalIVA();
  //  IVA();
  //  Total();
   total();
   });



function insertRowInTransactionTable(transactionFormData){
   let transactionTableRef = document.getElementById("movimientoInventariotable1");
   
   let newTransactionRowRef = transactionTableRef.insertRow(1);

   let newTypeCellRef = newTransactionRowRef.insertCell(0);
   newTypeCellRef.textContent = transactionFormData.get("codInven")

   newTypeCellRef = newTransactionRowRef.insertCell(1);
   newTypeCellRef.textContent = transactionFormData.get("descrip")

   newTypeCellRef = newTransactionRowRef.insertCell(2);
   newTypeCellRef.textContent = transactionFormData.get("cant")
   
   newTypeCellRef = newTransactionRowRef.insertCell(3);
   newTypeCellRef.textContent = transactionFormData.get("cost")

   newTypeCellRef = newTransactionRowRef.insertCell(4);
   newTypeCellRef.textContent = transactionFormData.get("subtot")

   newTypeCellRef = newTransactionRowRef.insertCell(5);
   newTypeCellRef.textContent = transactionFormData.get("iva")

   newTypeCellRef = newTransactionRowRef.insertCell(6);
   newTypeCellRef.textContent = transactionFormData.get("total");
   
}

function calcularSubtotal(){
   try {
       var a = parseFloat(document.getElementById("cant").value) || 0.00;
       b = parseFloat(document.getElementById("cost").value) || 0.00;

       document.getElementById("subtot").value = (a*b);

       var c = parseFloat(document.getElementById("subtot").value) || 0.00;
       document.getElementById("iva").value = ((c*12)/100);

       var d = parseFloat(document.getElementById("iva").value) || 0.00;
       document.getElementById("total").value = d+c;
   } catch (error) {  
   }
   
}
function total(){
  let total1 = 0;
  let total2 = 0;
  let total3 = 0;
  const table =document.getElementById("movimientoInventariotable1"); //Almacenamos la id de la tabla
  for (let i = 1; i < table.rows.length-4; i++) { //hacemos un recorrido por la tabla y no contamos la ultima fila (-N)
    // console.log(table.rows[i].cells[4].innerHTML);
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


// function SubTotalIVA(){
//   let total1 = 0;
//   const table =document.getElementById("movimientoInventariotable1"); //Almacenamos la id de la tabla
//   for (let i = 1; i < table.rows.length-4; i++) { //hacemos un recorrido por la tabla y no contamos la ultima fila (-1)
//     // console.log(table.rows[i].cells[4].innerHTML);
//     let rowValue = table.rows[i].cells[4].innerHTML; // lo almacenamos en una variable el resultado de la columna [4]
//     total1 += Number(rowValue); // sumamos los valores
    
//   }
//   // console.log("total1: ", total1);
//   const SubTotalIVA =document.getElementById("SubTotalIVA"); //obtenemos y almacenamos en una valiable el id de la tabledata que hemos creado vacia
//   SubTotalIVA.textContent = total1; // Hacemos que se muestre el total en la tabledata que hemos creado.
// }

// function IVA(){
//   let total2 = 0;
//   const table1 =document.getElementById("movimientoInventariotable1"); //Almacenamos la id de la tabla
//   for (let i = 1; i < table1.rows.length-4; i++) { //hacemos un recorrido por la tabla y no contamos la ultima fila (-2)
//     // console.log(table.rows[i].cells[4].innerHTML);
//     let rowValue = table1.rows[i].cells[5].innerHTML; // lo almacenamos en una variable el resultado de la columna [5]
//     total2 += Number(rowValue); // sumamos los valores
    
//   }
//   // console.log("total2: ", total2);
//   const IVA =document.getElementById("IVA"); //obtenemos y almacenamos en una valiable el id de la tabledata que hemos creado vacia
//   IVA.textContent = total2; // Hacemos que se muestre el total en la tabledata que hemos creado.
// }


// function Total(){
//   let total2 = 0;
//   const table1 =document.getElementById("movimientoInventariotable1"); //Almacenamos la id de la tabla
//   for (let i = 1; i < table1.rows.length-4; i++) { //hacemos un recorrido por la tabla y no contamos la ultima fila (-2)
//     // console.log(table.rows[i].cells[4].innerHTML);
//     let rowValue = table1.rows[i].cells[6].innerHTML; // lo almacenamos en una variable el resultado de la columna [5]
//     total2 += Number(rowValue); // sumamos los valores
    
//   }
//   // console.log("total2: ", total2);
//   const Total =document.getElementById("Total"); //obtenemos y almacenamos en una valiable el id de la tabledata que hemos creado vacia
//   Total.textContent = total2; // Hacemos que se muestre el total en la tabledata que hemos creado.
// }



//*************************************************** */
// $(document).ready(function(){
//       let total = 0;

//         let celdasPrecio = document.querySelectorAll('td + td + td + td + td');

//         for(let i = 0; i < celdasPrecio.length; ++i){
//             total += parseFloat(celdasPrecio[i].firstChild.data);
//             //console.log("total: ", total);
//         }

//         let nuevaFila = document.createElement('tr');
        
//         let celdaTotal1 = document.createElement('td');
//         let textoCeldaTotal1 = document.createTextNode('');
//         celdaTotal1.appendChild(textoCeldaTotal1);
//         nuevaFila.appendChild(celdaTotal1);

//         let celdaTotal2 = document.createElement('td');
//         let textoCeldaTotal2 = document.createTextNode('');
//         celdaTotal2.appendChild(textoCeldaTotal2);
//         nuevaFila.appendChild(celdaTotal2);

//         let celdaTotal3 = document.createElement('td');
//         let textoCeldaTotal3 = document.createTextNode('');
//         celdaTotal3.appendChild(textoCeldaTotal3);
//         nuevaFila.appendChild(celdaTotal3);


//         let celdaTotal = document.createElement('td');
//         let textoCeldaTotal = document.createTextNode('Total:');
//         celdaTotal.appendChild(textoCeldaTotal);
//         nuevaFila.appendChild(celdaTotal);

//         let celdaValorTotal = document.createElement('td');
//         let textoCeldaValorTotal = document.createTextNode(total);
//         celdaValorTotal.appendChild(textoCeldaValorTotal);
//         nuevaFila.appendChild(celdaValorTotal);

//         document.getElementById('movimientoInventariotable1').appendChild(nuevaFila);
//    });

   // prueba de codigo*****************************************

  //  function cargarDetalle() {
  //     const url = base_url + "compras/listar/detalle";
  //     const http = new XMLHttpRequest();
  //     http.open("GET", url, true);
  //     http.send();
  //     http.onreadystatechange = function() {
  //         if (this.readyState == 4 && this.status == 200) {
  //             const res = JSON.parse(this.responseText);
  //             let html = ""; 
  //             res.detalle.forEach((row) => {
  //                 html += `<tr>
  //                <td>${row.descripcion}</td>
  //                <td width="120"><input type="number" class="form-control" value="${row.cantidad}" step="0.01" min="0.01" onchange="cantidadCompra(${row.id}, event)" /> </td>
  //                <td>${row.precio}</td>
  //                <td>${row.sub_total}</td>
  //                <td>
  //                <button class="btn btn-outline-danger" type="button" onclick="deleteDetalle(${row.id}, 1)">
  //                <i class="fas fa-trash-alt"></i></button>
  //                </td>
  //                </tr>`;
  //             });
  //             document.getElementById("tblDetalle").innerHTML = html;
  //             document.getElementById("alert_total").textContent = res.total_pagar;
  //         }
  //     };
  // }

//   fin de prueba de codigo******************************






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
   document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
 
   // var num_documento= document.getElementById("num_documento");
   // if (num_documento==" ") {
   //    num_documento="1";
   // } else {
   //    num_documento = substr(num_documento,3);
   //    num_documento = intval(num_documento);
   //    num_documento = (num_documento+1);

   // }
   //Incremento NUMERO
   if(document.getElementById("num_documento").value==""){
      document.getElementById("num_documento").value='1';
   }else{

   }
 }

 function rellenar(){
   //var cod_usuario = document.getElementById('gen_usuario');
 
   var data = new FormData();
 
     data.append("cod_inventario",$("#cod_inventario").val());
     
     data.append("cod_empresa",localStorage.getItem('cod'));
 
     $.ajax({
       url: "ajax/data-movimientoInventario.php",
       method: "POST",
       data: data,
       contentType: false,
       cache: false,
       dataType: 'json',
       processData: false,
       success: function(response){
           console.log("response: ", response[0]["txt_descripcion"]);
           console.log("response: ", response);
           
 
         //   // document.getElementById("cod_usuario").value=response[0]["cod_usuario"];
           $("#txt_descripcion").val(response[0]["txt_descripcion"]);
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
 
 