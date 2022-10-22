<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1><i class=" fa-solid fa-cart-shopping mr-1"></i>Puntos de Emision</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          
          <li class="breadcrumb-item"><a href="#">Home</a></li> 
          
          <?php 
          if (isset($routesArray1[4])) {
            if($routesArray1[4] == "create" || $routesArray1[4] == "edit"){
              echo '<li class="breadcrumb-item"><a href="puntosEmision">Puntos de Emision</a></li>';
              echo '<li class="breadcrumb-item active">'.$routesArray1[4].'</li>';
            }
          }else{
            echo '<li class="breadcrumb-item active">Puntos de Emision</li>';
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
    //PREGUNTAMOS SI EXISTE UN VALOR EN EL INDICE 4
    if (isset($routesArray1[4])) {
      if ($routesArray1[4] == "create" || $routesArray1[4] == "edit" || $routesArray[4] == "XML") {
        include "actions/" . $routesArray1[4] . ".php";
      }
      }else{
      include "actions/list.php";
    }
    ?>
    </div>
</section>