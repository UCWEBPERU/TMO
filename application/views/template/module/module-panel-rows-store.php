<?php if (is_array($modulo->registros)) {

    foreach ($modulo->registros as $modeloRow) { ?>

        <tr>
            <td><?php echo intval($modeloRow->id_tienda); ?></td>
            <td><?php echo $modeloRow->nombre_tienda; ?></td>
            <td><?php echo $modeloRow->nro_celular; ?></td>
            <td><?php echo $modeloRow->direccion; ?></td>
            <td><?php echo $modeloRow->gps_latitud; ?></td>
            <td><?php echo $modeloRow->gps_longitud; ?></td>
            <td>
                <a href="<?php echo $modulo->url_module_panel."/".$modeloRow->id_tienda ?>" data-row-type="store" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_tienda; ?>" class="btnActionRow"><span class="label label-primary">Editar</span>
                </a>&nbsp;&nbsp;
                <a href="#" data-row-type="store" data-row-action="delete" data-row-id="<?php echo $modeloRow->id_tienda; ?>" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>
            </td>
        </tr>

    <?php }}
?>