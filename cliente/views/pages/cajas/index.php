

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
          <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
          <!-- <li class="breadcrumb-item active">Fixed Layout</li> -->
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <h1><i class="bi bi-inbox-fill"></i> Cajas</h1>
          <!-- <form action="controllers/insertar.php" method="POST"> -->
          <form id="cajas-form">
              <input type="hidden" id="cajaId">
              <input type="text" class="form-control mb-3" id="codigo" name="Codigo" placeholder="codigo" require>
              <input type="text" class="form-control mb-3" id="descripcion" name="Descripcion" placeholder="descripcion">
                
              
              <input id="btn_insert" type="submit" name="insert" class="btn btn-primary" value="Guardar">
              <input id="btn_cancel" type="button" onclick="location.href = '../InformacionGeneral/';" name="cancel" class="btn btn-danger" value="Cancelar">
          </form>
      </div>
      <div class="col-md-8">
        <table class="table table-striped table-hover">
          <thead class="bg-warning">
              <tr>
                  <th>Codigo</th>
                  <th>Descripción</th>
                  <th>Editar/Eliminar</th>
               </tr>
          </thead>
          <tbody id="cajas"></tbody>
        </table>
      </div>
    </div>
  </div>
</section>
