$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchPrecio();

    $('#precio-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#precioId').val(),
            precio: $('#precio').val(),
            descripcion: $('#descripcion').val(),
            defecto: $('#defecto').prop('checked'),
            estado: $('#estado').prop('checked')
        };
        // console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            // console.log(response);
            alert(response);
            fetchPrecio();
            $('#precio-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchPrecio(){
        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_precio',
            type: 'GET',
            success: function(response){
                console.log(response);
                let precios = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                precios.results.forEach(precio =>{
                    template += `
                    <tr  cod_empre="${precio.cod_empresa}"; preciosID="${precio.cod_precio}">
                            <td>${precio.cod_precio}</td>
                            <td>${precio.txt_descripcion}</td>
                            <td>${precio.sts_defecto}</td>
                            <td>${precio.sts_precio}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="cajas-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="cajas-delete btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    `
                });
                $('#precios').html(template);
            }
        })
    }
    $(document).on('click', '.precios-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este establecimiento?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('preciosID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                // console.log(response);
                alert(response);
                fetchPrecio();
            })
        }
    })

    $(document).on('click', '.precios-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        // console.log(element);
        let id = $(element).attr('preciosID');
        // console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            // console.log(response);
            const precio = JSON.parse(response);
            $('#precioId').val(precio.precio);
            $('#precio').val(precio.precio);
            $('#descripcion').val(precio.descripcion);
            if(precio.defecto === 'A'){
                $('#defecto').prop('checked', true);
            }else{
                $('#defecto').prop('checked', false);
            }
            if(precio.defecto === 'A'){
                $('#estado').prop('checked', true);
            }else{
                $('#estado').prop('checked', false);
            }
            editar = true;
        });
    })
});