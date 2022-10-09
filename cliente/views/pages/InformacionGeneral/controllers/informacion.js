$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchEstablecimientos();

    $('#establecimientos-form').submit(function(e){
        // console.log('Enviando...');
        const postData = {
            id: $('#establecimientoId').val(),
            establecimiento: $('#establecimiento').val(),
            descripcion: $('#descripcion').val(),
            direccion: $('#direccion').val(),
            matriz: $('#matriz').prop('checked'),
            estado: $('#estado').prop('checked')
        };
        console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            console.log(response);
            fetchEstablecimientos();
            $('#establecimientos-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
    });

    function fetchEstablecimientos(){
        let element = $(this)[0].parentElement.parentElement.parentElement;
        console.log(element);
        let id = $(element).attr('establecimientosID');
        console.log(id);
        $.post('controllers/single.php', {id}, function(response) {
            console.log(response);
            const establecimiento = JSON.parse(response);
            $('#establecimientoId').val(establecimiento.establecimiento);
            $('#establecimiento').val(establecimiento.establecimiento);
            $('#descripcion').val(establecimiento.descripcion);
            $('#direccion').val(establecimiento.direccion);
            if(establecimiento.matriz === 'A'){
                $('#matriz').prop('checked', true);
            }else{
                $('#matriz').prop('checked', false);
            }
            if(establecimiento.estado === 'A'){
                $('#estado').prop('checked', true);
            }else{
                $('#estado').prop('checked', false);
            }
            editar = true;
        });
    }
});