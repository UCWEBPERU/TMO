<?php if (is_array($modulo->registros)) {
    foreach ($modulo->registros as $modeloRow) { ?>

        <tr>
            <td><?php echo intval($modeloRow->id_paquetes_tmo); ?></td>
            <td><?php echo $modeloRow->nombre_paquete; ?></td>
            <td><?php echo $modeloRow->descripcion_paquete; ?></td>
            <td><?php echo $modeloRow->total_store; ?></td>
            <td><?php echo $modeloRow->total_products; ?></td>
            <td><?php echo $modeloRow->total_users; ?></td>
            <td><?php echo $modeloRow->total_categorias; ?></td>
            <td><?php echo $modeloRow->tiempo_meses_paquete; ?></td>
            <td><?php echo $modeloRow->precio_paquete; ?></td>
            <td>
                <a href="<?php echo base_url().$modulo->base_url.intval($modeloRow->id_paquetes_tmo); ?>" data-row-type="paquetes-tmo" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_paquetes_tmo; ?>" class="btnActionRow"><span class="label label-primary">Editar</span>

                </a>&nbsp;&nbsp;
                <a href="<?php echo base_url().$modulo->base_url.intval($modeloRow->id_paquetes_tmo); ?>" data-row-type="paquetes-tmo" data-row-action="delete"
                   data-row-id="<?php echo $modeloRow->id_tipo_empresa; ?>" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>
            </td>
        </tr>

    <?php }}
?>