<?php
// session_start();
// if (!isset($_SESSION['user'])) {
//     echo '
//             <script>
//                 alert("Por favor debes iniciar sesión");
//                 window.location = "../logearse/";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Bienvenidos</title>
</head>
<?php include('../inc/header.php'); ?>
<body>
    <div class="mx-auto" style="padding-left: 290px;">
        <div class="row" >
            <div class="col-md-8">
                <h1>Informacion General</h1>
                    <form id="empresa-form">
                    <input type="hidden" id="empresaId">
                        <div class="row">
                            <div class="col-md-3">
                                <p>RUC:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control mb-3" id="ruc" placeholder="R.U.C" required>
                            </div>
                            <div class="col-md-3">
                                <p>Razon Social:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="razonsocial" placeholder="Razon Social" required>
                            </div>
                            <div class="col-md-3">
                                <p>Nombre abreviado:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="nombreabreviado" placeholder="Nombre abreviado" required>
                            </div>
                            <div class="col-md-3">
                                <p>Direccion:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="direccion" placeholder="Direccion" required>
                            </div>
                            <div class="col-md-3">
                                <p>Telefono:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="telefono" placeholder="Telefono" required>
                            </div>
                            <div class="col-md-3">
                                <p>Direccion E-Mail:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control mb-3" id="email" placeholder="Direccion E-Mail" required>
                            </div>
                            <div class="col-md-4">
                                <p>Obligado Contabilidad:</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-3" id="obligadocontabilidad" placeholder="Obligado Contabilidad" required>
                            </div>
                            <div class="col-md-4">
                                <p># Res. Agente de Retencion:</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-3" id="agenteretencion" placeholder="# Res. Agente de Retencion" required>
                            </div>
                            <div class="col-md-4">
                                <p>Regimen Microempresa:</p>
                            </div>
                            <div class="col-md-8">
                                <label><input class="form-check-input " type="checkbox" id="regimenmicroempresa" name="regimenmicroempresa"> 
                            </div>
                            <div class="col-md-4">
                                <p>Ubicacion Logo:</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-3" id="logo" placeholder="Ubicacion Logo" required>
                            </div>
                            <hr style="color:rgb(88, 24, 69);">
                            <div class="col-md-4">
                                <p>Id. Representante:</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-3" id="idrepresentante" placeholder="Id. Representante" required>
                            </div>
                            <div class="col-md-4">
                                <p>Nombre Representante:</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-3" id="nombrerepresentante" placeholder="Nombre Representante" required>
                            </div>
                        </div>
                        <button id="btn_insert" type="submit" name="insert" class="btn btn-primary" value="Guardar">Guardar</button>
                        <!-- <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/';" name="cancel" class="btn btn-danger" value="Cancelar"> -->
                    </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="controllers/informacion.js" ></script>
</body>

</html>