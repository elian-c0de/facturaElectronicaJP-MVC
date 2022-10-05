$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchConceptos();

    $('#conceptos-form').submit(function(e){
        // console.log('Enviando...');
        let factura = '';
        if ($('#facturacion').prop('checked')) {
            factura = 'S';
        }else{
            factura = 'N';
        }

        let inventario = '';
        if ($('#afectainventario').prop('checked')) {
            inventario = 'A';
        }else{
            inventario = 'C';
        }

        let estado = '';
        if ($('#estado').prop('checked')){
            estado = 'A';
        }else{
            estado = 'C';
        }

        if (editar) {
            //EDITAR
            console.log(id_general,id_general2);
            
            $.ajax({
                url: 'http://localhost/api-rest1/srja_concepto?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_concepto',
                type: "PUT",
                success: function (response) {
                    console.log(response);
                    fetchConceptos();
                    $('#conceptos-form').trigger('reset');
                    editar = false;
                },
                data:{
                    txt_descripcion: $('#descripcion').val(),
                    sts_facturacion: factura,
                    sts_tipo_concepto: $('#tipoconcepto').val(),
                    sts_proceso: $('#proceso').val(),
                    sts_inventario: inventario,
                    sts_concepto: estado,
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            
            $.ajax({
            url: 'http://localhost/api-rest1/srja_concepto',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchConceptos();
                $('#conceptos-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_concepto: $('#concepto').val(),
                txt_descripcion: $('#descripcion').val(),
                sts_facturacion: factura,
                sts_tipo_concepto: $('#tipoconcepto').val(),
                sts_proceso: $('#proceso').val(),
                sts_inventario: inventario,
                sts_concepto: estado,
            }
        });
        e.preventDefault();
        }

    });

    function fetchConceptos(){
        $.ajax({
            url: 'http://localhost/api-rest1/srja_concepto',
            type: 'GET',
            success: function(response){
                console.log(response);
                let conceptos = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                conceptos.results.forEach(concepto =>{
                    template += `
                    <tr  cod_empre="${concepto.cod_empresa}"; conceptosID="${concepto.cod_concepto}">
                            <td>${concepto.cod_concepto}</td>
                            <td>${concepto.txt_descripcion}</td>
                            <td>${concepto.sts_facturacion}</td>
                            <td>${concepto.sts_tipo_concepto}</td>
                            <td>${concepto.sts_proceso}</td>
                            <td>${concepto.sts_inventario}</td>
                            <td>${concepto.sts_concepto}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="conceptos-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="conceptos-delete btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    `
                });
                $('#conceptos').html(template);
            }
        })
    }

    $(document).on('click', '.conceptos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este Concepto?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('conceptosID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/srja_concepto?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_concepto',
                success: function (response) {
                    console.log(response);
                    fetchConceptos();
                }
            });

        }
    })

    $(document).on('click', '.conceptos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('conceptosID');

        $.ajax({
            url: 'http://localhost/api-rest1/srja_concepto',
            type: 'GET',
            success: function(response){
                let conceptos = JSON.parse(response);
                conceptos.results.forEach(concepto =>{
                    if(concepto.cod_empresa == id_general && concepto.cod_concepto == id_general2){

                        $('#concepto').val(concepto.cod_concepto);
                        $('#descripcion').val(concepto.txt_descripcion);
                        if(concepto.sts_facturacion === 'S'){
                            $('#facturacion').prop('checked', true);
                        }else{
                            $('#facturacion').prop('checked', false);
                        }

                        $('#tipoconcepto').val(concepto.sts_tipo_concepto);
                        $('#proceso').val(concepto.sts_proceso);

                        if(concepto.sts_inventario === 'A'){
                            $('#afectainventario').prop('checked', true);
                        }else{
                            $('#afectainventario').prop('checked', false);
                        }
                        if(concepto.sts_concepto === 'A'){
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