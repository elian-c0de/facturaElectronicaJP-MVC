<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
    <div class="row">
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <h1><i class="bi bi-box-seam-fill"></i> Cierre de Caja</h1>
                <div class="form-group mt-2">
                    <label for="">Fecha de Cierre:</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group mt-2">
                <label for="">Saldo Anterior:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
                </div>
                <div class="form-group mt-2">
                <label for="">Saldo Actual:</label>
                <input 
                type="text" 
                class="form-control"
                require="{1,2}">
                </div>
                <div class="form-group mt-2">
                <label for="">Observaciones: </label>
                <input type="text" class="form-control">
                </div>
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