<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">

        <h1>Items x establecimiento</h1>
        
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">

          <li class="breadcrumb-item"><a href="#">Home</a></li>
          

          <?php
          if (isset($routesArray1[4])) {
            if ($routesArray1[4] == "create" || $routesArray1[4] == "edit") {
              echo '<li class="breadcrumb-item"><a href="inventario">Iventario</a></li>';
              echo '<li class="breadcrumb-item active">' . $routesArray1[4] . '</li>';
            }
          } else {
            echo '<li class="breadcrumb-item active">inventario</li>';
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

      if ($routesArray1[4] == "create" || $routesArray1[4] == "edit") {
        include "actions/" . $routesArray1[4] . ".php";
      }
    } else {

      include "actions/list.php";
    }

    ?>




  </div>

</section>