<?php

if(isset($routesArray1[5])){
    // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
    $security = explode("~",base64_decode($routesArray1[5]));
    

    if($security[1] == $_SESSION["admin"]->token_usuario){

        $url = "ecmp_marca?linkTo=cod_marca&equalTo=".$security[0];
        $method = "GET";
        $fields = array();
    
        $response = CurlController::request($url,$method,$fields);
        //Cntrl+shift+Q
        //echo '<pre>'; print_r($response); echo '</pre>';
        

    if($response->status == 200){
        $admin = $response->result[0];
        //echo '<pre>'; print_r($admin); echo '</pre>';
    }else{
        echo '<script>
    
        window.location = "marcas";
        </script>';
    }

    }else{
        echo '<script>
    
        window.location = "marcas";
        </script>';
    }


    
    
}


?>
<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO TIPO DE PRECIO -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_marca?>" name="idAdmin">

        <div class="card-header">
                 <?php 
                    require_once("controllers/marca.controllers.php");
                    $create = new MarcaController();
                    $create ->edit($admin->cod_marca);
                    ?>
            <div class="col-md-8 offset-md-2">

                <!-- CODIGO DE MARCA -->
                <div class="form-group mt-2">
                    <label>Código de Marca</label>
                    <input 
                    type="text"
                    name="cod_marca" 
                    class="form-control"
                    value="<?php echo $admin->cod_marca?>" 
                    pattern="[0-9]{1,3}"
                    disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>


                <!-- NOMBRE DE MARCA -->
                <div class="form-group mt-2">
                    <label for="">Nombre de Marca</label>
                    <input 
                    type="text"
                    name="nom_marca" 
                    class="form-control"
                    value="<?php echo $admin->nom_marca?>" 
                    onchange="validateJS(event,'nom_marca')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,70}" 
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>
                </div>
            </div>
        </div>

        <!-- BOTONES DE REGRESAR Y GUARDAR -->
        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="marcas" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>