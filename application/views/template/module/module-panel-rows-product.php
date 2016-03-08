<?php if (is_array($modulo->registros)) {

	foreach ($modulo->registros as $modeloRow) { ?>

		<tr>
			<td><?php echo intval($modeloRow->id_producto); ?></td>
			<td><?php echo $modeloRow->nombre_producto; ?></td>
			<td><?php echo $modeloRow->descripcion_producto; ?></td>
			<td><?php echo $modeloRow->stock; ?></td>
			<td>$<?php echo $modeloRow->precio_producto; ?></td>
			<td><?php echo $modeloRow->nombre_tienda; ?></td>
			<td>
				<a href="<?php echo $modulo->url_module_panel."/edit/".intval($modeloRow->id_producto) ?>" data-row-type="user" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_producto; ?>" class="btnActionRow"><span class="label label-primary">Editar</span></a>&nbsp;&nbsp;
				<!--                <a href="#" data-row-type="store" data-row-action="delete" data-row-id="--><?php //echo $modeloRow->id_producto; ?><!--" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>-->
			</td>
		</tr>

	<?php }}
?>

