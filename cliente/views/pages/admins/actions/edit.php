<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));
    echo '<pre>'; print_r(    $security); echo '</pre>';
    echo '<pre>'; print_r(    $_SESSION["admin"]->token_usuario); echo '</pre>';
    return;
    if($security[1] == $_SESSION["admin"]->token_usuario){
        $url = "srja_caja?linkTo=cod_empresa,cod_caja&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0];
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
    if($response->status == 200){
        $admin = $response->result[0];
        // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "admins";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "admins";
        </script>';
    }
}


?>



<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO CAJAS -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $admin->cod_caja?>" name='idAdmin'>
        
        <div class="card-header">
                 <?php 
                    require_once "controllers/admins.controllers.php";
                    $create = new AdminsController();
                    $create ->edit($admin->cod_caja);
                    ?>
         

            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE EMPRESA -->
                <div class="form-group mt-2">
                    <label for="">Codigo Empresa</label>
                    <input 
                    type="text" 
                    value="<?php echo $admin->cod_empresa?>"
                    class="form-control"
                    disabled
                    name="cod_empresa"
                    pattern="[0,1,2,3,4,5,6,7,8,9]{1,3}"
                    onchange="validateJS(event,'number')"
                    value=""
                    required
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>
                <!-- CODIGO DE CAJA -->
                <div class="form-group mt-2">
                    <label
                    >Codigo Caja</label>
                    <input 
                    type="text"
                    value="<?php echo $admin->cod_caja?>"
                    name="cod_caja" 
                    class="form-control"
                    onchange= "validateRepeat(event,'number','srja_caja','cod_caja', <?php echo $_SESSION['admin']->cod_empresa?>)"
                    pattern="[0,1,2,3,4,5,6,7,8,9]{1,3}"
                    required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>
                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripcion</label>
                    <input 
                    type="text" 
                    value="<?php echo $admin->txt_descripcion?>"
                    class="form-control"
                    name="txt_descripcion"
                    required
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>
                <!-- CODIGO DE USUARIO -->
                <div class="form-group mt-2">
                    <label for="">Codigo Usuario</label>
                    <input type="text" 
                    class="form-control"
                    value="<?php echo $admin->cod_usuario?>"
                    required
                    name="cod_usuario"
                    pattern="[a-zA-Z,0,1,2,3,4,5,6,7,9_]{1,20}"
                    onchange="validateJS(event,'CodUsuarioValidate')"
                  
                    >
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>
                <!-- FECHA DE HOY -->
                <div class="form-group mt-2">
                    <label for="">Fecha Actual</label>
                    <input type="text" class="form-control"
                    value="<?php echo date("Y-m-d"); ?>"
                    disabled
                    name="fec_actualiza"
                    >
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="admins" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>