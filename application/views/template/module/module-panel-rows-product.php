<?php if (is_array($modulo->registros)) {

	foreach ($modulo->registros as $modeloRow) { ?>

		<tr>
			<?php if (sizeof($modeloRow->galeria_producto) > 0) { ?>
				<td><div class="thumb-list-product" style="background-image: url('<?php echo $modeloRow->galeria_producto[0]->url_archivo; ?>');" alt="Imagen Producto" title="Imagen Producto"></div></td>
			<?php } else { ?>
				<td><div class="thumb-list-product" style="background-image: url('<?php echo base_url().PATH_RESOURCE_ADMIN."/img/image_not_found.png"; ?>');" alt="Imagen Producto" title="Imagen Producto"></div></td>
			<?php } ?>
			<td><?php echo intval($modeloRow->id_producto); ?></td>
			<td><?php echo $modeloRow->nombre_producto; ?></td>
			<td><?php echo substr($modeloRow->descripcion_producto, 0, 50).(strlen($modeloRow->descripcion_producto) > 50 ? "..." : "") ; ?></td>
			<td><?php echo $modeloRow->stock; ?></td>
			<td>$<?php echo $modeloRow->precio_producto; ?></td>
			<td><?php echo $modeloRow->nombre_tienda; ?></td>
			<td>
				<a href="<?php echo $modulo->url_module_panel."/edit/".intval($modeloRow->id_producto) ?>" data-row-type="user" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_producto; ?>" class="btnActionRow"><span class="label label-primary">Editar</span></a>&nbsp;&nbsp;
				<a href="#" data-row-type="store" data-row-action="delete" data-row-id="<?php echo $modeloRow->id_producto; ?>" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>
			</td>
		</tr>

	<?php }}
?>