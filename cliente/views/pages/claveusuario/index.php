
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fa-solid fa-key"></i>Cambio de Clave</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <?php
            if (isset($routesArray1[4])) {
              if ($routesArray1[4] == "Crear" || $routesArray1[4] == "CambiarClave") {
                echo '<li class="breadcrumb-item"><a href="claveusuario">Cambio de clave</a></li>';
                echo '<li class="breadcrumb-item active">' . $routesArray1[4] . '</li>';
              }
            } else {
              echo '<li class="breadcrumb-item active">Cambio de clave</li>';
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
        if ($routesArray1[4] == "Crear" || $routesArray1[4] == "CambiarClave") {
          include "actions/" . $routesArray1[4] . ".php";
        }
      }else{
        include "actions/list.php";
      }
    ?>
  </div>
</section>