$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchLineasproductos();

    $('#lineasproductos-form').submit(function(e){
        if (editar) {
            //EDITAR
            console.log(id_general,id_general2);
            $.ajax({
                url: 'http://localhost/api-rest1/ecmp_linea?id='+id_general+'&nameId=cod_linea&id2='+id_general2+'&nameId2=cod_sublinea',
                type: "PUT",
                success: function (response) {
                    console.log('hola aqui paso');
                    console.log(response);

                    fetchLineasproductos();
                    $('#lineasproductos-form').trigger('reset');
                    editar = false;
                },
                data:{
                    txt_descripcion: $('#descripcion').val(),
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            $.ajax({
                url: 'http://localhost/api-rest1/ecmp_linea',
                type: "POST",
                success: function (response) {
                    console.log(response);
                    fetchLineasproductos();
                    $('#lineasproductos-form').trigger('reset');
                    editar = false;
                },
                data:{
                    cod_empresa: '1',
                    cod_linea: $('#codigo').val(),
                    cod_sublinea: $('#sublinea').val(),
                    txt_descripcion: $('#descripcion').val(),
                }
            });
            e.preventDefault();
        }

    });

    function fetchLineasproductos(){
        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_linea',
            type: 'GET',
            success: function(response){
                console.log(response);
                let lineasproductos = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                lineasproductos.results.forEach(lineaproducto =>{
                    template += `
                    <tr  lineasproductosID="${lineaproducto.cod_linea}"; sublineasproductosID="${lineaproducto.cod_sublinea}">
                            <td>${lineaproducto.cod_linea}</td>
                            <td>${lineaproducto.cod_sublinea}</td>
                            <td>${lineaproducto.txt_descripcion}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="lineasproductos-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="lineasproductos-delete btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    `
                });
                $('#lineasproductos').html(template);
            }
        })


    }

    $(document).on('click', '.lineasproductos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar esta Linea?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            id_general = $(element).attr('lineasproductosID');
            id_general2 = $(element).attr('sublineasproductosID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/ecmp_linea?id='+id_general+'&nameId=cod_linea&id2='+id_general2+'&nameId2=cod_sublinea',
                success: function (response) {
                    console.log(response);
                    fetchLineasproductos();
                }
            });

            $.post('controllers/delete.php', {id, subid}, function(response) {
                // console.log(response);
                alert(response);
                fetchLineasproductos();
            })
        }
    })

    $(document).on('click', '.lineasproductos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        id_general = $(element).attr('lineasproductosID');
        id_general2 = $(element).attr('sublineasproductosID');

        $.ajax({
            url: 'http://localhost/api-rest1/ecmp_linea',
            type: 'GET',
            success: function(response){
                let lineasproductos = JSON.parse(response);
                lineasproductos.results.forEach(lineaproducto =>{
                    if(lineaproducto.cod_linea == id_general && lineaproducto.cod_sublinea == id_general2){
                        $('#codigo').val(lineaproducto.cod_linea);
                        $('#sublinea').val(lineaproducto.cod_sublinea);
                        $('#descripcion').val(lineaproducto.txt_descripcion);
                    }
                });
            }
        });
        editar = true;

    })
});