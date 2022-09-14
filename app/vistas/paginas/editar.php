<?php require RUTA_APP . '/vistas/inc/header.php'?>
<a href="<?php echo RUTA_URL;?>/paginas" class="btn btn-light" <i class="fa fa-backward"></i>> Volver</a>

<div class="container text-center">
    <h2>Agregar empresa</h2>
    <form action="<?php echo RUTA_URL?>/paginas/editar/<?php echo $datos['cod_empresa']?>" method="POST">


    <div class="form-group">
        <label for="nombre">cod_empresa <sup>*</sup></label>
        <input type="numeric" name="cod_empresa" class="form-control from-control-lg" value="<?php echo $datos['cod_empresa'];?>">
    </div>
    <div class="form-group">
        <label for="nombre">Nombre <sup>*</sup></label>
        <input type="text" name="nom_empresa" class="form-control from-control-lg" value="<?php echo $datos['nom_empresa'];?>">
    </div>
    <div class="form-group">
        <label for="nombre">abreviado <sup>*</sup></label>
        <input type="text" name="nom_abreviado" class="form-control from-control-lg" value="<?php echo $datos['nom_abreviado'];?>">
    </div>
   
    <input type="submit" class="btn btn-success" value="Editar Empresa">
    </form>
 
</div>
<?php require RUTA_APP . '/vistas/inc/footer.php'?>