<?php require RUTA_APP . '/vistas/inc/header.php'?>

        
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1>Establecimientos</h1>
            
            <!-- formulario de agregar -->
            <h1>Establecimientos</h1>
            <form action="<?php echo RUTA_URL?>/linea/agregar" method="POST">
              <input type="number" class="form-control mb-3" name="cod_empresa" placeholder="Establecimiento">
              <input type="text" class="form-control mb-3" name="cod_linea" placeholder="linea">
              <input type="text" class="form-control mb-3" name="cod_sublinea" placeholder="sublinea">
              <input type="text" class="form-control mb-3" name="txt_descripcion" placeholder="descripcion">
              <!-- <input type="text" class="form-control mb-3" name="cod_usuario" placeholder="usuario"> -->
              <!-- <input type="date" class="form-control mb-3" name="fec_actualiza" placeholder="fecha" > -->
              <!-- <label><input class="form-check-input" type="checkbox" name="matriz" value="A" id="flexCheckDefault"> Matriz
              <br></br>
              <label><input class="form-check-input" type="checkbox" name="local" value="A" id="flexCheckDefault"> Estado
              <br></br> -->
                
              
              <input  type="submit" class="btn btn-primary" value="Agregar Linea">
              <!-- <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/bienvenidos.php';" name="cancel" class="btn btn-danger" value="Cancelar"> -->
             
            </form> 
          
      </div>
      <div class="col-md-8">
      <table class="table">
            <thead>
                <tr>
                <th>codigo empresa</th>
                <th>codigho linea</th>
                <th>codigo sublinea</th>
                <th>txt_descripcion</th>
                <th>fec_actializa</th>
            
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
            
                
                    <td><a href="<?php echo RUTA_URL; ?>/lineaproducto/editar/<?php echo $linea->cod_empresa;?>">Editar</a></td>
                    <td><a href="<?php echo RUTA_URL; ?>/lineaproducto/borrar/<?php echo $linea->cod_empresa;?>">Borrar</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
      </div>
    </div>
  </div>


<?php require RUTA_APP . '/vistas/inc/footer.php'?>