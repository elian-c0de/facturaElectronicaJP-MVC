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
  <base href="<?php echo TemplateController::path() ?>"

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
        $routesArray1[3] == "admins") {
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