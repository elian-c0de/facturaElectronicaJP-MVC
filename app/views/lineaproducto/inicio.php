<?php require RUTA_APP . '/views/inc/header.php'?>

        
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1>Lineas de Productos</h1>
            
            <!-- formulario de agregar -->
            <form action="<?php echo RUTA_URL?>/linea/agregar" method="POST">
              <input type="number" class="form-control mb-3" name="cod_empresa" placeholder="Empresa">
              <input type="text" class="form-control mb-3" name="cod_linea" placeholder="linea">
              <input type="text" class="form-control mb-3" name="cod_sublinea" placeholder="sublinea">
              <input type="text" class="form-control mb-3" name="txt_descripcion" placeholder="descripcion">
                              
              
              <input  type="submit" class="btn btn-primary" value="Agregar Linea">
              <a href="<?php echo RUTA_URL;?>/paginas" class="btn btn btn-danger" <i class="fa fa-backward"></i>Volver</a>
              <!-- <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/bienvenidos.php';" name="cancel" class="btn btn-danger" value="Cancelar"> -->
             
            </form> 
          
      </div>
      <div class="col-md-8">
      <table class="table">
            <thead class="table-success table-striped">
                <tr>
                <th>Empresa</th>
                <th>Linea</th>
                <th>Sublinea</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Editar/Eliminar</th>
            
                </tr>
            </thead>

            <tbody>
            <?php foreach($datos['linea'] as $linea) : ?>
                <tr>
                    <td><?php echo $linea->cod_empresa;?></td>
                    <td><?php echo $linea->cod_linea;?></td>
                    <td><?php echo $linea->cod_sublinea;?></td>
                    <td><?php echo $linea->txt_descripcion;?></td>
                    <td><?php echo $linea->fec_actualiza;?></td>
                    <td>
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-secondary">
                          <a class="btn btn-secondary btn-lg active btn-sm" href="<?php echo RUTA_URL; ?>/Linea/editar/<?php echo $linea->cod_linea;?>"><i class="bi bi-pencil-square"></i></a>
                        </label>
                        <label class="btn btn-secondary">
                          <a class="btn btn-secondary btn-lg active btn-sm" href="<?php echo RUTA_URL; ?>/Linea/borrar/<?php echo $linea->cod_linea;?>/<?php echo $linea->cod_sublinea;?>"><i class="bi bi-trash"></i></a>
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