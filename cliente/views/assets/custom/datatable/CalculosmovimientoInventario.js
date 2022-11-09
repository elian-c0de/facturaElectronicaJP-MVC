

//Ingresar datos de calcular SubTotal-IVA-TOTAL
const form= document.getElementById("transactionForm");
form.addEventListener("submit", function(event){
   event.preventDefault();
   let transactionFormData = new FormData(form);
   insertRowInTransactionTable(transactionFormData);
    document.getElementById('codInven').value= ('');
    document.getElementById('descrip').value= ('');
    document.getElementById('cant').value= ('');
    document.getElementById('cost').value= ('');
    document.getElementById('subtot').value= ('');
    document.getElementById('iva').value= ('');
    document.getElementById('total').value= ('');
   // form.reset();
      
   });



function insertRowInTransactionTable(transactionFormData){
   let transactionTableRef = document.getElementById("movimientoInventariotable1");
   
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

//FECHA ACTUAL
window.onload = function(){
   var fecha = new Date(); //Fecha actual
   var mes = fecha.getMonth()+1; //obteniendo mes
   var dia = fecha.getDate(); //obteniendo dia
   var ano = fecha.getFullYear(); //obteniendo año
   if(dia<10)
     dia='0'+dia; //agrega cero si el menor de 10
   if(mes<10)
     mes='0'+mes //agrega cero si el menor de 10
   document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
 }