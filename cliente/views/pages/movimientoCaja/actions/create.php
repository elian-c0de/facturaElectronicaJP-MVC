<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-2">
                    <label for="">Numero de Movimiento: </label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Por favor, rellene este campo</div>
                </div>
                <div class="form-group mt-2">
                <label for="">Tipo de Movimiento: </label>
                    <select class="form-control mb-3" id="Precio"  name="Precio" placeholder="Precio" required>
                    <option value="">Ingreso</option>
                    <option value="">Egreso</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                <label for="">Concepto: </label>
                <input type="text" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Fecha:</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group mt-2">
                <label for="">Valor:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
                </div>
                <div class="form-group mt-2">
                <label for="">Descripción: </label>
                <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="">Tipo de Valor:</label>
                <input 
                type="text" 
                class="form-control"
                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                required>
                <div class="valid-feedback">Valid</div>
                <div class="invalid-feedback"> Por favor, rellene este campo</div>
            </div>
            <div class="form-group mt-2">
                <label for="">Valor:</label>
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
                    <a href="movimientoCaja" class="btn btn-danger border text-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-lg-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>