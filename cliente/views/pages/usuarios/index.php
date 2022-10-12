<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="mx-auto" style="padding-left: 50px;">
            <div class="row" >
                <div class="col-md-8">
                    <h1><i class="fa-solid fa-users pl-1 pr-1"></i> Usuarios</h1>
                    <br></br>
                    <form id="user-form">
                        <input type="hidden" id="userId">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Usuario:</p>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control mb-3" id="usuario"  name="usuario" placeholder="Usuario" required>
                                </select>
                            </div>
                            <br></br>
                            <div class="col-md-10">
                                <p class="lead">Usuario</p>
                            </div>
                            <div class="col-md-3">
                                <p>Código:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="codigo" placeholder="Codigo" required>
                            </div>
                            <div class="col-md-3">
                                <p>Nombre:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="col-md-3">
                                <p>Perfil:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="perfil" placeholder="Perfil" required>
                            </div>
                            <div class="col-md-3">
                                <p>Establecimiento:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="establecimiento" placeholder="Establecimiento" required>
                            </div>
                            <div class="col-md-3">
                                <p>Punto de Emisión:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control mb-3" id="puntodeEmision" placeholder="PuntodeEmision" required>
                            </div>
                            <div class="col-md-10">
                                <p class="lead">Activo</p>
                            </div>
                            <div class="col-md-4">
                                <p>Estado:</p>
                            </div>
                            <div class="col-md-8">
                                <label><input class="form-check-input mb-3" type="checkbox" id="estado" name="estado"> 
                            </div>
                            <br></br>
                            <div class="col-md-4">
                                <p>Adimistrador:</p>
                            </div>
                            <div class="col-md-8">
                                <label><input class="form-check-input mb-3" type="checkbox" id="adimistrador" name="adimistrador"> 
                            </div>
                            <br></br>
                        </div>
                        <button id="btn_insert" type="submit" name="insert" class="btn btn-primary" value="Guardar">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
     <!-- /.container-fluid -->
  </div>
</section>