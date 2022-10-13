<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1><i class=" fa-solid fa-shop mr-1"></i>Establecimientos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          
          <li class="breadcrumb-item"><a href="#">Home</a></li> 
          
          <?php 
          if (isset($routesArray1[4])) {
            if($routesArray1[4] == "create" || $routesArray1[4] == "edit" || $routesArray1[4] == "XML"){
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
    if(isset($routesArray[4]) && $routesArray[4] == "create" || $routesArray[4] == "XML"){
        include "actions/".$routesArray[4].".php"; 
    }else{
        include "actions/list.php"; 
    }
    ?>
    </div>
</section>