<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-7 offset-md-2">
                <div class="form-group mt-2">
                    <label for="">No. de Guía de Remisión: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>
                <div class="input-group mt-2">
                    <label for="">Factura relacionada: </label>
                    <div class="input-group-text"> 001  </div>
                    <div class="input-group-text"> 002  </div>
                    <input type="Text" class="form-control "   placeholder="text">
                    <div class="input-group-text ml-2">  ------------ </div>
                </div>
                <div class="form-group mt-2">
                    <label for="">Destinatario: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                    <div class="input-group-text mt-2"> - </div>
                </div>
                <div class="input-group mt-2">
                    <label for="">Fecha inicio <br> transporte:</label>
                    <input type="date" class="form-control">
                    <label for="">Fecha finaliza <br> transporte:</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Número de Placa: </label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Motivo de traslado: </label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Ruta: </label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Dirección de partida: </label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Dirección de destino: </label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Transportista: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                    <div class="input-group-text mt-2"> - </div>
                </div>
                <div class="input-group mt-2">
                    <label for="">Documento <br> Aduanero:</label>
                    <input type="text" class="form-control">
                    <label for="" class="ml-2">Dirección <br> E-Mail: </label>
                    <input type="email" class="form-control " placeholder="E-mail">
                </div>
                <div class="form-group mt-2">
                    <label for="">Observaciones: </label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="">Código:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Descripción:</label>
                <input 
                type="text" 
                class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="">Cantidad:</label>
                <input 
                type="number" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Unidad:</label>
                <input 
                type="number" 
                class="form-control"
                require="{1,2}">
            </div>
        </div>
    </div>

        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="guiasRemision" class="btn btn-danger border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>