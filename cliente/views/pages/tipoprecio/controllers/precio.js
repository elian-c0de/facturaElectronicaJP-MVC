$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchPrecio();

    $('#precio-form').submit(function(e){
        // console.log('Enviando...');
        let defecto = '';
        if ($('#defecto').prop('checked')) {
            defecto = 'A';
        }else{
            defecto = 'C';
        }

        let estado = '';
        if ($('#estado').prop('checked')){
            estado = 'A';
        }else{
            estado = 'C';
        }

        if (editar) {
            //EDITAR
            
            $.ajax({
                url: 'http://localhost/api-rest1/ecmp_precio?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_precio',
                type: "PUT",
                success: function (response) {
                    console.log('hola aqui paso');
                    console.log(response);

                    fetchPrecio();
                    $('#precio-form').trigger('reset');
                    editar = false;
                },
                data:{
                    txt_descripcion: $('#descripcion').val(),
                    sts_defecto: defecto,
                    sts_precio: estado,
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            
            $.ajax({
            url: 'http://localhost/api-rest1/ecmp_precio',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchPrecio();
                $('#precio-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_precio: $('#precio').val(),
                txt_descripcion: $('#descripcion').val(),
                sts_defecto: defecto,
                sts_precio: estado,
            }
        });
        e.preventDefault();
        }
        
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
                                    <button class="precios-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="precios-delete btn btn-danger">
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
            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('preciosID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/ecmp_precio?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_precio',
                success: function (response) {
                    console.log(response);
                    fetchPrecio();
                }
            });

        }
    })

    $(document).on('click', '.precios-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('preciosID');
        // console.log(id);

        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_precio',
            type: 'GET',
            success: function(response){
                let precios = JSON.parse(response);
                precios.results.forEach(precio =>{
                    if(precio.cod_empresa == id_general && precio.cod_precio == id_general2){
                        $('#precio').val(precio.cod_precio);
                        $('#descripcion').val(precio.txt_descripcion);
                        if(precio.sts_defecto === 'A'){
                            $('#defecto').prop('checked', true);
                        }else{
                            $('#defecto').prop('checked', false);
                        }
                        if(precio.sts_precio === 'A'){
                            $('#estado').prop('checked', true);
                        }else{
                            $('#estado').prop('checked', false);
                        }
                    }
                });
            }
        });
        editar = true;

    })
});