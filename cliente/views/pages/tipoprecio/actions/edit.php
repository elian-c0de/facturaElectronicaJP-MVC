<?php

    if(isset($routesArray1[5])){
        // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
        $security = explode("~",base64_decode($routesArray1[5]));
        
        if($security[1] == $_SESSION["admin"]->token_usuario){

            $url = "ecmp_precio?linkTo=cod_empresa,cod_precio&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
            $method = "GET";
            $fields = array();
        
            $response = CurlController::request($url,$method,$fields);
            
        if($response->status == 200){
            $admin = $response->result[0];
            // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
        }else{
            echo '<script>
        
            window.location = "tipoprecio";
            </script>';
        }

        }else{
            echo '<script>
        
            window.location = "tipoprecio";
            </script>';
        }
    
}
?>
<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_precio?>" name="idAdmin"> 

        <div class="card-header">
                 <?php 
                    require_once("controllers/tipoprecio.controllers.php");
                    $create = new TipoprecioController();
                    $create ->edit($admin->cod_precio);
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE PRECIO -->
                <div class="form-group mt-2">
                    <label>Código de Precio</label>
                    <input value="<?php echo $admin->cod_precio ?>"
                    type="text"
                    name="cod_precio" 
                    class="form-control"
                    disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input value="<?php echo $admin->txt_descripcion ?>"
                    type="text"
                    name="txt_descripcion" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descripcion')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,60}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>

                <!-- DEFECTO -->              
                <div class="form-group mt-2">
                    <label for="">Defecto</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input type="checkbox" <?php echo $admin->sts_defecto == 'A' ? 'checked':''?> name="sts_defecto" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>

                <!-- PRECIO -->
                <div class="form-group mt-2">
                    <label for="">Estado</label>
                    <br>
                    <!-- <input type="text" class="form-control" -->
                    <input  type="checkbox" <?php echo $admin->sts_precio == 'A' ? 'checked':''?> name="sts_precio" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-handle-width="75"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="tipoprecio" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>