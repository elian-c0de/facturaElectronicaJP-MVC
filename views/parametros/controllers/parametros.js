$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchParametro();

    $('#parametros-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#parametrosId').val(),
            parametro: $('#parametro').val(),
            nombre: $('#nombre').val(),
            valor: $('#valor').val()
        };
        // console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            // console.log(response);
            alert(response);
            fetchParametro();
            $('#parametros-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchParametro(){
        $.ajax({
            url: 'http://localhost/api-rest1/gen_control',
            type: 'GET',
            success: function(response){
                console.log(response);
                let parametros = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                parametros.results.forEach(parametro =>{
                    template += `
                    <tr  cod_empre="${parametro.cod_empresa}"; formadepagosID="${parametro.cod_parametro}">
                            <td>${parametro.cod_parametro}</td>
                            <td style="font-size: 12px">${parametro.nom_parametro}</td>
                            <td style="font-size: 12px">${parametro.val_parametro}</td>
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
                $('#parametros').html(template);
            }
        })
        
    }
    $(document).on('click', '.parametros-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este Parametro?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('parametrosID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                // console.log(response);
                alert(response);
                fetchParametro();
            })
        }
    })

    $(document).on('click', '.parametros-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        // console.log(element);
        let id = $(element).attr('parametrosID');
        // console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            // console.log(response);
            const parametro = JSON.parse(response);
            $('#parametrosId').val(parametro.parametro);
            $('#parametro').val(parametro.parametro);
            $('#nombre').val(parametro.nombre);
            $('#valor').val(parametro.valor);
            editar = true;
        });
    })
});