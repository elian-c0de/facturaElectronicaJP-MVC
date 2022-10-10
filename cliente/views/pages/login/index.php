<!-- Iconos y Diseños Boostrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<!-- Estilos Locales -->
<link rel="stylesheet" href="css/style.css">
<div class="bg-dark">
    <div class="login_error">
        <!-- <span>Datos de Ingreso no válidos, intentalo de nuevo por favor</span>     -->
    </div>
    <section>
        <div class="row g-0">
            <div class="col-lg-7 d-none d-lg-block">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <button data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></button>
                        <button data-target="#carouselExampleCaptions" data-slide-to="1"></button>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item img-1 min-vh-100 active">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="font-weight-bold">Cero Tramites lo Hacemos por Ti</h5>
                            </div>
                        </div>
                        <div class="carousel-item img-2 min-vh-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="font-weight-bold">Firma Electronica</h5>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


            </div>

            <div class="col-lg-5 d-flex flex-column align-items-end min-vh-100">
                <div class="px-lg-5 pt-lg-4 pt-lg-3 w-100 mb-auto ">
                    <!-- <img src="img/logo.png" class="img-fluid "> -->
                    <h2 class="font-weight-bold text-center mb-4"><i class="bi bi-receipt-cutoff"></i> Factura Electronica JP</h2>
                </div>
                <div class="main px-lg-5 py-lg-4 w-100 align-self-center">

                <!-- FORMULARIO PARA LOGIN -->
                    <form  method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h2 class="text-center display-1"><i class="bi bi-person-circle"></i></h2>
                            <h3 class="text-center fs-1 fw-bold">Iniciar Sesión</h3>
                            <label for="UserExample" class="form-label  fw-bold ">Usuario</label>
                            <input type="text" class="form-control bg-dark-x border-0" placeholder="Usuario" onchange="validateJS(event,'text')" pattern="[A-Za-z0-9_-]{1,15}" required name="txtusuario">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control bg-dark-x border-0" placeholder="Contraseña" pattern="[A-Za-z0-9_-]{1,15}" required name="txtcontra">
                            <div class="valid-feedback">Valid.</div>
                             <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="btn__iniciar-sesion"><i class="bi bi-door-open-fill"></i>Ingresar</button>
                  
                    </form>
                 <!-- FIN FORMULARIO PARA LOGIN -->

                    <?php

                    require_once("controllers/admins.controllers.php");
                    $login = new AdminsController();
                    $login->login();


                    ?>
                    <!-- <div class="respuesta"></div> -->
                </div>
                <div class="text-center px-lg-5 pt-lg3 pb-lg-4 p-4 w-100 mt-auto">
                </div>
            </div>
        </div>
    </section>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="controllers/login.js" ></script> -->
    <script src="views/assets/custom/forms/forms.js"></script>

</div>

