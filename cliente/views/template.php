<?php 
session_start();

/*=============================================
Capturar las rutas de la URL
=============================================*/

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);


/*=============================================
Limpiar la Url de variables GET
=============================================*/
foreach ($routesArray as $key => $value) {

  $value = explode("?", $value)[0];
  
  $routesArray1[$key] = $value;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Factura Electronica JP</title>
  <link rel="shortcut icon" href="views/assets/img/AdminLTELogo.png">
  <base href="<?php echo TemplateController::path() ?>">
  <!-- Iconos Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="views/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/assets/css/adminlte.min.css">
  <link rel="stylesheet" href="views/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="views/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- jQuery -->
  <script src="views/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="views/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="views/assets/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- InputMask -->
  <script src="views/assets/plugins/moment/moment.min.js"></script>
  <script src="views/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  
  <script src="views/assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="views/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="views/assets/plugins/jszip/jszip.min.js"></script>
  <script src="views/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="views/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<?php

if(!isset($_SESSION["admin"])){
  include ("views/pages/login/index.php");
  echo "</body></head>";
  return;
}

?>
<?php  if(isset($_SESSION["admin"])):  ?>

  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- navbar -->
    <?php include("modules/navbar.php"); ?>

    <!-- Main Sidebar Container -->
    <?php include("modules/slidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
     <?php 
    //  echo '<pre>'; print_r($routesArray1); echo '</pre>';
     if(!empty($routesArray1[3])){
        if ($routesArray1[3] == "Cajas" ||
        $routesArray1[3] == "logout" ||
        $routesArray1[3] == "informacionGeneral" || 
        $routesArray1[3] == "cajas" || 
        $routesArray1[3] == "establecimientos" || 
        $routesArray1[3] == "puntosEmision" || 
        $routesArray1[3] == "proyectos" || 
        $routesArray1[3] == "perfiles" || 
        $routesArray1[3] == "conceptos" ||
        $routesArray1[3] == "parametros" ||
        $routesArray1[3] == "retenciondeImpuestos" || 
        $routesArray1[3] == "usuarios" || 
        $routesArray1[3] == "movimientoInventario" || 
        $routesArray1[3] == "pedidos" || 
        $routesArray1[3] == "facturacion" || 
        $routesArray1[3] == "notasCredito" || 
        $routesArray1[3] == "movimientoCaja" ||
        $routesArray1[3] == "tipoprecio" || 
        $routesArray1[3] == "lineasdeproducto" ||
        $routesArray1[3] == "marcas" ||
        $routesArray1[3] == "formadepago" ||
        $routesArray1[3] == "gastosCompras" ||
        $routesArray1[3] == "comprobantesRetencion" ||
        $routesArray1[3] == "guiasRemision" ||
        $routesArray1[3] == "permisos" ||
        $routesArray1[3] == "kardexinventario" ||
        $routesArray1[3] == "comprobantesemitidos" ||
        $routesArray1[3] == "historialcliente" ||
        $routesArray1[3] == "precios" ||
        $routesArray1[3] == "info_ventasygastos" ||
        $routesArray1[3] == "topventas" ||
        $routesArray1[3] == "ats_sri") {
          include ("views/pages/".$routesArray1[3]."/index.php");
        }else{
          include ("views/pages/404/404.php");
        }
     }else{
      include ("views/pages/home.php");
    }
     ?> 

    </div>
      <!-- /.content-wrapper -->
      <?php include("modules/footer.php"); ?>
  </div>
  <!-- ./wrapper -->

<!-- datatable -->
<?php  endif  ?>
<script src="views/assets/custom/forms/forms.js"></script>
</body>
</html>