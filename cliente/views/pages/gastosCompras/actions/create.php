<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-7 offset-md-2">
                <div class="form-group mt-2">
                    <label for="">Proveedor: </label>
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
                <label for="">Tipo de Comprobante> </label>
                <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Número de Comprobante: </label>
                    <input type="number" class="form-control"  pattern="[0-9]">
                </div>
                <div class="form-group mt-2">
                    <label for="">Fecha:</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Número de Autorización: </label>
                    <input type="number" class="form-control"  pattern="[0-9]">
                </div>
                <div class="form-group mt-2">
                    <label for="">Sustento Tributario: </label>
                    <input type="number" class="form-control"  pattern="[0-9]">
                </div>
                <div class="form-group mt-2">
                <label for="">Tipo de Pago: </label>
                    <select class="form-control mb-3" id="Precio"  name="Precio" placeholder="Precio" required>
                    <option value="">Local</option>
                    <option value="">2DA OPCIÓN</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                <label for="">Forma de Pago: </label>
                    <select class="form-control mb-3" id="Precio"  name="Precio" placeholder="Precio" required>
                    <option value="">OTROS....</option>
                    <option value="">2DA OPCIÓN</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="">Base Cero:</label>
                    <div class="input-group-text "> 0.00 % </div>
                    <label class="ml-2" for="">Bienes:</label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                    <label class="ml-2" for="">Servicios:</label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                    <label class="ml-2" for="">Activos:</label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                </div>
                <div class="input-group mt-2">
                    <label for="">Base IVA: </label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                    <div class="input-group-text"> 0.00 % </div>
                    <label class="ml-2" for="">IVA: </label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                </div>
                <div class="input-group mt-2">
                    <label for="">Base ICE: </label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                    <div class="input-group-text"> 0.00 % </div>
                    <label class="ml-2" for="">ICE: </label>
                    <input type="number" class="form-control"  pattern="[0-9]" placeholder="Input group example" value="0.00">
                </div>
                <div class="form-group mt-2">
                <label for="">Total Comprobante:</label>
                <div class="input-group-text"> 0.00 % </div>
                </div>
                <div class="form-group mt-2">
                <label for="">Estado: </label>
                    <select class="form-control mb-3" id="Precio"  name="Precio" placeholder="Precio" required>
                    <option value="">Retiene</option>
                    <option value="">2DA OPCIÓN</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                <label for="">Descripción</label>
                <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="">Base 0:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Base IVA:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">IVA:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Base ICE:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">ICE:</label>
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
                    <a href="gastosCompras" class="btn btn-danger border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>