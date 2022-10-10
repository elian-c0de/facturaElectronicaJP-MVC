<?php
include("../../config/config.php");
// session_start();
// if (!isset($_SESSION['user'])) {
//     echo '
//             <script>
//                 alert("Por favor debes iniciar sesión");
//                 window.location = "../logearse/index.php";
//             </script>
//         ';
//     // header("location: ../inc/header.php");
//     session_destroy();
//     die();
// } 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Emisión | FEJP</title>
    //Eliminar
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<?php include('../inc/header.php'); ?>
<body>
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h2><i class="bi bi-funnel"></i> Punto de Emisión</h2>
        
          <form id="P-emision-form">
              <input type="hidden" id="establecimientoId">
              <!-- <input type="hidden" id="emisionId">
              <select class="form-control mb-3" name="codigoEstablecimiento">
                <?php
                    // $query='SELECT * FROM gen_local';
                    // $query2='SELECT cod_empresa FROM gen_usuario';
                    // $result = sqlsrv_query($conn, $query);
                    // $resul2= sqlsrv_query($conn, $query2);
                    // while ($row = sqlsrv_fetch_array($result)) {
                    //   $cod_empresa=$row['cod_empresa'];
                    //   $cod_establecimiento=$row['cod_establecimiento'];
                    //   ?>
                    //     <option value="<?php echo '$cod_empresa' ?>"><?php echo $cod_establecimiento ?></option>
                    //   <?php 
                    // }
                ?>
              </select> -->
              <input type="number" class="form-control mb-3" id="codigo_estable" placeholder="Código de establecimiento" required>
              <input type="number" class="form-control mb-3" id="codigo_emision" placeholder="Código de punto de emisión" required>
              <input type="text" class="form-control mb-3" id="descripcion" placeholder="Descripción">
              <input type="number" class="form-control mb-3" id="caja" placeholder="Caja">
              <input type="number" class="form-control mb-3" id="ambiente" placeholder="Ambiente">
              <input type="number" class="form-control mb-3" id="tipoemision" placeholder="Tipo de emisión">
              <input type="number" class="form-control mb-3" id="numFactura" placeholder="No. de Factura">
              <input type="number" class="form-control mb-3" id="numNotaCredito" placeholder="No. Nota de crédito">
              <input type="number" class="form-control mb-3" id="numRetencion" placeholder="No. Retención">
              <input type="number" class="form-control mb-3" id="numGuiaRemision" placeholder="No. Guía de remisión">
              <input type="text" class="form-control mb-3" id="tipofacturacion" placeholder="Tipo de facturación">
              <input type="text" class="form-control mb-3" id="impresion" placeholder="Impresión">
              <input type="number" class="form-control mb-3" id="numFacturaPrueba" placeholder="No. Factura Prueba">
              <input type="number" class="form-control mb-3" id="numNCPrueba" placeholder="No. NC Prueba">
              <input type="number" class="form-control mb-3" id="numRetencionPrueba" placeholder="No. Retención Prueba">
              <input type="number" class="form-control mb-3" id="numGuiaRemisionPrueba" placeholder="No. Guía de remisión prueba">
              <label><input class="form-check-input" type="checkbox" id="estado" name="estado"> Estado
              <br></br>
              

                
              
              <button id="btn_insert" type="submit" name="insert" class="btn btn-primary" value="Guardar">Guardar</button>
              <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/';" name="cancel" class="btn btn-danger" value="Cancelar">
          </form>
        </div>
      
        <div class="col-md-8" style="overflow:scroll">
            <form class="form-inline my-2 my-lg-0" action="" method="post">
                <h2><i class="bi bi-search"></i> Establecimiento</h2>
                <input name="search" id="search" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <br></br>
            <table class="table table-striped table-hover ">
                <thead class="bg-warning">
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Caja</th>
                        <th>Ambiente</th>
                        <th>Tipo de Emisión</th>
                        <th>No. de Factura</th>
                        <th>No. Nota de crédito</th>
                        <th>No. Retención</th>
                        <th>No. Guía de remisión</th>
                        <th>Tipo de Facturación</th>
                        <th>Impresión</th>
                        <th>No. Factura Prueba</th>
                        <th>No. NC Prueba</th>
                        <th>No. Retención Prueba</th>
                        <th>No. Guía de remisión Prueba</th>
                        <th>Estado</th>
                        <th>Editar/Eliminar</th>
                    </tr>
                </thead>
                <tbody id="emisiones"></tbody>
            </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="controllers/emision.js" ></script>
</body>
</html>