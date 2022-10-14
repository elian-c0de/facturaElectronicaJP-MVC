function execDataTable (text) {

    var moviminetoInventarioTable = $("#moviminetoInventariotable").DataTable({
       "responsive": true, 
       "lengthChange": true, 
       "aLengthMenu": [[5,10,20,50,100],[5,10,20,50,100]],
       "autoWidth": false, 
       "processing": true,
       "serverSide": true,
       "ajax":{
         "url":"ajax/data-moviminetoInventario.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val(),
         "type":"POST"
       },
       "columns":[
         {"data":"cod_concepto"},
         {"data":"txt_descripcion"},
         {"data":"sts_facturacion"},
         {"data":"sts_tipo_concepto"},
         {"data":"sts_proceso"},
         {"data":"sts_inventario"},
         {"data":"sts_concepto"},
         {"data":"actions"}
       ],
       "buttons": [
         {extend:"copy",className:"btn-dark"},
         {extend:"csv",className:"btn-b"},
         {extend:"excel",className:"btn-g"},
         {extend:"pdf",className:"btn-g"},
         {extend:"print",className:"btn-g"},
         {extend:"colvis",className:"btn-g"}
     ]
     })
 
     if(text == "flat"){
         $("#moviminetoInventariotable").on("draw.dt",function(){
             setTimeout(() => {
              moviminetoInventarioTable.buttons().container().appendTo('#moviminetoInventariotable_wrapper .col-md-6:eq(0)');
     
             }, 100);
     
         })
     }
   }
 
 // parte donde agarra info del list si el boton esta activo o no y muestra un texto enriquecidos
 function reportActive(event){
     if(event.target.checked){
         $("#moviminetoInventariotable").dataTable().fnClearTable();
         $("#moviminetoInventariotable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("flat");
         }, 10);
     }else{
         $("#moviminetoInventariotable").dataTable().fnClearTable();
         $("#moviminetoInventariotable").dataTable().fnDestroy();
         setTimeout(() => {
             execDataTable("html");
         }, 10);
     }
 }

 //Ingresar datos de calcular SubTotal-IVA-TOTAL
 const form= document.getElementById("transactionForm");
 form.addEventListener("submit", function(event){
    event.preventDefault();
    let transactionFormData = new FormData(form);
    insertRowInTransactionTable(transactionFormData);
    form.reset();


 })

 function insertRowInTransactionTable(transactionFormData){
    let transactionTableRef = document.getElementById("movimientoInventariotable");
    
    let newTransactionRowRef = transactionTableRef.insertRow(-1);

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
        var a = parseFloat(document.getElementById("cant").value) || 0.00,
        b = parseFloat(document.getElementById("cost").value) || 0.00;

        document.getElementById("subtot").value = (a*b);

        var c = parseFloat(document.getElementById("subtot").value) || 0.00;
        document.getElementById("iva").value = ((c*12)/100);

        var d = parseFloat(document.getElementById("iva").value) || 0.00;
        document.getElementById("total").value = d+c;
    } catch (error) {  
    }

 }
//  function calcularIva(){
//     try {
//         var c = parseFloat(document.getElementById("subtot").value) || 0;

//         document.getElementById("iva").value = ((c*12)/100);
//     } catch (error) {  
//     }

//  }
//  function cantidadVenta(id, e) {
//     const url = base_url + "ventas/cantidadVenta";
//     let data = new FormData();
//     data.append("id", id);
//     data.append("cantidad", e.target.value);
//     const http = new XMLHttpRequest();
//     http.open("POST", url, true);
//     http.send(data);
//     http.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             console.log(this.responseText);
//             const res = JSON.parse(this.responseText);
//             if (res.icono != "success") {
//                 alertas(res.msg, res.icono);
//             }
//             cargarDetalleVenta();
//         }
//     };
// }


//  function calcularSubtotal2(){
//     v1= $('#cant').val();
//     v2= $('#cost').val();

//     $.ajax({
//         url:"ajax/data-moviminetoInventario.php",
//         type: 'post',
//         data:{cant:v1,cost:v2},
//         success:function(respuesta){
//         $('#subtot').html(respuesta);
        
//         }

//     })

//  }