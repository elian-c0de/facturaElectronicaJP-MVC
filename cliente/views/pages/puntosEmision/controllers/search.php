<?php

include('database.php');

$search = $_POST['search'];
if(!empty($search)) {
  $query = "SELECT * FROM gen_local WHERE cod_establecimiento LIKE '$search%'";
  $result = sqlsrv_query($connection, $query);
  
  if(!$result) {
    die("Couldn't connect to database".sqlsrv_error($conn));
  }
  
  $json = array();
  while($row = sqlsrv_fetch_array($result)) {
    $json[] = array(
        'cod_establecimiento' => $row['cod_establecimiento'],
        'txt_descripcion' => $row['txt_descripcion'],
        'txt_direccion' => $row['txt_direccion'],
        'sts_matriz' => $row['sts_matriz'],
        'sts_local' => $row['sts_local'],
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

?>
