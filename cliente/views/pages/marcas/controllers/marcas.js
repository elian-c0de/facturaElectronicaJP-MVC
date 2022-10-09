$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchMarcas();

    $('#marcas-form').submit(function(e){
        // console.log('Enviando...');
        if (editar) {
            //EDITAR
            $.ajax({
                url: 'http://localhost/api-rest1/ecmp_marca?id='+id_general+'&nameId=cod_marca',
                type: "PUT",
                success: function (response) {
                    console.log('hola aqui paso');
                    console.log(response);
                    fetchMarcas();
                    $('#marcas-form').trigger('reset');
                    editar = false;
                },
                data:{
                    nom_marca: $('#nombre').val(),
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            $.ajax({
            url: 'http://localhost/api-rest1/ecmp_marca',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchMarcas();
                $('#marcas-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_marca: $('#codigo').val(),
                nom_marca: $('#nombre').val(),
            }
        });
        e.preventDefault();
        }
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
                    <tr  marcasID="${marca.cod_marca}">
                            <td>${marca.cod_marca}</td>
                            <td>${marca.nom_marca}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="marcas-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="marcas-delete btn btn-danger">
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
            id_general = $(element).attr('marcasID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/ecmp_marca?id='+id_general+'&nameId=cod_marca',
                success: function (response) {
                    console.log(response);
                    fetchMarcas();
                }
            });
        }
    })

    $(document).on('click', '.marcas-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('marcasID');

        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_marca',
            type: 'GET',
            success: function(response){
                let marcas = JSON.parse(response);
                marcas.results.forEach(marca =>{
                    if(marca.cod_marca == id_general){
                        $('#codigo').val(marca.cod_marca);
                        $('#nombre').val(marca.nom_marca);
                    }
                });
            }
        });
        editar = true;
    })
});