<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "ecmp_cliente?linkTo=cod_empresa,num_id&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        // echo '<pre>'; print_r($response); echo '</pre>';

    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "clientes";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "clientes";
        </script>';
    }


    
    
}


?>



<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->num_id?>" name="idAdmin"> 


        <div class="card-header">
                 <?php 
                    require_once("controllers/clientes.controllers.php");
                    $create = new ClientesController();
                    $create ->edit($admin->num_id);
                    ?>
            <div class="col-md-8 offset-md-2">

            <!-- VALIDAR TIPO DE IDENTIFICACION -->
                <div class="form-group mt-2">
					<label>Tipo de identificacion</label>
					<?php 
					$tipo_iden = file_get_contents("views/assets/json/tipo_iden.json");
					$tipo_iden = json_decode($tipo_iden, true);
					?>
					<select class="form-control select2 changeCountry" name="cod_tipo_id" disabled equired>
						<option value>Seleccione Tipo de identificacion</option>
						<?php foreach ($tipo_iden as $key => $value): ?>
							<option value="<?php echo $value["code"] ?>" <?php echo $admin->cod_tipo_id == $value["code"] ? 'selected':''?>   > <?php echo $value["name"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
				</div>  


                <!-- NUMERO DE IDENTIFICACION -->
                <div class="form-group mt-2">
                    <label>No. de Identificacion</label>
                    <input 
                    type="text"
                    name="num_id" 
                    value="<?php echo $admin->num_id?>"
                    disabled
                    class="form-control">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- Razon Social -->
                <div class="form-group mt-2">
                    <label for="">Apellido/Razon Social</label>
                    <input 
                    type="text" 
                    class="form-control"
                    value="<?php echo $admin->nom_apellido_rsocial?>"
                    name="nom_apellido_rsocial"
                    onchange="validateJS(event,'nom_apellido_rsocial')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}" 
                    required
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- CODIGO DE USUARIO -->
                <div class="form-group mt-2">
                    <label for="">Nombres</label>
                    <input type="text" 
                    class="form-control"
                    value="<?php echo $admin->nom_persona_nombre?>"
                    required
                    onchange="validateJS(event,'nom_persona_nombre')"
                    name="nom_persona_nombre"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}" 
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- DIRECCION -->
                <div class="form-group mt-2">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control"
                    onchange="validateJS(event,'txt_direccion_cliente')"
                    pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}' 
                    name="txt_direccion"
                    required
                    value="<?php echo $admin->txt_direccion?>"
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control"
                    name="num_telefono"
                    value="<?php echo $admin->num_telefono?>"
                    onchange="validateJS(event,'num_telefono_cliente')"
                    pattern="[-\\(\\)\\0-9 ]{1,15}"
                    required
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Correo Electronico</label>
                    <input type="text" class="form-control"
                    onchange="validateJS(event,'txt_email')"
                    pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                    name="txt_email"
                    value="<?php echo $admin->txt_email?>"
                    required
                    >
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
					<label>Precio Aplicado</label>
					<?php 
                    // require_once("controllers/admins.controllers.php");
                    $create = new ClientesController();
                    $tipo_precio = $create -> tipoprecio();
                    $tipo_precio = json_encode($tipo_precio);
                    $tipo_precio = json_decode($tipo_precio,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_precio" required>
						<option value>Seleccione Precio Aplicado</option>
						<?php foreach ($tipo_precio as $key => $value): ?>
							<option value="<?php echo $value["cod_precio"] ?>"   <?php echo $admin->cod_precio == $value["cod_precio"] ? 'selected':''?>         > <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
				</div>  


                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" <?php echo $admin->sts_cliente == 'A' ? 'checked':''?> name="sts_cliente" data-on-text="SI" data-off-text="NO" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>


                <div class="form-group mt-2">
                    <label for="">Proveedor</label>
                    <br>
           
                    <input type="checkbox"  name="sts_proveedor" <?php echo $admin->sts_proveedor == 'A' ? 'checked':''?>  data-on-text="SI" data-off-text="NO" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="clientes" class="btn btn-light border text-left">Atras</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>