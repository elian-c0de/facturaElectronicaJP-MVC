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
            <thead class="table-success table-striped">
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
                    <td>
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-secondary">
                          <a class="btn btn-secondary btn-lg active btn-sm" href="<?php echo RUTA_URL; ?>/Establecimientos/editar/<?php echo $establecimientos->cod_establecimiento;?>"><i class="bi bi-pencil-square"></i></a>
                        </label>
                        <label class="btn btn-secondary">
                          <a class="btn btn-secondary btn-lg active btn-sm" href="<?php echo RUTA_URL; ?>/Establecimientos/borrar/<?php echo $establecimientos->cod_establecimiento;?>"><i class="bi bi-trash"></i></a>
                        </label>
                      </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
      </div>
    </div>
  </div>


<?php require RUTA_APP . '/views/inc/footer.php'?>