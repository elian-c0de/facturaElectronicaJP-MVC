$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchParametro();

    $('#parametros-form').submit(function(e){
        // console.log('Enviando...');
        if (editar) {
            //EDITAR
            
            $.ajax({
                url: 'http://localhost/api-rest1/gen_control?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_parametro',
                type: "PUT",
                success: function (response) {
                    console.log(response);
                    fetchParametro();
                    $('#parametros-form').trigger('reset');
                    editar = false;
                },
                data:{
                    nom_parametro: $('#nombre').val(),
                    val_parametro: $('#valor').val()
                }
            });
            e.preventDefault();
        }else{
            //AGREGAR
            $.ajax({
            url: 'http://localhost/api-rest1/gen_control',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchParametro();
                $('#parametros-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_parametro: $('#parametro').val(),
                nom_parametro: $('#nombre').val(),
                val_parametro: $('#valor').val()
            }
        });
        e.preventDefault();
        }

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
                    <tr  cod_empre="${parametro.cod_empresa}"; parametrosID="${parametro.cod_parametro}">
                            <td>${parametro.cod_parametro}</td>
                            <td style="font-size: 12px">${parametro.nom_parametro}</td>
                            <td style="font-size: 12px">${parametro.val_parametro}</td>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="parametros-edit btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="parametros-delete btn btn-danger">
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
            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('parametrosID');
            
            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/gen_control?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_parametro',
                success: function (response) {
                    console.log(response);
                    fetchParametro();
                }
            });
        }
    })

    $(document).on('click', '.parametros-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        // console.log(element);
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('parametrosID');
        // console.log(id);

        $.ajax({
            url: 'http://localhost/api-rest1/gen_control',
            type: 'GET',
            success: function(response){
                let parametros = JSON.parse(response);
                parametros.results.forEach(parametro =>{
                    if(parametro.cod_empresa == id_general && parametro.cod_parametro == id_general2){
                        $('#parametro').val(parametro.cod_parametro);
                        $('#nombre').val(parametro.nom_parametro);
                        $('#valor').val(parametro.val_parametro);
                    }
                });
            }
        });
        editar = true;
        
    })
});