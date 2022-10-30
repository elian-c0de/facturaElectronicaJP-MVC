<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "srja_concepto?linkTo=cod_empresa,cod_concepto&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
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
    
        window.location = "conceptos";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "conceptos";
        </script>';
    }


    
    
}


?>



<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_concepto?>" name="idAdmin"> 
        <div class="card-header">
            <?php 
                require_once("controllers/conceptos.controllers.php");
                $create = new ConceptosController();
                $create ->edit($admin->cod_concepto);
                ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE CONCEPTO -->
                <div class="form-group mt-2">
                    <label>Código de Concepto</label>
                    <input 
                    type="text"
                    name="cod_concepto" 
                    value="<?php echo $admin->cod_concepto?>" 
                    class="form-control"
                    onchange="validateRepeat(event,'cod_concepto','srja_concepto','cod_concepto', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[0-9]{1,2}"
                    disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input 
                    type="text"
                    name="txt_descripcion" 
                    value="<?php echo $admin->txt_descripcion?>"
                    class="form-control"
                    onchange="validateJS(event,'txt_descripcionConcepto')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,125}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- FACTURACIÓN -->              
                <div class="form-group mt-2">
                    <label for="">Facturación</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  <?php echo $admin->sts_facturacion == 'S' ? 'checked':''?> name="sts_facturacion" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- VALIDAR TIPO DE CONCEPTO -->
                <div class="form-group mt-2">
                    <label>Tipo de Concepto</label>
                    <?php 
                    $tipo_concep = file_get_contents("views/assets/json/tipo_concepto.json");
                    $tipo_concep = json_decode($tipo_concep, true);
                    ?>
                    <select class="form-control changeCountry" name="sts_tipo_concepto" required>
                        <option value>Seleccione Tipo de Concepto</option>
                        <?php foreach ($tipo_concep as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>" <?php echo $admin->sts_tipo_concepto == $value["code"] ? 'selected':''?>> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!-- VALIDAR TIPO DE PROCESO -->
                <div class="form-group mt-2">
                    <label>Tipo de Proceso</label>
                    <?php 
                    $tipo_proces = file_get_contents("views/assets/json/tipo_proceso.json");
                    $tipo_proces = json_decode($tipo_proces, true);
                    ?>
                    <select class="form-control select2 changeCountry" name="sts_proceso" required>
                        <option value>Seleccione Tipo de Concepto</option>
                        <?php foreach ($tipo_proces as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"<?php echo $admin->sts_proceso == $value["code"] ? 'selected':''?>> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!-- AFECTA INVENTARIO -->
                <div class="form-group mt-2">
                    <label for="">Afecta Inventario</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" <?php echo $admin->sts_inventario == 'A' ? 'checked':''?> name="sts_inventario" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- ESTADO DEL CONCEPTO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  <?php echo $admin->sts_concepto == 'A' ? 'checked':''?> name="sts_concepto" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="conceptos" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO CONCEPTOS -->
</div>