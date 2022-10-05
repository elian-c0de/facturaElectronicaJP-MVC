$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchperfiles();

    $('#perfiles-form').submit(function(e){
        // console.log('Enviando...');
        if ($('#estado').prop('checked')){
            estado = 'A';
        }else{
            estado = 'C';
        }

        if (editar) {
            //EDITAR
            $.ajax({
                url: 'http://localhost/api-rest1/gen_perfil?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_perfil',
                type: "PUT",
                success: function (response) {
                    console.log('hola aqui paso');
                    console.log(response);
                    fetchperfiles();
                    $('#perfiles-form').trigger('reset');
                    editar = false;
                },
                data:{
                    nom_perfil: $('#nombre').val(),
                    sts_perfil: estado,
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            $.ajax({
            url: 'http://localhost/api-rest1/gen_perfil',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchperfiles();
                $('#perfiles-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_perfil: $('#codigo').val(),
                nom_perfil: $('#nombre').val(),
                sts_perfil: estado,
            }
        });
        e.preventDefault();
        }

    });

    function fetchperfiles(){
        $.ajax({
            url: 'http://localhost/api-rest1/gen_perfil',
            type: 'GET',
            success: function(response){
                console.log(response);
                let perfiles = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                perfiles.results.forEach(perfil =>{
                    template += `
                    <tr  cod_empre="${perfil.cod_empresa}"; perfilID="${perfil.cod_perfil}">
                            <td>${perfil.cod_perfil}</td>
                            <td>${perfil.nom_perfil}</td>
                            <td>${perfil.sts_perfil}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="perfiles-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="perfiles-delete btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    `
                });
                $('#perfiles').html(template);
            }
        })
        
    }

    $(document).on('click', '.perfiles-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este perfil?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('perfilID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/gen_perfil?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_perfil',
                success: function (response) {
                    console.log(response);
                    fetchperfiles();
                }
            });
        }
    })

    $(document).on('click', '.perfiles-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('perfilID');

        $.ajax({
            url: 'http://localhost/api-rest1/gen_perfil',
            type: 'GET',
            success: function(response){
                let perfiles = JSON.parse(response);
                perfiles.results.forEach(perfil =>{
                    if(perfil.cod_empresa == id_general && perfil.cod_perfil == id_general2){
                        $('#codigo').val(perfil.cod_perfil);
                        $('#nombre').val(perfil.nom_perfil);
                        if(perfil.sts_perfil === 'A'){
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