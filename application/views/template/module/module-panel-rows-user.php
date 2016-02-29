<?php if (is_array($modulo->registros)) {

    foreach ($modulo->registros as $modeloRow) { ?>

        <tr>
            <td><?php echo intval($modeloRow->id_usuario); ?></td>
            <td><?php echo $modeloRow->nombres_persona; ?></td>
            <td><?php echo $modeloRow->apellidos_persona; ?></td>
            <td><?php echo $modeloRow->email_usuario; ?></td>
            <td><?php echo $modeloRow->celular_personal; ?></td>
            <td><?php echo $modeloRow->telefono; ?></td>
            <td><?php echo $modeloRow->celular_trabajo; ?></td>
            <td><?php echo $modeloRow->fecha_registro_usuario; ?></td>
            <td>
                <a href="<?php echo $modulo->url_module_panel."/edit/".intval($modeloRow->id_usuario) ?>" data-row-type="user" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_usuario; ?>" class="btnActionRow"><span class="label label-primary">Editar</span></a>&nbsp;&nbsp;
                <!--                <a href="#" data-row-type="store" data-row-action="delete" data-row-id="--><?php //echo $modeloRow->id_usuario; ?><!--" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>-->
            </td>
        </tr>

    <?php }}
?>
