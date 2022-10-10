<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="mx-auto" style="padding-left: 50px;">
            <div class="row" >
                <div class="col-md-8">
                    <h1><i class=" fa-solid fa-user  pl-1 pr-1"></i>Informacion General</h1>
                    <br></br>
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
                                <label><input class="form-check-input mb-3" type="checkbox" id="regimenmicroempresa" name="regimenmicroempresa"> 
                            </div>
                            <br></br>
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
                    </form>
                </div>
            </div>
        </div>
     <!-- /.container-fluid -->
  </div>
</section>