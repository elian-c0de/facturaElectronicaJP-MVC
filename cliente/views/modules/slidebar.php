<?php

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);



?>




<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="views/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">JP Facturacion</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="views/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION["admin"]->nom_usuario ?></a>
        <a href="#" class="d-block"><?php echo $_SESSION["admin"]->cod_empresa ?></a>
      </div>
    </div>




    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>













    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        <li class="nav-item">

          <a href="#" class="nav-link <?php if (empty($routesArray[3])) : ?>active<?php endif ?>">
            <i class="nav-icon fas fa-solid fa-mug-hot"></i>
            <p>
              Datos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>


          <?php foreach ($_SESSION["perfil"] as $key => $value) : ?>


            <ul class="nav nav-treeview">

              <?php if (trim($value->cod_opcion) == "D_01" && $value->sts_perfil_opcion == "A") :  ?>

                <li class="nav-item">
                  <a href="clientes" class="nav-link">
                    <i class="fa-solid fa-user-tag nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>

              <?php endif ?>



              <?php if (trim($value->cod_opcion) == "D_02" && $value->sts_perfil_opcion == "A") :  ?>

                <li class="nav-item">
                  <a href="inventario" class="nav-link">
                    <i class="fa-solid fa-truck-moving nav-icon"></i>
                    <p>Inventario</p>
                  </a>
                </li>
              <?php endif ?>

            </ul>
          <?php endforeach; ?>


        </li>








        <li class="nav-item">
          <a href="#" class="nav-link <?php if ($routesArray[3] == "Cajas") : ?>active<?php endif ?>">
            <i class="fa-solid fa-arrow-down-up-across-line nav-icon"></i>
            <p>
              Operacion
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>





          <?php foreach ($_SESSION["perfil"] as $key => $value) : ?>



            <ul class="nav nav-treeview">

              <?php if (trim($value->cod_opcion) == "O_01" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="movimientoInventario" class="nav-link">
                    <i class="fa-solid fa-truck-ramp-box nav-icon"></i>
                    <p>Movimientos del inventario</p>
                  </a>
                </li>

              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_02" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="pedidos" class="nav-link">
                    <i class="fa-solid fa-cart-flatbed nav-icon"></i>
                    <p>Pedidos</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_03" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="facturacion" class="nav-link">
                    <i class="fa-solid fa-file-invoice nav-icon"></i>
                    <p>Facturacion</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_04" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="notasCredito" class="nav-link">
                    <i class="fa-solid fa-receipt nav-icon"></i>
                    <p>Notas de credito</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_05" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="movimientoCaja" class="nav-link ">
                    <i class="fa-solid fa-cash-register nav-icon"></i>
                    <p>Cajas</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_06" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="gastosCompras" class="nav-link">
                    <i class="fa-solid fa-wallet nav-icon"></i>
                    <p>Gastos/Compras</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_07" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="comprobantesRetencion" class="nav-link">
                    <i class="fa-solid fa-file-invoice nav-icon"></i>
                    <p>Comprobantes de retencion</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "O_08" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="guiasRemision" class="nav-link">
                    <i class="fa-solid fa-square-up-right nav-icon"></i>
                    <p>Guias de Remision</p>
                  </a>
                </li>
              <?php endif ?>

            </ul>

          <?php endforeach; ?>




        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-clipboard nav-icon"></i>
            <p>
              Reportes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <?php foreach ($_SESSION["perfil"] as $key => $value) : ?>

            <ul class="nav nav-treeview">


              <?php if (trim($value->cod_opcion) == "R_01" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="kardexinventario" class="nav-link">
                    <i class="fa-solid fa-worm nav-icon"></i>
                    <p>Kardex de inventario</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "R_02" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="comprobantesemitidos" class="nav-link">
                    <i class="fa-solid fa-file-lines nav-icon"></i>
                    <p>Comprobantes emitidos</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "R_03" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="info_ventasygastos" class="nav-link">
                    <i class="fa-solid fa-circle-exclamation nav-icon"></i>
                    <p>Informe de ventas y gastos</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "R_04" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="precios" class="nav-link">
                    <i class="fa-solid fa-sack-dollar nav-icon"></i>
                    <p>Precios</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "R_05" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="historialcliente" class="nav-link">
                    <i class="fa-solid fa-clock-rotate-left nav-icon"></i>
                    <p>Historial del cliente</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "R_06" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="topventas" class="nav-link">
                    <i class="fa-solid fa-jet-fighter-up nav-icon"></i>
                    <p>Top de ventas</p>
                  </a>
                </li>
              <?php endif ?>
              <?php if (trim($value->cod_opcion) == "R_07" && $value->sts_perfil_opcion == "A") :  ?>
                <li class="nav-item">
                  <a href="ats_sri" class="nav-link">
                    <i class="fa-solid fa-laptop nav-icon"></i>
                    <p>ATS_SRI</p>
                  </a>
                </li>
              <?php endif ?>
            </ul>
          <?php endforeach; ?>

        </li>
        <li class="nav-item">
          <a href="claveusuario" class="nav-link">
            <i class="fa-solid fa-key"></i>
            <p> Cambiar Clave de Usuario</p>
          </a>
        </li>

      </ul>


    </nav>

    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>