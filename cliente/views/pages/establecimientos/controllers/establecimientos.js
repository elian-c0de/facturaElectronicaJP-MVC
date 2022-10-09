$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchEstablecimientos();

    $('#establecimientos-form').submit(function(e){
        // console.log('Enviando...');
        let id = $('#establecimientoId').val();
        alert(id);
        let matriz = '';
        if ($('#matriz').prop('checked')) {
            matriz = 'A';
        }else{
            matriz = 'C';
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
                url: 'http://localhost/api-rest1/gen_local?id='+id_general+'&nameId=cod_empresa&id2='+id+'&nameId2=cod_establecimiento',
                type: "PUT",
                success: function (response) {
                    console.log('hola aqui paso');
                    console.log(response);

                    fetchEstablecimientos();
                    $('#establecimientos-form').trigger('reset');
                    editar = false;
                },
                data:{
                    txt_descripcion: $('#descripcion').val(),
                    txt_direccion: $('#direccion').val(),
                    sts_matriz: matriz,
                    sts_local: estado,
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR

            
            $.ajax({
            url: 'http://localhost/api-rest1/gen_local',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchEstablecimientos();
                $('#establecimientos-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_establecimiento: $('#establecimiento').val(),
                txt_descripcion: $('#descripcion').val(),
                txt_direccion: $('#direccion').val(),
                sts_matriz: matriz,
                sts_local: estado,
            }
        });
        e.preventDefault();
        }
        
    });

    function fetchEstablecimientos(){
        $.ajax({
            url: 'http://localhost/api-rest1/gen_local',
            type: 'GET',
            success: function(response){
                console.log(response);
                let establecimientos = JSON.parse(response);
                console.log(establecimientos);
                let template = '';
                establecimientos.results.forEach(establecimiento =>{
                    template += `
                    <tr  cod_empre="${establecimiento.cod_empresa}"; establecimientosID="${establecimiento.cod_establecimiento}">
                            <td>${establecimiento.cod_establecimiento}</td>
                            <td>${establecimiento.txt_descripcion}</td>
                            <td>${establecimiento.txt_direccion}</td>
                            <td>${establecimiento.sts_matriz}</td>
                            <td>${establecimiento.sts_local}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="establecimientos-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="establecimientos-delete btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    `
                });
                $('#establecimientos').html(template);
            }
        })
    }

    $(document).on('click', '.establecimientos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este establecimiento?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('establecimientosID');
            
            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/gen_local?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_establecimiento',
                success: function (response) {
                    console.log(response);
                    fetchEstablecimientos();
                }
            });
        }
    })

    $(document).on('click', '.establecimientos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        // console.log(element);
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('establecimientosID');
        // console.log(id);
        $.ajax({
            url: 'http://localhost/api-rest1/gen_local',
            type: 'GET',
            success: function(response){
                let establecimientos = JSON.parse(response);
                console.log(establecimientos);
                establecimientos.results.forEach(establecimiento =>{
                    if(establecimiento.cod_empresa == id_general && establecimiento.cod_establecimiento == id_general2){
                        $('#establecimiento').val(establecimiento.cod_establecimiento);
                        $('#descripcion').val(establecimiento.txt_descripcion);
                        $('#direccion').val(establecimiento.txt_direccion);
                        if(establecimiento.sts_matriz === 'A'){
                            $('#matriz').prop('checked', true);
                        }else{
                            $('#matriz').prop('checked', false);
                        }
                        if(establecimiento.sts_local === 'A'){
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