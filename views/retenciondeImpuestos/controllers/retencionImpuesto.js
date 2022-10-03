$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchretencion();

    $('#RI-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#impuestoId').val(),
            subid: $('#retencionId').val(),
            impuesto: $('#impuesto').val(),
            codigoRetencion: $('#codigoRetencion').val(),
            descripcion: $('#descripcion').val(),
            porcentajeRetencion: $('#porcentajeRetencion').val(),
            estado: $('#estado').prop('checked')
        };
        //console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            alert(response);
            //console.log(response);
            fetchretencion();
            $('#RI-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchretencion(){
        
        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_impuesto',
            type: 'GET',
            success: function(response){
                console.log(response);
                let retenciones = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                retenciones.results.forEach(retencion =>{
                    template += `
                    <tr  cod_empre="${retencion.cod_empresa}"; impuestoID="${retencion.cod_impuesto}"; retencionID="${retencion.cod_retencion}">
                            <td>${retencion.cod_impuesto}</td>
                            <td>${retencion.cod_retencion}</td>
                            <td>${retencion.txt_descripcion}</td>
                            <td>${retencion.por_retencion}</td>
                            <td>${retencion.sts_impuesto}</td>
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
                $('#impuestos').html(template);
            }
        })
        
        
    }

    $(document).on('click', '.retenciones-delete', function() {
        if(confirm('¿Seguro que quiere eliminar esta retencion de Impuesto?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            console.log(element);
            let id = $(element).attr('impuestoID');
            let subid = $(element).attr('retencionID');
            //console.log(id);
            $.post('controllers/delete.php', {id, subid}, function(response) {
                //console.log(response);
                alert(response);
                fetchretencion();
            })
        }
    })

    $(document).on('click', '.retenciones-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        console.log(element);
        let id = $(element).attr('impuestoID');
        let subid = $(element).attr('retencionID');
        //console.log(id);
        $.post('controllers/single.php', {id, subid}, function(response) {
            //console.log(response);
            const retencion = JSON.parse(response);
            $('#impuestoId').val(retencion.cod_impuesto);
            $('#retencionId').val(retencion.cod_retencion);
            $('#impuesto').val(retencion.cod_impuesto);
            $('#codigoRetencion').val(retencion.cod_retencion);
            $('#descripcion').val(retencion.txt_descripcion);
            $('#porcentajeRetencion').val(retencion.por_retencion);
            if(retencion.sts_impuesto === 'A'){
                $('#estado').prop('checked', true);
            }else{
                $('#estado').prop('checked', false);
            }
            editar = true;
        });
    })
});