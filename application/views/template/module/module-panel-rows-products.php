<?php if (is_array($modulo->registros)) {
	foreach ($modulo->registros as $modeloRow) { ?>
	
	<tr>
	<td><?php echo intval($modeloRow->id_producto); ?></td>
	<td><?php echo $modeloRow->nombre_producto; ?></td>
	<td><?php echo $modeloRow->descripcion_producto; ?></td>
	<td><?php echo $modeloRow->stock; ?></td>
	<td><?php echo $modeloRow->precio_producto; ?></td>
	<td>
        <span class="label label-primary"><?php echo $modeloRow->nombre_categoria; ?></span><br>
        <span class="label label-primary"><?php echo $modeloRow->nombre_sub_categoria; ?></span>
    </td>
	<td>
		<a href="<?php echo base_url().$modulo->base_url.intval($modeloRow->id_producto); ?>" data-row-type="empresa" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_producto; ?>" class="btnActionRow"><span class="label label-primary">Editar</span>

		</a>&nbsp;&nbsp;
		<a href="<?php echo base_url().$modulo->base_url.intval($modeloRow->id_producto); ?>" data-row-type="empresa" data-row-action="delete" 
		data-row-id="<?php echo $modeloRow->id_producto; ?>" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>
	</td>
	</tr>
	
<?php }}
 ?>