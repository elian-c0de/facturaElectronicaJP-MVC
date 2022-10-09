$(document).ready(function() {
    let editar = false;
    let id_general = 0;
    let id_general2 = 0;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchCajas();


    //AGREGA O EDITA LOS DATOS
    $('#cajas-form').submit(function(e){
        // console.log('Enviando...');
        if (editar) {
            //EDITAR
            console.log(id_general,id_general2);
            $.ajax({
                url: 'http://localhost/api-rest1/srja_caja?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_caja',
                type: "PUT",
                success: function (response) {
                    console.log('hola aqui paso');
                    console.log(response);

                    fetchCajas();
                    $('#cajas-form').trigger('reset');
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
            url: 'http://localhost/api-rest1/srja_caja',
            type: "POST",
            success: function (response) {
                console.log(response);
                fetchCajas();
                $('#cajas-form').trigger('reset');
                editar = false;
            },
            data:{
                cod_empresa: '1',
                cod_caja: $('#codigo').val(),
                txt_descripcion: $('#descripcion').val(),
                
            }
        });
        e.preventDefault();
        }
    });


    

    //MOSTRAR LOS DATOS
    function fetchCajas(){
        
        $.ajax({
            url: 'http://localhost/api-rest1/srja_caja',
            type: 'GET',
            success: function(response){
                console.log(response);
                let cajas = JSON.parse(response);
                //console.log(cajas);
                let template = '';
                cajas.results.forEach(caja =>{
                    template += `
                    <tr  cod_empre="${caja.cod_empresa}"; cajasID="${caja.cod_caja}">
                            <td>${caja.cod_caja}</td>
                            <td>${caja.txt_descripcion}</td>
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
                $('#cajas').html(template);
            }
        })
    }

    //ELIMINAR LOS DATOS
    $(document).on('click', '.cajas-delete', function() {
        if(confirm('¿Seguro que quiere eliminar esta caja?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            id_general = $(element).attr('cod_empre');
            id_general2 = $(element).attr('cajasID');

            $.ajax({
                type: "DELETE",
                url: 'http://localhost/api-rest1/srja_caja?id='+id_general+'&nameId=cod_empresa&id2='+id_general2+'&nameId2=cod_caja',
                success: function (response) {
                    console.log(response);
                    fetchCajas();
                }
            });
        }
    })

    $(document).on('click', '.cajas-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        //console.log(element);
        id_general = $(element).attr('cod_empre');
        id_general2 = $(element).attr('cajasID');
        $.ajax({
            url: 'http://localhost/api-rest1/srja_caja',
            type: 'GET',
            success: function(response){
                let cajas = JSON.parse(response);
                cajas.results.forEach(caja =>{
                    if(caja.cod_empresa == id_general && caja.cod_caja == id_general2){
                        $('#codigo').val(caja.cod_caja);
                        $('#descripcion').val(caja.txt_descripcion);
                    }
                });
            }
        });
        editar = true;
        
    })
});