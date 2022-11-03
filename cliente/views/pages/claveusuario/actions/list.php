<?php
  $url = "gen_usuario?equalTo=" . trim($_SESSION["admin"]->cod_empresa) .",".trim($_SESSION["admin"]->cod_usuario). "&linkTo=cod_empresa,cod_usuario";
  $method = "GET";
  $fields = array();
  $response = CurlController::request($url, $method, $fields);

  if ($response->status == 200) {
    $admin = $response->result[0];
    // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
  } else {
    echo '<script>
          window.location = "home";
          </script>';
  }
?>

<div class="card card-dark card-outline">
  <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <!-- <input type="hidden" value="<?php echo $admin->num_id ?>" name="idAdmin"> -->
    <div class="card-header">
      <?php
      require_once("controllers/usuarios.controller.php");
      $create = new UsuariosController();
      $create->edit($admin->cod_empresa);
      ?>
      <div class="col-md-8 offset-md-2">

        <!-- USUARIO -->
        <div class="form-group mt-2">
          <label>Usuario</label>
          <input type="text" name="num_id" value="<?php echo $admin->cod_usuario?>" disabled class="form-control">
        </div>


        <!-- NOMBRE -->
        <div class="form-group mt-2">
          <label>Nombre</label>
          <input type="text" name="num_id" value="<?php echo $admin->nom_usuario?>" disabled class="form-control">
        </div>


        <!-- CLAVE ACTUAL -->
        <div class="form-group mt-2">
          <label for="">Clave Actual</label>
          <input type="password" class="form-control" value="<?php echo $admin->cod_passwd?>" disabled class="form-control">
        </div>

      </div>
    </div>
  </form>

  <div class="card-header">

    <h3 class="card-title">
      <a class="btn bg-blue btn-small" href="claveusuario/CambiarClave">Cambiar clave</a>
    </h3>
  </div>

  <!-- FIN DE FORMULARIO USUARIO -->

</div>
<!-- 
<script src="views/assets/custom/datatable/informacionGeneral.datatable.js"></script> -->