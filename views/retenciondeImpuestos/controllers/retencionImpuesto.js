$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchretencion();

    $('#RI-form').submit(function(e){
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
                url: 'http://localhost/api-rest1/ecmp_impuesto?id='+id_general+'&nameId=cod_impuesto&id2='+id_general2+'&nameId2=cod_retencion',
                type: "PUT",
                success: function (response) {
                    console.log(response);
                    fetchretencion();
                    $('#RI-form').trigger('reset');
                    editar = false;
                },
                data:{
                    txt_descripcion: $('#descripcion').val(),
                    por_retencion: $('#porcentajeRetencion').val(),
                    sts_impuesto: estado,
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            
            $.ajax({
            url: 'http://localhost/api-rest1/ecmp_impuesto',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchretencion();
                $('#RI-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_impuesto: $('#impuesto').val(),
                cod_retencion: $('#codigoRetencion').val(),
                txt_descripcion: $('#descripcion').val(),
                por_retencion: $('#porcentajeRetencion').val(),
                sts_impuesto: estado,
            }
        });
        e.preventDefault();
        }

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
                    <tr  impuestoID="${retencion.cod_impuesto}"; retencionID="${retencion.cod_retencion}">
                            <td>${retencion.cod_impuesto}</td>
                            <td>${retencion.cod_retencion}</td>
                            <td>${retencion.txt_descripcion}</td>
                            <td>${retencion.por_retencion}</td>
                            <td>${retencion.sts_impuesto}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="retenciones-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="retenciones-delete btn btn-danger">
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
            id_general = $(element).attr('impuestoID');
            id_general2 = $(element).attr('retencionID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/ecmp_impuesto?id='+id_general+'&nameId=cod_impuesto&id2='+id_general2+'&nameId2=cod_retencion',
                success: function (response) {
                    console.log(response);
                    fetchretencion();
                }
            });

        }
    })

    $(document).on('click', '.retenciones-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('impuestoID');
        id_general2 = $(element).attr('retencionID');

        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_impuesto',
            type: 'GET',
            success: function(response){
                let retenciones = JSON.parse(response);
                retenciones.results.forEach(retencion =>{

                    if(retencion.cod_impuesto == id_general && retencion.cod_retencion == id_general2){

                        $('#impuesto').val(retencion.cod_impuesto);
                        $('#codigoRetencion').val(retencion.cod_retencion);
                        $('#descripcion').val(retencion.txt_descripcion);
                        $('#porcentajeRetencion').val(retencion.por_retencion);
                        if(retencion.sts_impuesto === 'A'){
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