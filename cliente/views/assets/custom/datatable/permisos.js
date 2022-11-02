function rellenar(){
  //var cod_usuario = document.getElementById('gen_usuario');

    var data = new FormData();
    //var lin = document.getElementById('perfil').value;

    //data.append("cod_perfil",lin);
    data.append("cod_perfil",$("#perfil").val());
    data.append("cod_empresa",localStorage.getItem('cod'));

    $.ajax({
      url: "ajax/data-permisos.php",
      method: "POST",
      data: data,
      contentType: false,
      cache: false,
      dataType: 'json',
      processData: false,
      success: function(response){
        console.log("response: ", response);
        try {
          if(response != "Not Found"){
            //ComboBox Clientes
            if (response[1]["sts_perfil_opcion"]=='A' && response[1]["cod_opcion"].trim()=='D_01') {
              $('#sts_clientes').prop('checked', true);
              }else{
              $('#sts_clientes').prop('checked', false);
            }

            //ComboBox Inventario
            if (response[3]["sts_perfil_opcion"]=='A' && response[3]["cod_opcion"].trim()=='D_02') {
              $('#sts_inventario').prop('checked', true);
              }else{
              $('#sts_inventario').prop('checked', false);
            }
            
            //ComboBox movimientos de inventario
            if (response[5]["sts_perfil_opcion"]=='A' && response[5]["cod_opcion"].trim()=='O_01') {
              $('#sts_mov_inventario').prop('checked', true);
              }else{
                $('#sts_mov_inventario').prop('checked', false);
              }
  
            //ComboBox Pedidos
            if (response[7]["sts_perfil_opcion"]=='A' && response[7]["cod_opcion"].trim()=='O_02') {
                $('#sts_pedidos').prop('checked', true);
              }else{
                $('#sts_pedidos').prop('checked', false);
              }

            //ComboBox Facturacion
            if (response[8]["sts_perfil_opcion"]=='A' && response[8]["cod_opcion"].trim()=='O_03') {
              $('#sts_facturacion').prop('checked', true);
              }else{
                $('#sts_facturacion').prop('checked', false);
              }
  
            //ComboBox Notas de credito
            if (response[10]["sts_perfil_opcion"]=='A' && response[10]["cod_opcion"].trim()=='O_04') {
                $('#sts_nota_credito').prop('checked', true);
              }else{
                $('#sts_nota_credito').prop('checked', false);
              }

              //ComboBox Caja
            if (response[12]["sts_perfil_opcion"]=='A' && response[12]["cod_opcion"].trim()=='O_05') {
              $('#sts_caja').prop('checked', true);
              }else{
                $('#sts_caja').prop('checked', false);
              }
  
              //ComboBox Gatos / Compras
              if (response[14]["sts_perfil_opcion"]=='A' && response[14]["cod_opcion"].trim()=='O_06') {
                $('#sts_gastos_compras').prop('checked', true);
              }else{
                $('#sts_gastos_compras').prop('checked', false);
              }

              //ComboBox Comprobantes de retencion
            if (response[15]["sts_perfil_opcion"]=='A' && response[15]["cod_opcion"].trim()=='O_07') {
              $('#sts_comp_retencion').prop('checked', true);
              }else{
                $('#sts_comp_retencion').prop('checked', false);
              }
  
              //ComboBox Guia de remision
              if (response[17]["sts_perfil_opcion"]=='A' && response[17]["cod_opcion"].trim()=='O_08') {
                $('#sts_guia_remision').prop('checked', true);
              }else{
                $('#sts_guia_remision').prop('checked', false);
              }

              //ComboBox Kardex inventario
            if (response[19]["sts_perfil_opcion"]=='A' && response[19]["cod_opcion"].trim()=='R_01') {
              $('#sts_kardex_inventario').prop('checked', true);
              }else{
                $('#sts_kardex_inventario').prop('checked', false);
              }
  
              //ComboBox Comprovantes emitidos
              if (response[20]["sts_perfil_opcion"]=='A' && response[20]["cod_opcion"].trim()=='R_02') {
                $('#sts_comp_emitidos').prop('checked', true);
              }else{
                $('#sts_comp_emitidos').prop('checked', false);
              }

              //ComboBox Informes de ventas y gastos
            if (response[21]["sts_perfil_opcion"]=='A' && response[21]["cod_opcion"].trim()=='R_03') {
              $('#sts_info_ventas_gastos').prop('checked', true);
              }else{
                $('#sts_info_ventas_gastos').prop('checked', false);
              }
  
              //ComboBox Precios
              if (response[23]["sts_perfil_opcion"]=='A' && response[23]["cod_opcion"].trim()=='R_04') {
                $('#sts_precios').prop('checked', true);
              }else{
                $('#sts_precios').prop('checked', false);
              }

              //ComboBox Historial de cliente
              if (response[24]["sts_perfil_opcion"]=='A' && response[24]["cod_opcion"].trim()=='R_05') {
                $('#sts_historial_cliente').prop('checked', true);
              }else{
                $('#sts_historial_cliente').prop('checked', false);
              }

              //ComboBox Top de ventas
            if (response[25]["sts_perfil_opcion"]=='A' && response[25]["cod_opcion"].trim()=='R_06') {
              $('#sts_top_ventas').prop('checked', true);
              }else{
                $('#sts_top_ventas').prop('checked', false);
              }
  
              //ComboBox ATS-SRI
              if (response[27]["sts_perfil_opcion"]=='A' && response[27]["cod_opcion"].trim()=='R_07') {
                $('#sts_ats_sri').prop('checked', true);
              }else{
                $('#sts_ats_sri').prop('checked', false);
              }

         }else{
            console.log("hola");
         
         }
        } catch (error) {
          
        }
         
      }
    })
}
