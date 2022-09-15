<?php require RUTA_APP . '/views/inc/header.php'?>

        
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1>Establecimientos</h1>
            
            <!-- formulario de agregar -->
            <form action="<?php echo RUTA_URL?>/Establecimientos/agregar" method="POST">
            <input type="number" class="form-control mb-3" name="cod_establecimiento" placeholder="Establecimiento" required>
              <input type="text" class="form-control mb-3" name="txt_descripcion" placeholder="Descripcion" required>
              <input type="text" class="form-control mb-3" name="txt_direccion" placeholder="Direccion" required>
              <label><input class="form-check-input" type="checkbox" name="sts_matriz" value="A" id="flexCheckDefault"> Matriz
              <br></br>
              <label><input class="form-check-input" type="checkbox" name="sts_local" value="A" id="flexCheckDefault"> Estado
              <br></br>
                              
              
              <input  type="submit" class="btn btn-primary" value="Agregar Establecimiento">
              <a href="<?php echo RUTA_URL;?>/paginas" class="btn btn btn-danger" <i class="fa fa-backward"></i>Volver</a>
            </form> 
          
      </div>
      <div class="col-md-8">
      <table class="table">
            <thead>
                <tr>
                <th>Establecimiento</th>
                <th>Descripcion</th>
                <th>Direccion</th>
                <th>Matriz</th>
                <th>Estado</th>
                <th>Editar/Eliminar</th>
            
                </tr>
            </thead>

            <tbody>
            <?php foreach($datos['establecimientos'] as $establecimientos) : ?>
                <tr>
                    <td><?php echo $establecimientos->cod_establecimiento;?></td>
                    <td><?php echo $establecimientos->txt_descripcion;?></td>
                    <td><?php echo $establecimientos->txt_direccion;?></td>
                    <td><?php echo $establecimientos->sts_matriz;?></td>
                    <td><?php echo $establecimientos->sts_local;?></td>
            
                
                    <td><a href="<?php echo RUTA_URL; ?>/Establecimientos/borrar/<?php echo $establecimientos->cod_linea;?>">Editar</a></td>
                    <td><a href="<?php echo RUTA_URL; ?>/Establecimientos/borrar/<?php echo $establecimientos->cod_linea;?>">Borrar</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
      </div>
    </div>
  </div>


<?php require RUTA_APP . '/views/inc/footer.php'?>