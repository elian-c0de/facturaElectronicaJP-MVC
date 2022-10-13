<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-2">
                    <label for="">Establecimiento:</label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>

                <div class="form-group mt-2">
                    <label for="">Número de movimiento:</label>
                    <input 
                    type="text" 
                    class="form-control"
                    require="[A-Za-z0-9]{1,}">
                </div>

                <div class="form-group mt-2">
                <label for="">Tipo de movimineto:</label>
                    <select class="form-control mb-3" id="tipoMovimiento"  name="tipoMovimiento" placeholder="TipoMovimiento" required>
                    <option value="">Ingreso</option>
                    <option value="">Egreso</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control">
                </div>

                <div class="form-group mt-2">
                    <label for="">Descripción</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="">Código Inventario:</label>
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
                <label for="">Costo:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
            </div>
            <div class="form-group mt-2">
                <label for="">SubTotal:</label>
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
                    <a href="movimientoInventario" class="btn btn-danger border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>