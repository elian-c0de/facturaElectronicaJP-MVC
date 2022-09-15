<?php require RUTA_APP . '/views/inc/header.php'?>
<table class="table">
    <thead>
        <tr>
        <th>R.U.C</th>
        <th>Razon Social</th>
        <th>Nombre abreviado</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Direccion E-Mail</th>
        <th>Obligado Contabilidad</th>
        <th>Regimen Conabilidad</th>
        <th>Regimen Microempresa</th>
        <th>Ubicacion Logo</th>
        <!--     -->
        <th>Id_Representante</th>
        <th>Nombre Representante</th>

        </tr>
    </thead>

    <tbody>
    <?php foreach($datos['empresa'] as $empresa) : ?>
        <tr>
            <td><?php echo $empresa->num_ruc;?></td>
            <td><?php echo $empresa->nom_empresa;?></td>
            <td><?php echo $empresa->nom_abreviado;?></td>
            <td><?php echo $empresa->txt_direccion;?></td>
            <td><?php echo $empresa->num_telefono;?></td>
            <td><?php echo $empresa->txt_email;?></td>
            <td><?php echo $empresa->sts_obligado_contabilidad;?></td>
            <td><?php echo $empresa->sts_empresa;?></td>
            <td><?php echo $empresa->sts_contribuyente_rme;?></td>
            <td><?php echo $empresa->txt_path_logo;?></td>
            <td><?php echo $empresa->num_id_representante;?></td>
            <td><?php echo $empresa->nom_representante;?></td>
    
        
            <td><a href="<?php echo RUTA_URL; ?>/paginas/editar/<?php echo $empresa->cod_empresa;?>">Editar</a></td>
            <td><a href="<?php echo RUTA_URL; ?>/paginas/borrar/<?php echo $empresa->cod_empresa;?>">Borrar</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require RUTA_APP . '/views/inc/footer.php'?>