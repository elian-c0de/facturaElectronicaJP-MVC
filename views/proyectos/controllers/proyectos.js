$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchProyectos();

    $('#proyectos-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#proyectoId').val(),
            codigo: $('#codigo').val(),
            nombre: $('#nombre').val()
        };
        // console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            // console.log(response);
            alert(response);
            fetchProyectos();
            $('#proyectos-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchProyectos(){
        
        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_proyecto',
            type: 'GET',
            success: function(response){
                console.log(response);
                let proyectos = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                proyectos.results.forEach(proyecto =>{
                    template += `
                    <tr  cod_empre="${proyecto.cod_empresa}"; formadepagosID="${proyecto.cod_proyecto}">
                            <td>${proyecto.cod_proyecto}</td>
                            <td>${proyecto.nom_proyecto}</td>
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
                $('#proyectos').html(template);
            }
        })
        
    }

    $(document).on('click', '.proyectos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar este proyecto?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            // console.log(element);
            let id = $(element).attr('proyectosID');
            // console.log(id);
            $.post('controllers/delete.php', {id}, function(response) {
                // console.log(response);
                alert(response);
                fetchProyectos();
            })
        }
    })

    $(document).on('click', '.proyectos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        let id = $(element).attr('proyectosID');
        // console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            // console.log(response);
            const proyecto = JSON.parse(response);
            $('#proyectoId').val(proyecto.codigo);
            $('#codigo').val(proyecto.codigo);
            $('#nombre').val(proyecto.nombre);
            editar = true;
        });
    })
});