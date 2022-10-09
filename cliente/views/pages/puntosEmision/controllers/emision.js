$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
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
        let estado = '';
        if ($('#estado').prop('checked')){
            estado = 'A';
        }else{
            estado = 'C';
        }

        if (editar) {
            //EDITAR
            $.ajax({
                url: 'http://localhost/api-rest1/gen_punto_emision?id='+id_general+'&nameId=cod_establecimiento&id2='+id_general2+'&nameId2=cod_punto_emision',
                type: "PUT",
                success: function (response) {
                    console.log(response);
                    fetchemision();
                    $('#P-emision-form').trigger('reset');
                    editar = false;
                },
                data:{
                    txt_descripcion: $('#descripcion').val(),
                    cod_caja: $('#caja').val(),
                    sts_ambiente: $('#ambiente').val(),
                    sts_tipo_emision: $('#tipoemision').val(),
                    num_factura: $('#numFactura').val(),
                    num_nota_credito: $('#numNotaCredito').val(),
                    num_retencion: $('#numRetencion').val(),
                    num_guia: $('#numGuiaRemision').val(),
                    sts_tipo_facturacion: $('#tipofacturacion').val(),
                    sts_impresion: $('#impresion').val(),
                    num_factura_prueba: $('#numFacturaPrueba').val(),
                    num_nota_credito_prueba: $('#numNCPrueba').val(),
                    num_retencion_prueba: $('#numRetencionPrueba').val(),
                    num_guia_prueba: $('#numGuiaRemisionPrueba').val(),
                    sts_punto_emsion: estado,
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            
            $.ajax({
            url: 'http://localhost/api-rest1/gen_punto_emision',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchemision();
                $('#P-emision-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_establecimiento: $('#codigo_estable').val(),
                cod_punto_emision: $('#codigo_emision').val(),
                txt_descripcion: $('#descripcion').val(),
                cod_caja: $('#caja').val(),
                sts_ambiente: $('#ambiente').val(),
                sts_tipo_emision: $('#tipoemision').val(),
                num_factura: $('#numFactura').val(),
                num_nota_credito: $('#numNotaCredito').val(),
                num_retencion: $('#numRetencion').val(),
                num_guia: $('#numGuiaRemision').val(),
                sts_tipo_facturacion: $('#tipofacturacion').val(),
                sts_impresion: $('#impresion').val(),
                num_factura_prueba: $('#numFacturaPrueba').val(),
                num_nota_credito_prueba: $('#numNCPrueba').val(),
                num_retencion_prueba: $('#numRetencionPrueba').val(),
                num_guia_prueba: $('#numGuiaRemisionPrueba').val(),
                sts_punto_emsion: estado,
            }
        });
        e.preventDefault();
        }
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
                    <tr  cod_empre="${emision.cod_empresa}"; estableID="${emision.cod_establecimiento}"; emisionID="${emision.cod_punto_emision}">
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
                                    <button class="emisione-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="emisione-delete btn btn-danger">
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
            id_general = $(element).attr('estableID');
            id_general2 = $(element).attr('emisionID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/gen_punto_emision?id='+id_general+'&nameId=cod_establecimiento&id2='+id_general2+'&nameId2=cod_punto_emision',
                success: function (response) {
                    console.log(response);
                    fetchemision();
                }
            });

        }
    })

    $(document).on('click', '.emisione-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('estableID');
        id_general2 = $(element).attr('emisionID');

        $.ajax({
            url: 'http://localhost/api-rest1/gen_punto_emision',
            type: 'GET',
            success: function(response){
                let emisione = JSON.parse(response);
                emisione.results.forEach(emision =>{

                    if(emision.cod_establecimiento == id_general && emision.cod_punto_emision == id_general2){

                        $('#codigo_estable').val(emision.cod_establecimiento);
                        $('#codigo_emision').val(emision.cod_punto_emision);
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
                    }
                });
            }
        });
        editar = true;

    })
});