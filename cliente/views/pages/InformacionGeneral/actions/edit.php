<?php

$url = "gen_empresa?equalTo=" . $_SESSION["admin"]->cod_empresa . "&linkTo=cod_empresa";
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

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $admin->cod_empresa ?>" name="idAdmin"> 


        <div class="card-header">

            <?php
            require_once("controllers/informaciongeneral.controller.php");
            $create = new InformacionGeneralController();
            $create->edit($admin->cod_empresa);
            ?>

            <div class="col-md-8 offset-md-2">

                <!-- INDEITIFICACON CON VALIDACIONES TERMINADO -->
                <div class="form-group mt-2">
                    <label>RUC</label>
                    <input type="text" name="num_ruc" value="<?php echo $admin->num_ruc ?>"  class="form-control"
                    onchange="validateJS(event,'num_ruc')"
                    pattern = "[0-9]{1,13}"
                    required
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo.</div>
                </div>


                <!-- TEXT RAZON SOCIAL CON VALIDACION TERMINADO -->
                <div class="form-group mt-2">
                    <label>Razon Social</label>
                    <input type="text" name="nom_empresa" value="<?php echo $admin->nom_empresa ?>"  class="form-control"
                    onchange="validateJS(event,'nom_empresa')"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}"
                    required
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo.</div>
                </div>


                <!-- NOMBRE ABREVIADO CON VALIDACION TERMINADO -->
                <div class="form-group mt-2">
                    <label for="">Nombre Abreviado</label>
                    <input type="text" class="form-control" value="<?php echo $admin->nom_abreviado ?>"  name="nom_abreviado" 
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,15}"
                    onchange="validateJS(event,'nom_abreviado')"
                    required
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- TXT DIRECCION CON VALIDACION TERMINADO -->
                <div class="form-group mt-2">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control" value="<?php echo $admin->txt_direccion ?>" 
                     name="txt_direccion" 
                     pattern= '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}'
                     onchange="validateJS(event,'txt_direccion')"
                     required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- NUMERO DE TELEFONO CON VALIDACION TERMINADO -->
                <div class="form-group mt-2">
                    <label for="">Telefono</label>
                    <input type="phone" class="form-control" value="<?php echo $admin->num_telefono ?>"  
                    pattern='[-\\(\\)\\0-9 ]{1,10}' 
                    onchange="validateJS(event,'num_telefono')"
                    name="num_telefono" 
                    required
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- EMAIL CON VALIDACION TERMINADO -->
                <div class="form-group mt-2">
                    <label for="">Direccion Email</label>
                    <input type="text" class="form-control" name="txt_email" value="<?php echo str_replace(" ","",$admin->txt_email) ?>"  
                    pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                    onchange="validateJS(event,'txt_email')" 
                    required>
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>


                <div class="form-group mt-2">
                    <label for="">Obligado a llevar contabilidad</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" name="sts_obligado_contabilidad" data-on-text="SI" data-off-text="NO" <?php echo $admin->sts_obligado_contabilidad == "S" ? 'checked' : '' ?>  data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">

                </div>
                
                <!-- NUM AGENTE DE RETENCION -->
                <div class="form-group mt-2">
                    <label for="">#Res. Agente de retencion</label>
                    <input type="text" class="form-control" 
                    name="num_res_agente_ret" value="<?php echo str_replace(" ","",$admin->num_res_agente_ret) ?>"  
                    onchange="validateJS(event,'num_res-agente_ret')" 
                    pattern="[0-9]{1,30}" 
                    >
                    <div class="valid-feedback">Válido</div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Regimen Micro Empresa</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" name="sts_contribuyente_rme" data-on-text="SI" data-off-text="NO" <?php echo $admin->sts_contribuyente_rme == "S" ? 'checked' : '' ?>  data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">

                </div>

    <!-- UBICACION LOGO CON VALIDACION TERMINADO-->
                <div class="form-group mt-2">
                    <label for="">Ubicacion Logo</label>
                    <input type="text" class="form-control"  
                    value="<?php echo $admin->txt_path_logo ?>"
                    name="txt_path_logo"
                    >
                    
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <!-- ID REPRESENTANTE CON VALIDACION TERMINADO (OJO SE PUEO INGRESAR DE A-Z e a la espera de confirmacion) -->
                <div class="form-group mt-2">
                    <label for="">Id. Representante</label>
                    <input type="text" class="form-control"  
                    value="<?php echo $admin->num_id_representante ?>"
                    name="cod_tipo_id_representante"
                    onchange="validateJS(event,'cod_tipo_id_representante')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,13}" 
                    required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Nombre Representante</label>
                    <input type="text" class="form-control"  
                    value="<?php echo str_replace(" ","",$admin->nom_representante)?>"
                    name="nom_representante"
                    onchange="validateJS(event,'nom_empresa')" 
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]{1,100}"
                    required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Por favor, rellene este campo</div>
                </div>
            </div>

            <!-- BOTONES DE REGRESAR Y GUARDAR -->
            <div class="card-header">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group mt-3">
                        <a href="informacionGeneral" class="btn btn-light border text-left">Cancelar</a>
                        <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                    </div>
                </div>
            </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>