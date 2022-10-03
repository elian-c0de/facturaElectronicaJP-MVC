$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchMarcas();

    $('#marcas-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#marcaId').val(),
            codigo: $('#codigo').val(),
            nombre: $('#nombre').val()
        };
        console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            console.log(response);
            fetchMarcas();
            $('#marcas-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchMarcas(){
        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_marca',
            type: 'GET',
            success: function(response){
                console.log(response);
                let marcas = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                marcas.results.forEach(marca =>{
                    template += `
                    <tr  cod_empre="${marca.cod_empresa}"; formadepagosID="${marca.cod_marca}">
                            <td>${marca.cod_marca}</td>
                            <td>${marca.nom_marca}</td>
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
                $('#marcas').html(template);
            }
        })
    }

    $(document).on('click', '.marcas-delete', function() {
        if(confirm('¿Seguro que quiere eliminar esta marca?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('marcasID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                console.log(response);
                fetchMarcas();
            })
        }
    })

    $(document).on('click', '.marcas-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        let id = $(element).attr('marcasID');
        // console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            console.log(response);
            const marca = JSON.parse(response);
            $('#marcaId').val(marca.codigo);
            $('#codigo').val(marca.codigo);
            $('#nombre').val(marca.nombre);
            editar = true;
        });
    })
});