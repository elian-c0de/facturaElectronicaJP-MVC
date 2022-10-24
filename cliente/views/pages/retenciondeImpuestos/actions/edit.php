<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));
    

    if($security[2] == $_SESSION["admin"]->token_usuario){

        $url = "ecmp_impuesto?linkTo=cod_impuesto,cod_retencion&equalTo=".$security[0].",".trim($security[1]);
        //echo '<pre>'; print_r($url ); echo '</pre>';
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
    
        window.location = "retenciondeImpuestos";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "retenciondeImpuestos";
        </script>';
    }


    
    
}


?>


<div class="card card-dark card-outline">

<!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_impuesto?>" name="idAdmin">
    <input type="hidden" value="<?php echo $admin->cod_retencion?>" name="idAdmin1">
        <div class="card-header">
            <?php 
                require_once("controllers/retenciondeImpuestos.controllers.php");
                $create = new RetenciondeImpuestosController();
                $create ->edit($admin->cod_impuesto,$admin->cod_retencion);
                ?>
            <div class="col-md-8 offset-md-2">

                 <!-- VALIDAR CODIGO IMPUESTO -->
                 <div class="form-group mt-2">
                    <label>Impuesto</label>
                    <?php 
                    $tipocodigoImpuesto = file_get_contents("views/assets/json/tipo_codigoImpuesto.json");
                    $tipocodigoImpuesto = json_decode($tipocodigoImpuesto, true);
                    ?>
                    <select disabled class="form-control changeCountry" name="cod_impuesto" required>
                        <option value>Seleccione el Impuesto</option>
                        <?php foreach ($tipocodigoImpuesto as $key => $value): ?>
                            <option value="<?php echo $value["code"] ?>"<?php echo $admin->cod_impuesto == $value["code"] ? 'selected':''?>> <?php echo $value["name"] ?></option>	
                        <?php endforeach ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!-- CODIGO RETENCIÓN -->
                <div class="form-group mt-2">
                    <label>Código Retención</label>
                    <input 
                    type="text"
                    name="cod_retencion" 
                    value="<?php echo $admin->cod_retencion?>" 
                    class="form-control"
                    onchange="validateRepeat1(event,'cod_rete','ecmp_impuesto','cod_retencion')"
                    pattern="[a-zA-Z1-9]{1,5}"
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
                    onchange="validateJS(event,'descrip_formapag')"
                    pattern="[-%0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                 <!-- PORCENTAJE RETENCIÓN -->
                 <div class="form-group mt-2">
                    <label for="">Porcentaje Retención</label>
                    <input 
                    type="text"
                    name="por_retencion" 
                    value="<?php echo $admin->por_retencion?>" 
                    class="form-control"
                    onchange="validateJS(event,'por_reten')"
                    pattern="[0-9]{1,5}([.][0-9]{1,2})" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- ESTADO DE FORMA DE PAGO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox"  <?php echo $admin->sts_impuesto == 'A' ? 'checked':''?> name="sts_impuesto" checked data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="retenciondeImpuestos" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIN DE FORMULARIO RETENCION DE IMPUESTOS -->
</div>