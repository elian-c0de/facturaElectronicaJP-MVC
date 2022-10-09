$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchProyectos();

    $('#proyectos-form').submit(function(e){
        // console.log('Enviando...');
        if (editar) {
            //EDITAR
            
            $.ajax({
                url: 'http://localhost/api-rest1/ecmp_proyecto?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_proyecto',
                type: "PUT",
                success: function (response) {
                    console.log(response);
                    fetchProyectos();
                    $('#proyectos-form').trigger('reset');
                    editar = false;
                },
                data:{
                    nom_proyecto: $('#nombre').val(),
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            $.ajax({
            url: 'http://localhost/api-rest1/ecmp_proyecto',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchProyectos();
                $('#proyectos-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_proyecto: $('#codigo').val(),
                nom_proyecto: $('#nombre').val(),
            }
        });
        e.preventDefault();
        }
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
                    <tr  cod_empre="${proyecto.cod_empresa}"; proyectosID="${proyecto.cod_proyecto}">
                            <td>${proyecto.cod_proyecto}</td>
                            <td>${proyecto.nom_proyecto}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="proyectos-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="proyectos-delete btn btn-danger">
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

            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('proyectosID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/ecmp_proyecto?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_proyecto',
                success: function (response) {
                    console.log(response);
                    fetchProyectos();
                }
            });
        }
    })

    $(document).on('click', '.proyectos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('proyectosID');
        
        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_proyecto',
            type: 'GET',
            success: function(response){
                let proyectos = JSON.parse(response);
                proyectos.results.forEach(proyecto =>{
                    if(proyecto.cod_empresa == id_general && proyecto.cod_proyecto == id_general2){
                        $('#codigo').val(proyecto.cod_proyecto);
                        $('#nombre').val(proyecto.nom_proyecto);
                        
                    }
                });
            }
        });
        editar = true;
        
    })
});