$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchConceptos();

    $('#conceptos-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#conceptosId').val(),
            concepto: $('#concepto').val(),
            descripcion: $('#descripcion').val(),
            facturacion: $('#facturacion').prop('checked'),
            tipo: $('#tipoconcepto').val(),
            proceso: $('#proceso').val(),
            afectainventario: $('#afectainventario').prop('checked'),
            estado: $('#estado').prop('checked')
        };
        // console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            // console.log(response);
            alert(response);
            fetchConceptos();
            $('#conceptos-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
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
                $('#conceptos').html(template);
            }
        })
    }

    $(document).on('click', '.conceptos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este Concepto?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('conceptosID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                // console.log(response);
                alert(response);
                fetchConceptos();
            })
        }
    })

    $(document).on('click', '.conceptos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        // console.log(element);
        let id = $(element).attr('conceptosID');
        // console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            // console.log(response);
            const concepto = JSON.parse(response);
            $('#conceptosId').val(concepto.concepto);
            $('#concepto').val(concepto.concepto);
            $('#descripcion').val(concepto.descripcion);
            if(concepto.facturacion === 'S'){
                $('#facturacion').prop('checked', true);
            }else{
                $('#facturacion').prop('checked', false);
            }
            $('#tipoconcepto').val(concepto.tipo);
            $('#proceso').val(concepto.proceso);
            if(concepto.afectainventario === 'A'){
                $('#afectainventario').prop('checked', true);
            }else{
                $('#afectainventario').prop('checked', false);
            }
            if(concepto.estado === 'A'){
                $('#estado').prop('checked', true);
            }else{
                $('#estado').prop('checked', false);
            }
            editar = true;
        });
    })
});