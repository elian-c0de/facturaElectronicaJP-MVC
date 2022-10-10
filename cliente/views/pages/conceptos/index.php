

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conceptos | FEJP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<body>
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1><i class="bi bi-server"></i> Conceptos</h1>
          <form id="conceptos-form">
              <input type="hidden" id="conceptosId">
              <input type="number" class="form-control mb-3" id="concepto" placeholder="Codigo Concepto" required>
              <input type="text" class="form-control mb-3" id="descripcion" placeholder="Descripcion">
              <label><input class="form-check-input mb-3" type="checkbox" id="facturacion" name="facturacion"> Facturacion
              <input type="text" class="form-control mb-3" style="width: 347px"id="tipoconcepto" placeholder="Tipo de Concepto">
              <input type="text" class="form-control mb-3" style="width: 347px"id="proceso" placeholder="Proceso">
              <label><input class="form-check-input" type="checkbox" id="afectainventario" name="afectainventario"> Afecta Inventario
              <br></br>
              <label><input class="form-check-input" type="checkbox" id="estado" name="estado"> Estado
              <br></br>
              
              <button id="btn_insert" type="submit" name="insert" class="btn btn-primary" value="Guardar">Guardar</button>
              <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/';" name="cancel" class="btn btn-danger" value="Cancelar">
          </form>
      </div>
      <div class="col-md-8">
        <table class="table table-striped table-hover">
            <thead class="bg-warning">
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Facturacion</th>
                    <th>Tipo de Concepto</th>
                    <th>Proceso</th>
                    <th>Afecta inventario</th>
                    <th>Estado</th>
                    <th>Editar/Eliminar</th>
                </tr>
            </thead>
            <tbody id="conceptos"></tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="controllers/conceptos.js" ></script>
</body>
</html> -->

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1><i class=" fa-solid fa-shop mr-1"></i>Conceptos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          
          <li class="breadcrumb-item"><a href="#">Home</a></li> 
          
          <?php 
          if (isset($routesArray1[4])) {
            if($routesArray1[4] == "create" || $routesArray1[4] == "edit"){
              echo '<li class="breadcrumb-item"><a href="conceptos">Conceptos</a></li>';
              echo '<li class="breadcrumb-item active">'.$routesArray1[4].'</li>';
            }
          }else{
            echo '<li class="breadcrumb-item active">Conceptos</li>';
          }
      ?>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <?php
    if(isset($routesArray[4]) && $routesArray[4] == "create"){
        include "actions/".$routesArray[4].".php"; 
    }else{
        include "actions/list.php"; 
    }
    ?>
    </div>
</section>