<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>Establecimientos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          
          <li class="breadcrumb-item"><a href="#">Home</a></li> 
          
          <?php 
          if (isset($routesArray1[4])) {
            if($routesArray1[4] == "create" || $routesArray1[4] == "edit"){
              echo '<li class="breadcrumb-item"><a href="establecimientos">Establecimientos</a></li>';
              echo '<li class="breadcrumb-item active">'.$routesArray1[4].'</li>';
            }
          }else{
            echo '<li class="breadcrumb-item active">Establecimientos</li>';
          }
      ?>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <?php
    if(isset($routesArray[4]) && $routesArray[4] == "create"){
        include "actions/".$routesArray[4].".php"; 
    }else{
        include "actions/list.php"; 
    }
    ?>
    </div>
</section>