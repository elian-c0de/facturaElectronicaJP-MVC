
<div class="card card-dark card-outline">
  <form method="post" class="needs-validation" novalidate enctype="multipart/form-data"><section class="content-header">
    <div class="card-header">
        
      <?php
        require_once("controllers/permisos.controllers.php");
        $create = new PermisosController();
        $create -> edit();
      ?>
      <div class="col-md-5 offset-md-2">

      <!-- VALIDAR TIPO DE USUARIOS -->
        <div class="form-group mt-2">
          <label>Perfiles:</label>
          <?php
          // require_once("controllers/admins.controllers.php");
          $create = new PermisosController();
          $tipo = $create->perfiles();
          $tipo = json_encode($tipo);
          $tipo = json_decode($tipo, true);
          ?>
          <select class="form-control select2 changeCountry" name="perfil" id="perfil" onchange="rellenar()" required>
              <option value>Seleccione el perfil</option>
              <?php foreach ($tipo as $key => $value) : ?>
                <option value="<?php echo $value["cod_perfil"] ?>" ><?php echo $value["cod_perfil"] ?> | <?php echo $value["nom_perfil"] ?></option>	
              <?php endforeach ?>
          </select>
		</div>  

        <!-- DIVICIÓN DEL CAMPO: DATOS -->
        <div class="form-group mt-2">
            <p class="lead">DATOS </br>______________________</p>
        </div>
        <!-- CLIENTES -->
        <div class="form-group mt-2">
            <label for="">Clientes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_clientes" id="sts_clientes">
        </div>
        <!-- CLIENTES -->
        <div class="form-group mt-2">
            <label for="">Inventario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_inventario" id="sts_inventario">
        </div>


        <!-- DIVICIÓN DEL CAMPO: OPERACION -->
        <div class="form-group mt-2">
            <p class="lead">OPERACION </br>______________________</p>
        </div>
        <!-- MOVIMIENTOS DE INVENTARIO -->
        <div class="form-group mt-2">
            <label for="">Movimientos del inventario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_mov_inventario" id="sts_mov_inventario">
        </div>
        <!-- PEDIDOS -->
        <div class="form-group mt-2">
            <label for="">Pedidos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_pedidos" id="sts_pedidos">
        </div>
        <!-- FACTURACION -->
        <div class="form-group mt-2">
            <label for="">Facturación:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_facturacion" id="sts_facturacion">
        </div>
        <!-- NOTAS DE CREDITO -->
        <div class="form-group mt-2">
            <label for="">Notas de crédito:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_nota_credito" id="sts_nota_credito">
        </div>
        <!-- CAJA -->
        <div class="form-group mt-2">
            <label for="">Caja:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_caja" id="sts_caja">
        </div>
        <!-- GASTOS / COMPRAS -->
        <div class="form-group mt-2">
            <label for="">Gastos / Compras:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_gastos_compras" id="sts_gastos_compras">
        </div>
        <!-- COMPROBANTES DE RETENCION -->
        <div class="form-group mt-2">
            <label for="">Comprobantes de retención:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_comp_retencion" id="sts_comp_retencion">
        </div>
        <!-- GUIA DE REMISION -->
        <div class="form-group mt-2">
            <label for="">Guía de Remisión:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_guia_remision" id="sts_guia_remision">
        </div>


        <!-- DIVICIÓN DEL CAMPO: REPORTES -->
        <div class="form-group mt-2">
            <p class="lead">REPORTES </br>______________________</p>
        </div>
        <!-- KÁRDEX DEL INVENTARIO -->
        <div class="form-group mt-2">
            <label for="">Kárdex del inventario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_kardex_inventario" id="sts_kardex_inventario">
        </div>
        <!-- COMPROBANTES EMITIDOS -->
        <div class="form-group mt-2">
            <label for="">Comprobantes emitidos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_comp_emitidos" id="sts_comp_emitidos">
        </div>
        <!-- INFORMES DE VENTAS Y GASTOS -->
        <div class="form-group mt-2">
            <label for="">Informes de ventas y gastos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_info_ventas_gastos" id="sts_info_ventas_gastos">
        </div>
        <!-- PRECIOS -->
        <div class="form-group mt-2">
            <label for="">Precios:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_precios" id="sts_precios">
        </div>
        <!-- HISTORIAL DEL CLIENTE -->
        <div class="form-group mt-2">
            <label for="">Historial del cliente:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_historial_cliente" id="sts_historial_cliente">
        </div>
        <!-- TOP DE VENTAS -->
        <div class="form-group mt-2">
            <label for="">Top de ventas:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_top_ventas" id="sts_top_ventas">
        </div>
        <!-- ATS-SRI -->
        <div class="form-group mt-2">
            <label for="">ATS-SRI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="checkbox"  name="sts_ats_sri" id="sts_ats_sri">
        </div>
      </div>
    <!-- BOTONES DE REGRESAR Y GUARDAR -->
    <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="../cliente" class="btn btn-light border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-dark float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
  </form>
   <!-- FIN DE FORMULARIO USUARIOS -->
</div>

<script src="views/assets/custom/datatable/permisos.js"></script>