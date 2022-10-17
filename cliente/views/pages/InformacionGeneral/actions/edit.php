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
        <input type="hidden" value="<?php echo $admin->num_id ?>" name="idAdmin">


        <div class="card-header">
            <?php
            require_once("controllers/clientes.controllers.php");
            $create = new ClientesController();
            $create->edit($admin->cod_empresa);
            ?>
            <div class="col-md-8 offset-md-2">


                <div class="form-group mt-2">
                    <label>RUC</label>
                    <input type="text" name="num_id" value="<?php echo $admin->num_ruc ?>"  class="form-control">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- NUMERO DE IDENTIFICACION -->
                <div class="form-group mt-2">
                    <label>Razon Social</label>
                    <input type="text" name="num_id" value="<?php echo $admin->nom_empresa ?>"  class="form-control">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- Razon Social -->
                <div class="form-group mt-2">
                    <label for="">Nombre Abreviado</label>
                    <input type="text" class="form-control" value="<?php echo $admin->nom_abreviado ?>"  name="nom_apellido_rsocial" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- CODIGO DE USUARIO -->
                <div class="form-group mt-2">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control" value="<?php echo $admin->txt_direccion ?>"  required name="nom_persona_nombre" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}">
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- DIRECCION -->
                <div class="form-group mt-2">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" value="<?php echo $admin->num_telefono ?>"  pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}' name="txt_direccion" required value="<?php echo $admin->txt_direccion ?>">
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Direccion Email</label>
                    <input type="text" class="form-control" name="num_telefono" value="<?php echo $admin->txt_email ?>"  pattern="[-\\(\\)\\0-9 ]{1,15}" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Obligado a llevar contabilidad</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" name="sts_cliente" <?php echo $admin->sts_obligado_contabilidad == "S" ? 'checked' : '' ?>  data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">

                </div>

                <div class="form-group mt-2">
                    <label for="">#Res. Agente de retencion</label>
                    <input type="text" class="form-control" name="num_telefono" value="<?php echo $admin->num_res_agente_ret ?>"  pattern="[-\\(\\)\\0-9 ]{1,15}" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Regimen Micro Empresa</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" name="sts_cliente" <?php echo $admin->sts_contribuyente_rme == "S" ? 'checked' : '' ?>  data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75">

                </div>


                <div class="form-group mt-2">
                    <label for="">Ubicacion Logo</label>
                    <input type="text" class="form-control"  value="<?php echo $admin->txt_path_logo ?>">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Id. Representante</label>
                    <input type="text" class="form-control"  value="<?php echo $admin->cod_tipo_id_representante ?>">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>





            </div>

            <!-- BOTONES DE REGRESAR Y GUARDAR -->
            <div class="card-header">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group mt-3">
                        <a href="informacionGeneral" class="btn btn-light border text-left">Back</a>
                        <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                    </div>
                </div>
            </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>