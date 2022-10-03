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
//     //header("location: index.php");
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
    <title>Perfiles | FEJP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<?php include('../inc/header.php'); ?>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1><i class="bi bi-people-fill"></i> Perfiles</h1>
          <form id="perfiles-form">
            <input type="hidden" id="perfilId">
              <input type="text" class="form-control mb-3" id="codigo" placeholder="Codigo" required>
              <input type="text" class="form-control mb-3" id="nombre" placeholder="Nombre">
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
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Editar/Eliminar</th>
               </tr>
          </thead>
          <tbody id="perfiles"></tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="controllers/perfiles.js" ></script>
</body>
</html>