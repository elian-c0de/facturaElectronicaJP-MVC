<div class="card card-dark card-outline">
  <form method="post" class="needs-validation" novalidate enctype="multipart/form-data"><section class="content-header">
    <div class="card-header">
      <?php
      require_once("controllers/usuarios.controller.php");
      $create = new UsuariosController();
      $create->create();
      ?>
      <div class="col-md-8 offset-md-2">

      <!-- VALIDAR TIPO DE USUARIOS
        <div class="form-group mt-2">
          <label>Usuario:</label>
          
          // require_once("controllers/admins.controllers.php");
          $create = new UsuariosController();
          $tipo_precio = $create->codigo_nombre_estado_usuario();
          $tipo_precio = json_encode($tipo_precio);
          $tipo_precio = json_decode($tipo_precio, true);
          ?>
          <select class="form-control select2 changeCountry" name="gen_usuario" id="gen_usuario" onchange="rellenar()">
              <option value>Seleccione El Usuario</option>
               foreach ($tipo_precio as $key => $value) : ?>
                  <option value=" echo $value["cod_usuario"] ?>">
                   echo $value["cod_usuario"] ?> 
                  </option>
               endforeach ?>
          </select>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback">Por Favor, rellene este campo</div>
				</div>   -->

      <!-- DIVICIÓN DEL CAMPO: USUARIO -->
        <!-- <div class="form-group mt-2">
            <p class="lead">Usuario</p>
        </div> -->

        <!-- CÓDIGO DE USUARIO -->
        <div class="form-group mt-2">
          <label>Código: </label>
          <input 
          type="text"
          name="cod_usuario" 
          id="cod_usuario"
          class="form-control"
          onchange="validateRepeat(event,'cod_usuario','gen_usuario','cod_usuario', <?php echo $_SESSION['admin']->cod_empresa?>)"
          pattern="[a-zñÑáéíóúÁÉÍÓÚ ]{1,20}$"
          required
          >
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback"> Por Favor, rellene este campo</div>
        </div>

       <!-- NOMBRE DE USUARIO -->
       <div class="form-group mt-2">
          <label>Nombre:</label>
          <input 
          type="text"
          name="nom_usuario" 
          id="nom_usuario"
          class="form-control"
          onchange="validateRepeat(event,'nom_usuario','gen_usuario','nom_usuario', <?php echo $_SESSION['admin']->cod_empresa?>)"
          pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}$"
          required>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback"> Por Favor, rellene este campo</div>
        </div>

       <!-- CONTRASEÑA -->
       <div class="form-group mt-2">
          <label>Contraseña:</label>
          <input 
          type="password"
          name="cod_passwd" 
          id="cod_passwd"
          class="form-control"
          onchange="validateRepeat(event,'cod_passwd','gen_usuario','cod_passwd', <?php echo $_SESSION['admin']->cod_empresa?>)"
          pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{8,20}$"
          required>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback"> Por Favor, rellene este campo</div>
        </div>


        <!-- VALIDAR PERFIL DE USUARIOS -->
        <div class="form-group mt-2">
          <label>Perfil:</label>
          <?php
          // require_once("controllers/admins.controllers.php");
          $create = new UsuariosController();
          $tipo_precio = $create->perfil_usuario();
          $tipo_precio = json_encode($tipo_precio);
          $tipo_precio = json_decode($tipo_precio, true);
          ?>
          <select class="form-control select2 changeCountry" name="gen_perfil" id="gen_perfil" >
              <option value>Seleccione el Perfil</option>
              <?php foreach ($tipo_precio as $key => $value) : ?>
                  <option value="<?php echo $value["cod_perfil"] ?>">
                  

                   <?php echo $value["nom_perfil"] ?>


                  </option>
              <?php endforeach ?>
          </select>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback"> Por Favor, rellene este campo</div>
				</div>  






        <!-- VALIDAR ESTABLECIMIENTO DE USUARIOS -->
        <div class="form-group mt-2"> 
          <label>Establecimiento/Punto Emisión:</label>
          <?php
          // require_once("controllers/admins.controllers.php");
          $create = new UsuariosController();
          $tipo_precio = $create->puntoEmision_usuario();
          $tipo_precio = json_encode($tipo_precio);
          $tipo_precio = json_decode($tipo_precio, true);
          ?>
          <select class="form-control select2 changeCountry"   name="gen_punto_emision1" id="gen_punto_emision1">
              <option value>Seleccione el Establecimiento</option>
              <?php foreach ($tipo_precio as $key => $value) : ?>
                  <option value="<?php echo $value["cod_establecimiento"] ?>~<?php echo $value["cod_punto_emision"] ?>">
                  <?php echo $value["cod_establecimiento"] ?> | <?php echo $value["cod_punto_emision"] ?> | <?php echo $value["txt_descripcion"] ?>
                  </option>
              <?php endforeach ?>
          </select>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback"> Por Favor, rellene este campo</div>
				</div> 

       
        <!-- OJOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO ------------------------------>
      

        <!-- VALIDAR PUNTO DE EMISIÓN DE USUARIOS
        <div class="form-group mt-2"> 
          <label>Punto de Emisión:</label>
          <select name="cod_punto_emision" id="cod_punto_emision"><option value>Seleccione el Punto de Emisión</option></select>
          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
				</div>  -->

        <!-- AQUIIIIIIIIIII TERMINAAAA--------------------------------------------------- -->

        <!-- DIVICIÓN DEL CAMPO: USUARIO -->
        <div class="form-group mt-2">
            <p class="lead">Activo</p>
        </div>

         <!-- ESTADO -->
        <div class="form-group mt-2">
            <label for="">Estado:</label>
            <br>
            <!-- <input type="text" class="form-control" -->
            <input type="checkbox" checked name="sts_usuario" id="sts_usuario"
            >
        </div>

        <!-- ADMINISTRADOR -->
        <div class="form-group mt-2">
            <label for="">Administrador:</label>
            <br>
            <!-- <input type="text" class="form-control" -->
            <input type="checkbox"  name="sts_administrador" id="sts_administrador" 
            >
        </div>
        
      </div>
    </div>
    
    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
            <div class="col-md-2 offset-md-5">
                <div class="form-group mt-0">
                    <a href="usuarios" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-success float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
  </form>
   <!-- FIN DE FORMULARIO USUARIOS -->
</div>

<script src="views/assets/custom/datatable/usuarios.js"></script>
<script src="cliente/ajax/data-puntoemisionRellenar.php"></script>