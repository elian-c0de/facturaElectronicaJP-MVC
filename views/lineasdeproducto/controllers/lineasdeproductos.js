$(document).ready(function() {
    let editar = false;
    // console.log('JQuery is Working');
    $('#task-result').hide();
    fetchLineasproductos();

    $('#lineasproductos-form').submit(function(e){
        const postData = {
            id: $('#lineaId').val(),
            subid: $('#sublineaId').val(),
            codigo: $('#codigo').val(),
            sublinea: $('#sublinea').val(),
            descripcion: $('#descripcion').val(),
        };
        // console.log(postData);

        let url = editar == false ? 'controllers/insert.php' : 'controllers/edit.php';

        $.post(url, postData, function(response){
            // console.log(response);
            alert(response);
            fetchLineasproductos();
            $('#lineasproductos-form').trigger('reset');
            editar = false;
        });
        e.preventDefault();
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
                    <tr  cod_empre="${lineaproducto.cod_empresa}"; formadepagosID="${lineaproducto.cod_linea}">
                            <td>${lineaproducto.cod_linea}</td>
                            <td>${lineaproducto.cod_sublinea}</td>
                            <td>${lineaproducto.txt_descripcion}</td>
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
                $('#lineasproductos').html(template);
            }
        })

        // $.ajax({
        //     url: 'controllers/list.php',
        //     type: 'GET',
        //     success: function(response){
        //         // console.log(response);
        //         let lineasproductos = JSON.parse(response);
        //         // console.log(lineasproductos);
        //         let template = '';
        //         lineasproductos.forEach(lineaproducto =>{
        //             template += `
        //             <tr lineasproductosID="${lineaproducto.cod_linea}" sublineasproductosID="${lineaproducto.cod_sublinea}">
        //                     <td>${lineaproducto.cod_linea}</td>
        //                     <td>${lineaproducto.cod_sublinea}</td>
        //                     <td>${lineaproducto.txt_descripcion}</td>
        //                     <td>
        //                         <div class="btn-group" data-toggle="buttons">
        //                             <button class="lineasproductos-edit btn btn-warning">
        //                                 <i class="bi bi-pencil-square"></i>
        //                             </button>
        //                             <button class="lineasproductos-delete btn btn-danger">
        //                                 <i class="bi bi-trash"></i>
        //                             </button>
        //                         </div>
        //                     </td>
        //         </tr>
        //             `
        //         });
        //         $('#lineasproductos').html(template);
        //     }
        // })
    }

    $(document).on('click', '.lineasproductos-delete', function() {
        if(confirm('¿Seguro que quiere eliminar esta Linea?')) {
            let element = $(this)[0].parentElement.parentElement.parentElement;
            console.log(element);
            let id = $(element).attr('lineasproductosID');
            let subid = $(element).attr('sublineasproductosID');
            // console.log(id);
            // console.log(subid);
            $.post('controllers/delete.php', {id, subid}, function(response) {
                // console.log(response);
                alert(response);
                fetchLineasproductos();
            })
        }
    })

    $(document).on('click', '.lineasproductos-edit', function() {
        let element = $(this)[0].parentElement.parentElement.parentElement;
        let id = $(element).attr('lineasproductosID');
        let subid = $(element).attr('sublineasproductosID');
        // console.log(id);
        $.post('controllers/single.php', {id, subid}, function(response) {
            // console.log(response);
            const lineaproducto = JSON.parse(response);
            $('#lineaId').val(lineaproducto.cod_linea);
            $('#sublineaId').val(lineaproducto.cod_sublinea);
            $('#codigo').val(lineaproducto.cod_linea);
            $('#sublinea').val(lineaproducto.cod_sublinea);
            $('#descripcion').val(lineaproducto.txt_descripcion);
            editar = true;
        });
    })
});