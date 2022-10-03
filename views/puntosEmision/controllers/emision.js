$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchemision();

    // search key type event
    $('#search').keyup(function() {
        if($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
            url: 'controllers/search.php',
            data: {search},
            type: 'POST',
            success: function (response) {
            if(!response.error) {
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                template += `
                        <li><a href="#" class="task-item">${task.name}</a></li>
                        ` 
                });
                ;
                $('#task-result').show();
                $('#container').html(template);
            }
            } 
        })
        }
    });

    $('#P-emision-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#emisionId').val(),
            codigo: $('#codigo').val(),
            descripcion: $('#descripcion').val(),
            caja: $('#caja').val(),
            ambiente: $('#ambiente').val(),
            tipoemision: $('#tipoemision').val(),
            numFactura: $('#numFactura').val(),
            numNotaCredito: $('#numNotaCredito').val(),
            numRetencion: $('#numRetencion').val(),
            numGuiaRemision: $('#numGuiaRemision').val(),
            tipofacturacion: $('#tipofacturacion').val(),
            impresion: $('#impresion').val(),
            numFacturaPrueba: $('#numFacturaPrueba').val(),
            numNCPrueba: $('#numNCPrueba').val(),
            numRetencionPrueba: $('#numRetencionPrueba').val(),
            numGuiaRemisionPrueba: $('#numGuiaRemisionPrueba').val(),
            estado: $('#estado').prop('checked')
        };
        console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            console.log(response);
            fetchemision();
            $('#P-emision-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchemision(){
        $.ajax({
            url: 'http://localhost/api-rest1/gen_punto_emision',
            type: 'GET',
            success: function(response){
                console.log(response);
                let emisione = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                emisione.results.forEach(emision =>{
                    template += `
                    <tr  cod_empre="${emision.cod_empresa}"; emisionID="${emision.cod_punto_emision}">
                            <td>${emision.cod_punto_emision}</td>
                            <td>${emision.txt_descripcion}</td>
                            <td>${emision.cod_caja}</td>
                            <td>${emision.sts_ambiente}</td>
                            <td>${emision.sts_tipo_emision}</td>
                            <td>${emision.num_factura}</td>
                            <td>${emision.num_nota_credito}</td>
                            <td>${emision.num_retencion}</td>
                            <td>${emision.num_guia}</td>
                            <td>${emision.sts_tipo_facturacion}</td>
                            <td>${emision.sts_impresion}</td>
                            <td>${emision.num_factura_prueba}</td>
                            <td>${emision.num_nota_credito_prueba}</td>
                            <td>${emision.num_retencion_prueba}</td>
                            <td>${emision.num_guia_prueba}</td>
                            <td>${emision.sts_punto_emsion}</td>
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
                $('#emisiones').html(template);
            }
        })
        
    }

    $(document).on('click', '.emisione-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este establecimiento?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('emisionID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                console.log(response);
                fetchemision();
            })
        }
    })

    $(document).on('click', '.emisione-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        console.log(element);
        let id = $(element).attr('emisionID');
        console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            console.log(response);
            const emision = JSON.parse(response);
            $('#emisionId').val(emision.cod_punto_emision);
            $('#codigo').val(emision.cod_punto_emision);
            $('#descripcion').val(emision.txt_descripcion);
            $('#caja').val(emision.cod_caja);
            $('#ambiente').val(emision.sts_ambiente);
            $('#tipoemision').val(emision.sts_tipo_emision);
            $('#numFactura').val(emision.num_factura);
            $('#numNotaCredito').val(emision.num_nota_credito);
            $('#numRetencion').val(emision.num_retencion);
            $('#numGuiaRemision').val(emision.num_guia);
            $('#tipofacturacion').val(emision.sts_tipo_facturacion);
            $('#impresion').val(emision.sts_impresion);
            $('#numFacturaPrueba').val(emision.num_factura_prueba);
            $('#numNCPrueba').val(emision.num_nota_credito_prueba);
            $('#numRetencionPrueba').val(emision.num_retencion_prueba);
            $('#numGuiaRemisionPrueba').val(emision.num_guia_prueba);
            if(emision.sts_punto_emsion === 'A'){
                $('#estado').prop('checked', true);
            }else{
                $('#estado').prop('checked', false);
            }
            editar = true;
        });
    })
});