<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-2">
                    <label for="">Factura relacionada: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>
                <div class="form-group mt-2">
                <label for="">Concepto/Motivo: </label>
                    <select class="form-control mb-3" id="Precio"  name="Precio" placeholder="Precio" required>
                    <option value="">Devolucion en Ventas</option>
                    <option value="">2DA OPCIÓN</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="">Nota de Crédito: </label>
                    <input type="number" class="form-control"  pattern="[0-9]">
                </div>
                <div class="form-group mt-2">
                    <label for="">Fecha:</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Cliente:</label>
                    <input type="text" class="form-control"><br>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group mt-2">
                    <label for="">Dirección:</label>
                    <input type="date" class="form-control">
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
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="">Código de Inventario:</label>
                <input 
                type="text" 
                class="form-control"
                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                required>
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Por favor, rellene este campo</div>
            </div>
            <div class="form-group mt-2">
                <label for="">Descripción</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="">Cantidad:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">V/Unitario:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">Total:</label>
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
                    <a href="notasCredito" class="btn btn-danger border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>