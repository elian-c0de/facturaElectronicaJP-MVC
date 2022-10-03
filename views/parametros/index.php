<?php
// include("../../config/config.php");
// session_start();
// if (!isset($_SESSION['user'])) {
//     echo '
//             <script>
//                 alert("Por favor debes iniciar sesión");
//                 window.location = "../logearse/index.php";
//             </script>
//         ';
//     // header("location: ../inc/header.php");
//     session_destroy();
//     die();
// } 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametros | FEJP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<?php include('../inc/header.php'); ?>
<body>
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1><i class="bi bi-card-checklist"></i> Parametros</h1>
          <form id="parametros-form">
              <input type="hidden" id="parametrosId">
              <input type="text" class="form-control mb-3" id="parametro" placeholder="Codigo" required>
              <input type="text" class="form-control mb-3" id="nombre" placeholder="Nombre">
              <input type="text" class="form-control mb-3" id="valor" placeholder="Valor">              
              
              <button id="btn_insert" type="submit" name="insert" class="btn btn-primary" value="Guardar">Guardar</button>
              <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/';" name="cancel" class="btn btn-danger" value="Cancelar">
          </form>
      </div>
      <div class="col-md-8" style="overflow:scroll">
        <table class="table table-striped table-hover">
            <thead class="bg-warning">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Editar/Eliminar</th>
                </tr>
            </thead>
            <tbody id="parametros"></tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="controllers/parametros.js" ></script>
</body>
</html>