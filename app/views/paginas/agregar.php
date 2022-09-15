<?php require RUTA_APP . '/views/inc/header.php'?>
<a href="<?php echo RUTA_URL;?>/paginas" class="btn btn-light" <i class="fa fa-backward"></i>> Volver</a>

<div class="container text-center">
    <h2>Agregar empresa</h2>
    <form action="<?php echo RUTA_URL?>/paginas/agregar" method="POST">


    <div class="form-group">
        <label for="nombre">cod_empresa <sup>*</sup></label>
        <input type="numeric" name="cod_empresa" class="form-control from-control-lg">
    </div>
    <div class="form-group">
        <label for="nombre">Nombre <sup>*</sup></label>
        <input type="text" name="nom_empresa" class="form-control from-control-lg">
    </div>
    <div class="form-group">
        <label for="nombre">abreviado <sup>*</sup></label>
        <input type="text" name="nom_abreviado" class="form-control from-control-lg">
    </div>
   
    <input type="submit" class="btn btn-success" value="Agregar Usuario">
    </form>
 
</div>
<?php require RUTA_APP . '/views/inc/footer.php'?>