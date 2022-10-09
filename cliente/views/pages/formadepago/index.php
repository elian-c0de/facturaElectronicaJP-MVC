<?php
  include("../../config/config.php");
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
    <title>Formas de Pago | FEJP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<?php include('../inc/header.php'); ?>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1><i class="bi bi-credit-card-2-front-fill"></i> Formas de Pago</h1>
          <form id="formadepagos-form">
              <input type="hidden" id="formadepagoId">
              <input type="text" class="form-control mb-3" id="codigo" placeholder="Codigo Forma de Pago" required>
              <input type="text" class="form-control mb-3" id="descripcion" placeholder="Descripcion">
              <input type="text" class="form-control mb-3" id="sri" placeholder="S.R.I">
              <input class="form-check-input" type="checkbox" id="defecto" name="defecto"> Defecto
              <br></br>
              <input class="form-check-input" type="checkbox" id="estado" name="estado"> Estado
              <br></br>
              <input class="form-check-input" type="checkbox" id="retencion" name="retencion"> Retencion
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
                  <th>Defecto</th>
                  <th>S.R.I</th>
                  <th>Estado</th>
                  <th>Retencion</th>
                  <th>Editar/Eliminar</th>
               </tr>
          </thead>
          <tbody id="formadepagos"></tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="controllers/formadepagos.js" ></script>
</body>
</html>