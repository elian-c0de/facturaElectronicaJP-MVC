$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchperfiles();

    $('#perfiles-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#perfilId').val(),
            codigo: $('#codigo').val(),
            nombre: $('#nombre').val(),
            estado: $('#estado').prop('checked')
        };
        console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            //console.log(response);
            alert(response);
            fetchperfiles();
            $('#perfiles-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
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
                    <tr  cod_empre="${perfil.cod_empresa}"; formadepagosID="${perfil.cod_perfil}">
                            <td>${perfil.cod_perfil}</td>
                            <td>${perfil.nom_perfil}</td>
                            <td>${perfil.sts_perfil}</td>
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
                $('#perfiles').html(template);
            }
        })
        
    }

    $(document).on('click', '.perfiles-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este perfil?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('perfilID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                //console.log(response);
                alert(response);
                fetchperfiles();
            })
        }
    })

    $(document).on('click', '.perfiles-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        console.log(element);
        let id = $(element).attr('perfilID');
        console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            console.log(response);
            const perfil = JSON.parse(response);
            $('#perfilId').val(perfil.codigo);
            $('#codigo').val(perfil.codigo);
            $('#nombre').val(perfil.nombre);
            if(perfil.estado === 'A'){
                $('#estado').prop('checked', true);
            }else{
                $('#estado').prop('checked', false);
            }
            editar = true;
        });
    })
});