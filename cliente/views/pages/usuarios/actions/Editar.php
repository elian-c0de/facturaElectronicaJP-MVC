<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "gen_usuario?linkTo=cod_empresa,cod_usuario&equalTo=".$_SESSION['admin']->cod_empresa.",".trim($security[0]);
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        //Cntrl+shift+Q
        //echo '<pre>'; print_r($response); echo '</pre>';
        

    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "usuarios";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "usuarios";
        </script>';
    }


    
    
}


?>


<div class="card card-dark card-outline">
  <form method="post" class="needs-validation" novalidate enctype="multipart/form-data"><section class="content-header">
  <input type="hidden" value="<?php echo $admin->cod_usuario?>" name="idAdmin">   
  <div class="card-header">
      <?php
      require_once("controllers/usuarios.controller.php");
      $create = new UsuariosController();
      $create->edit($admin->cod_usuario);
      ?>
      <div class="col-md-8 offset-md-2">

      
        <!-- CÓDIGO DE USUARIO -->
        <div class="form-group mt-2">
          <label>Código: </label>
          <input 
          type="text"
          name="cod_usuario" 
          id="cod_usuario"
          value="<?php echo $admin->cod_usuario?>" 
          class="form-control"
          pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9]{1,20}$"
          disabled
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
          value="<?php echo trim($admin->nom_usuario)?>" 
          class="form-control"
          onchange="validateJS(event,'nom_empresa')"
          pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,50}$"
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
                  <option value="<?php echo $value["cod_perfil"] ?>"<?php echo $admin->cod_perfil == $value["cod_perfil"] ? 'selected':''?>> <?php echo $value["nom_perfil"] ?></option>		
                  </option>
              <?php endforeach ?>
          </select>
          <div class="valid-feedback">Válido</div>
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
                  <option value="<?php echo $value["cod_establecimiento"] ?>~<?php echo $value["cod_punto_emision"] ?>" 
                  <?php echo $admin->cod_establecimiento == $value["cod_establecimiento"] && $admin->cod_punto_emision == $value["cod_punto_emision"] ? 'selected':''?> >
                  <?php echo $value["cod_establecimiento"] ?> | <?php echo $value["cod_punto_emision"] ?> | <?php echo $value["txt_descripcion"] ?>
                  </option>
              <?php endforeach ?>
          </select>
          <div class="valid-feedback">Válido</div>
		</div> 


       

        <!-- DIVICIÓN DEL CAMPO: USUARIO -->
        <div class="form-group mt-2">
            <p class="lead">Activo</p>
        </div>

         <!-- ESTADO -->
        <div class="form-group mt-2">
            <label for="">Estado:</label>
            <br>
            <!-- <input type="text" class="form-control" -->
            <input type="checkbox"  <?php echo $admin->sts_usuario == 'A' ? 'checked':''?> name="sts_usuario" id="sts_usuario"
            >
        </div>

        <!-- ADMINISTRADOR -->
        <div class="form-group mt-2">
            <label for="">Administrador:</label>
            <br>
            <!-- <input type="text" class="form-control" -->
            <input type="checkbox"  <?php echo $admin->sts_administrador == 'A' ? 'checked':''?> name="sts_administrador" id="sts_administrador" 
            >
        </div>
        <!-- BORRAR CONTRASEÑA -->
        
        <div class="form-group mt-2">
            <label for="">Asignar Clave Temporal:</label>
            <br>
            <!-- <input type="text" class="form-control" -->
            <input type="checkbox"   name="claveTemporar" id="claveTemporar"   value="tdqow9PSQszTg"
            > Clave Temporal: admin123
        </div>
      </div>
    </div>
    
    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="usuarios" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
  </form>
   <!-- FIN DE FORMULARIO USUARIOS -->
</div>

<script src="views/assets/custom/datatable/usuarios.js"></script>