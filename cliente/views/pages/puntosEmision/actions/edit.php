<?php

    if(isset($routesArray1[5])){
        // echo '<pre>'; print_r($routesArray1[5]); echo '</pre>';
        $security = explode("~",base64_decode($routesArray1[5]));
        
        if($security[2] == $_SESSION["admin"]->token_usuario){

            $url = "gen_punto_emision?linkTo=cod_empresa,cod_establecimiento,cod_punto_emision&equalTo=".$_SESSION['admin']->cod_empresa.",".$security[0].",".$security[1];
            $method = "GET";
            $fields = array();
        
            $response = CurlController::request($url,$method,$fields);
            
        if($response->status == 200){
            $admin = $response->result[0];
            // echo '<pre>'; print_r($admin->cod_caja); echo '</pre>';
        }else{
            echo '<script>
        
            window.location = "puntosEmision";
            </script>';
        }

        }else{
            echo '<script>
        
            window.location = "puntosEmision";
            </script>';
        }
    
}


?>

<div class="card card-dark card-outline">

    <!-- INICIO DE FORMULARIO PUNTO EMISION -->
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $admin->cod_establecimiento?>" name="idAdmin">
    <input type="hidden" value="<?php echo $admin->cod_punto_emision?>" name="idAdmin2">

        <div class="card-header">
                 <?php 
                    require_once("controllers/puntoemision.controllers.php");
                    $create = new PuntoemisionController();
                    $create ->edit($admin->cod_establecimiento,$admin->cod_punto_emision);
                    ?>
            <div class="col-md-8 offset-md-2">
                <!-- CODIGO DE LINEA -->
                <div class="form-group mt-2">
					<label>Seleccione el codigo de linea</label>
					<?php 
                    require_once("controllers/puntoemision.controllers.php");
                    $create = new PuntoemisionController();
                    $lista = $create -> getListaLinea();
                    $lista = json_encode($lista);
                    $lista = json_decode($lista,true);
                    ?>

					<select class="form-control select2 changeCountry" name="cod_establecimiento" id="linea" disabled>
						<option value>Seleccione Precio Aplicado</option>
						<?php foreach ($lista as $key => $value): ?>
							<option value="<?php echo $value["cod_establecimiento"] ?>" <?php echo $key == 0 ?"selected":"" ?> ><?php echo $value["cod_establecimiento"] ?> | <?php echo $value["txt_descripcion"] ?></option>	
						<?php endforeach ?>
					</select>
					<div class="valid-feedback">Valid.</div>
            		<div class="invalid-feedback">Please fill out this field.</div>
	            </div>
                <!-- CODIGO DE SUBLINEA -->
                <div class="form-group mt-2">
                    <label>Código</label>
                    <input 
                    value="<?php echo$admin->cod_establecimiento?>" 
                    type="text"
                    name="cod_punto_emision" 
                    class="form-control"
                    disabled>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback"> Please fill out this field.</div>
                </div>

                <!-- DESCRIPCION -->
                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input
                    value="<?php echo$admin->txt_descripcion?>" 
                    type="text"
                    name="txt_descripcion" 
                    class="form-control"
                    onchange="validateJS(event,'txt_descrip')"
                    pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,255}" 
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
                    <a href="sublineaproducto" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN DE FORMULARIO CAJAS -->

</div>