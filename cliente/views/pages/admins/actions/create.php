<div class="card card-dark card-outline">
    <form method="POST" class="needs-validation" novalidate>
        <div class="card-header">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-2">

                    <label for="">cod_empresa</label>
                    <input 
                    type="text" 
                    class="form-control"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,}"
                    required
                    >

                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback"> Please fill out this field</div>


                </div>

                <div class="form-group mt-2">

                    <label for="">cod_caja</label>
                    <input 
                    type="text" 
                    class="form-control"
                    require="[A-Za-z0-9]{1,}"
                    >

                </div>
                <div class="form-group mt-2">

                    <label for="">txt_descripcion</label>
                    <input 
                    type="text" 
                    class="form-control">

                </div>
                <div class="form-group mt-2">

                    <label for="">cod_usuario</label>
                    <input type="text" class="form-control">

                </div>
                <div class="form-group mt-2">

                    <label for="">fec_actualiza</label>
                    <input type="text" class="form-control">

                </div>

            </div>

        </div>

        <div class="card-header">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-3">

                    <a href="admins" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-lg-right">Save</button>
                </div>

            </div>




        </div>
    </form>

</div>