<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/estilos.css">
    <title><?php echo NOMBRESITIO; ?></title>

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px rgb(0, 0, 0, 0.1); 
            border-radius: 10px;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(69, 162, 158, 0.2); 
            border-radius: 10px;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(69, 162, 158, 0.6); 
            cursor: pointer; 
        }
        body {
            background-color: #e6e6e6;
        }
        .page .sidebar{
            background: linear-gradient(35deg, #66fcf1, #45a29e);
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }
        .page .content{
            margin-left: 250px;
            transition: all 0.3s ease;
        }
        .navigationBar {
            background-color: white;
            height: 50px;
            display: flex;
            padding: auto;
            align-items: center;
            box-shadow: 0 4px 2px -2px #c5c6c7;
        }
        .sidebarToggle {
            font-size: 16px;
            color: rgb(0, 0, 0, 0.8);
            margin-left: -20px;
            z-index: 999;
            border-radius: 50px;
            background-color: #e6e6e6;
            transition: all 0.3s ease;
            outline: none!important;
            box-shadow: none!important;
        }
        .sidebarToggle.active {
            margin-left: 10px;
        }
        .sidebarToggle:hover{
            color: white;
        }
        .page .content .container{
            margin: 30px;
            background: #fff;
            padding: 50px;
            line-height: 28px;
        }
        body.active .page .sidebar{
            left: -250px;
        }
        body.active .page .content{
            margin-left: 0;
            width: 100%;
        }
        .sidebar-header {
            padding: 10px 25px 10px 15px;
        }
        .sidebar-logo-container {
            background-color: rgb(0, 0, 0, 0.2);
            border-radius: 8px;
            padding-left: 3px;
            display: flex;
        }
        .logo-container {
            max-width: 40px;
            background-color: rgb(255, 255, 255, 0.1);
            border-radius: 5px;
            margin: 8px;
            padding: 6px 8px;
        }
        .brand-name-container {
            margin: 10px 55px 0px 2px;
            padding: 0px;
        }
        .logo-sidebar {
            width: 100%;
            height: auto;
        }
        .brand-name {
            color: white;
            margin: 0px;
            line-height: 1.1rem; 
            font-size: 16px;
            letter-spacing: 1px;
            font-family: 'Roboto', sans-serif;
        }
        .brand-subname {
            font-weight: 300;
            font-size: 14px;
        }
        .navigation-list {
            list-style-type:none;
            padding: 0px 18px;
            margin-top: 30px;
        }
        .navigation-list-item {
            padding: 12px 18px 12px 25px;
            margin: 15px 0px;
            border-radius: 8px;
            
        }
        .navigation-list-item:hover {
            background: rgb(0, 0, 0, 0.05);
            box-shadow: 0 0 0.4em rgb(255, 255, 255, 0.1);
            cursor: pointer;
        }
        .navigation-list-item.active {
            background: rgb(0, 0, 0, 0.1);
            box-shadow: 0 0 0.4em rgb(255, 255, 255, 0.1);
        }
        .navigation-link {
            color: rgb(31, 40, 51, 0.8);
            letter-spacing: 0.5px;
            font-weight: 400;
            text-decoration: none;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }
        .navigation-link i {
            font-size: 18px;
        }
        .navigation-list-item:hover .navigation-link {
            color: rgb(255, 255, 255, 0.7);
        }
        .navigation-list-item.active .navigation-link {
            color: rgb(255, 255, 255, 0.8);
            font-weight: 500;
        }
        .teams-title-container {
            padding-left: 30px;
            margin-top: 25px;
            margin-bottom: 25px;
        }
        .teams-title {
            letter-spacing: 0.5px;
            font-size: 17px;
            color: rgb(31, 40, 51, 0.8);
            font-family: 'Roboto', sans-serif;
        }
        .teams-list {
            padding-left: 32px;
            list-style-type:none;
        }
        .teams-item {
            letter-spacing: 0.5px;
            font-size: 16px;
            color: rgb(31, 40, 51, 0.8);
            font-family: 'Roboto', sans-serif;
            margin-bottom: 30px;
        }
        .teams-item i {
            font-size: 12px;
        }
    </style>
</head>
<body>

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand"><i class="bi bi-receipt-cutoff"></i> Factura Electronica JP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo RUTA_URL ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="Paginas/agregar">Insertar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="Linea">Lineas de Producto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="Establecimientos">Establecimientos</a>
        </li>
      </ul>
    </div>
  </div>
</nav> -->
<div class="page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo-container">
                    <div class="logo-container">
                      <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <div class="brand-name-container">
                        <p class="brand-name">
                            JP Factura Electronica<br/>
                        </p>
                    </div>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="navigation-list"><li class="navigation-list-item">
                        <a class="navigation-link" href="../informacionGeneral/">
                            <div class="row">
                                <div class="col-2">
                                    <i class="bi bi-house-fill"></i>
                                </div>
                                <div class="col-9">
                                  Informacion General
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../establecimientos/">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-shop-window"></i>
                                </div>
                                <div class="col-9">
                                  Establecimientos
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../formadepago">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-credit-card-2-front-fill"></i>
                                </div>
                                <div class="col-9">
                                  Formas de Pago
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../lineasdeproducto">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-archive-fill"></i>
                                </div>
                                <div class="col-9">
                                  Lineas de Producto
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../proyectos">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-folder-fill"></i>
                                </div>
                                <div class="col-9">
                                  Proyectos
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../cajas">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-inbox-fill"></i>
                                </div>
                                <div class="col-9">
                                  Cajas
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../retenciondeImpuestos">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="col-9">
                                  Retencion de Impuestos
                                </div>
                            </div>
                        </a>
                    </li>
                    <hr style="color:rgb(255, 255, 255);">
                    <li class="navigation-list-item active">
                        <a class="navigation-link " href="#">
                            <div class="row ">
                                <div class="col-2">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="col-9">
                                  *-NOMBRE USUARIO-*
                                </div>
                                <div class="col-2">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="col-9">
                                  *-NOMBRE EMPRESA-*
                                </div>
                            </div>
                        </a>
                    </li>
                    <hr style="color:rgb(255, 255, 255);margin-top:30px;">
                    <li class="navigation-list-item">
                        <a class="navigation-link" href="../logearse/controllers/cerrarsesion.php">
                            <div class="row">
                                <div class="col-2">
                                  <i class="bi bi-door-open-fill"></i>
                                </div>
                                <div class="col-9">
                                  Cerrar Sesion
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="content">
            <div class="navigationBar">
                <button id="sidebarToggle" class="btn sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
            </div>
        </div>
    </div>
 

    <script>
        let sidebarToggle = document.querySelector(".sidebarToggle");
        sidebarToggle.addEventListener("click", function(){
            document.querySelector("body").classList.toggle("active");
            document.getElementById("sidebarToggle").classList.toggle("active");
        })
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>