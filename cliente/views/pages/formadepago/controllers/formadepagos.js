$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchFormadepagos();

    $('#formadepagos-form').submit(function(e){
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

        let retencion = '';
        if ($('#retencion').prop('checked')){
            retencion = 'A';
        }else{
            retencion = 'C';
        }

        if(editar){
            console.log(id_general);
            $.ajax({
                url: 'http://localhost/api-rest1/gen_forma_pago?id='+id_general+'&nameId=cod_forma_pago',
                type: "PUT",
                success: function (response) {
                    console.log(response);
                    fetchFormadepagos();
                    $('#formadepagos-form').trigger('reset');
                    editar = false;
                },
                data:{
                    nom_forma_pago: $('#descripcion').val(),
                    cod_sri: $('#sri').val(),
                    sts_defecto: defecto,
                    sts_forma_pago: estado,
                    sts_retencion: retencion,
                }
            });
            e.preventDefault();
        }else{
            $.ajax({
            url: 'http://localhost/api-rest1/gen_forma_pago',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchFormadepagos();
                $('#formadepagos-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_forma_pago: $('#codigo').val(),
                nom_forma_pago: $('#descripcion').val(),
                cod_sri: $('#sri').val(),
                sts_defecto: defecto,
                sts_forma_pago: estado,
                sts_retencion: retencion,
            }
            });
            e.preventDefault();
        }
    });

    function fetchFormadepagos(){    
        $.ajax({
            url: 'http://localhost/api-rest1/gen_forma_pago',
            type: 'GET',
            success: function(response){
                console.log(response);
                let formadepagos = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                formadepagos.results.forEach(formadepago =>{
                    template += `
                    <tr formadepagosID="${formadepago.cod_forma_pago}">
                            <td>${formadepago.cod_forma_pago}</td>
                            <td>${formadepago.nom_forma_pago}</td>
                            <td>${formadepago.sts_defecto}</td>
                            <td>${formadepago.cod_sri}</td>
                            <td>${formadepago.sts_forma_pago}</td>
                            <td>${formadepago.sts_retencion}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="formadepagos-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="formadepagos-delete btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    `
                });
                $('#formadepagos').html(template);
            }
        })
    }

    $(document).on('click', '.formadepagos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar esta Forma de Pago?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id_general = $(element).attr('formadepagosID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/gen_forma_pago?id='+id_general+'&nameId=cod_forma_pago',
                success: function (response) {
                    console.log(response);
                    fetchFormadepagos();
                }
            });
        }
    })

    $(document).on('click', '.formadepagos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        // console.log(element);
        id_general = $(element).attr('formadepagosID');
        console.log(id_general);
        $.ajax({
            url: 'http://localhost/api-rest1/gen_forma_pago',
            type: 'GET',
            success: function(response){
                let formadepagos = JSON.parse(response);
                console.log(formadepagos);
                formadepagos.results.forEach(formadepago =>{
                    if(formadepago.cod_forma_pago === id_general){
                        $('#codigo').val(formadepago.cod_forma_pago);
                        $('#descripcion').val(formadepago.nom_forma_pago);
                        $('#sri').val(formadepago.cod_sri);
                        if(formadepago.sts_defecto === 'A'){
                            $('#defecto').prop('checked', true);
                        }else{
                            $('#defecto').prop('checked', false);
                        }
                        if(formadepago.sts_forma_pago === 'A'){
                            $('#estado').prop('checked', true);
                        }else{
                            $('#estado').prop('checked', false);
                        }
                        if(formadepago.sts_retencion === 'A'){
                            $('#retencion').prop('checked', true);
                        }else{
                            $('#retencion').prop('checked', false);
                        }
                    }
                });
            }
        });
        editar = true;

    })
});