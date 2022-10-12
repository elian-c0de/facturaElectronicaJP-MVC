<?php

/** create XML file */ 
require_once "../controllers/curl.controller.php";

// $query = "SELECT id, title, author_name, price, ISBN, category FROM establecimientos";
$query = "SELECT * FROM gen_local";

$establecimientosArray = array();

if ($result = sqlsrv_query($conn, $query)) {

    /* fetch associative array */
    while ($row = sqlsrv_fetch_array($result)) {

       array_push($establecimientosArray, $row);
    }
  
    if(count($establecimientosArray)){

         $xmlFile = createXMLfile($establecimientosArray);
         echo "<br /><br /><h3>XML file generated successfully.
               <br />Click <a href='".$xmlFile."'>".$xmlFile."</a> link to open.<h3>";
    }else {
         echo "<br /><br /><h3>No record found! </h4>";
      }
    /* free result set */
   //  $result->free();
}
/* close connection */
// $mysqli->close();

function createXMLfile($establecimientosArray){
  
   $filePath = 'establecimientos.xml';

   $dom     = new DOMDocument('1.0', 'utf-8'); 

   $root      = $dom->createElement('establecimientos'); 

   for($i=0; $i<count($establecimientosArray); $i++){
     
     $cod        =  $establecimientosArray[$i]['cod_establecimiento'];  

     $desc      =  htmlspecialchars($establecimientosArray[$i]['txt_descripcion']); 

     $direc    =  $establecimientosArray[$i]['txt_direccion']; 

     $matriz     =  $establecimientosArray[$i]['sts_matriz']; 

     $estado      =  $establecimientosArray[$i]['sts_local']; 

   //   $fec  =  $establecimientosArray[$i]['fec_actualiza'];	

     $establecimientos = $dom->createElement('establecimientos');

     $establecimientos->setAttribute('codigo', $cod);

     $name     = $dom->createElement('descripcion', $desc); 

     $establecimientos->appendChild($name); 

     $author   = $dom->createElement('direccion', $direc); 

     $establecimientos->appendChild($author); 

     $price    = $dom->createElement('matriz', $matriz); 

     $establecimientos->appendChild($price); 

     $isbn     = $dom->createElement('local', $estado); 

     $establecimientos->appendChild($isbn); 
     
   //   $category = $dom->createElement('fecha', $fec); 

   //   $establecimientos->appendChild($category);
 
     $root->appendChild($establecimientos);

   }

   $dom->appendChild($root); 

   if($dom->save($filePath)){
      return $filePath;
   }
   return false; 

 } 