<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-7 offset-md-2">
                <div class="form-group mt-2">
                    <label for="">Numero de Retención: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>
                <div class="form-group mt-2">
                    <label for="">Fecha:</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Clientes: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                    <div class="input-group-text mt-2"> - </div>
                </div>
                <div class="form-group mt-2">
                    <label for="">Dirección</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Teléfono:</label>
                    <input type="number" class="form-control"  pattern="[0-9]">
                </div>
                <div class="form-group mt-2">
                <label for="">Dirección E-Mail: </label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group mt-2">
                <label for="">Tipo de Documento: </label>
                <input type="text" class="form-control">
                </div>
                <div class="input-group mt-2">
                    <label for="">Tipo de Documento: </label>
                    <input type="Text" class="form-control"   placeholder="text" >
                    <label class="ml-2" for="">Tarifa 0:</label>
                    <input type="Text" class="form-control"   placeholder="text">
                </div>
                <div class="input-group mt-2">
                    <label for="">Número de Documento: </label>
                    <input type="Text" class="form-control"   placeholder="text" >
                    <label class="ml-2" for="">Tarifa IVA:</label>
                    <input type="Text" class="form-control"   placeholder="text">
                    <label class="ml-2" for="">Tarifa ICE:</label>
                    <input type="Text" class="form-control"   placeholder="text">
                </div>
                <div class="input-group mt-2">
                    <label for="">Fecha de emisión: </label>
                    <input type="date" class="form-control"   placeholder="text" >
                    <label class="ml-2" for="">IVA:</label>
                    <input type="Text" class="form-control"   placeholder="text">
                    <label class="ml-2" for="">ICE:</label>
                    <input type="Text" class="form-control"   placeholder="text">
                </div>
                <div class="form-group mt-2">
                <label for="">Total: </label>
                <div class="input-group-text"> 0.00 % </div>
                </div>
                <div class="input-group mt-2">
                    <label for="">Período Fiscal: </label>
                    <input type="Text" class="form-control"   placeholder="text" >
                    <input type="Text" class="form-control"   placeholder="text">
                    <label class="ml-2" for="">Descripcion:</label>
                    <input type="Text" class="form-control"   placeholder="text">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="">Impuesto:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Retención:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Descripción:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">% Retención:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Base Imponible:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Valor Retenido:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
        </div>
    </div>

        <div class="card-header">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-3">
                    <a href="comprobantesRetencion" class="btn btn-danger border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>