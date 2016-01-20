<?php if (is_array($modulo->registros)) {
	foreach ($modulo->registros as $modeloRow) { ?>
	
	<tr>
	<td><?php echo intval($modeloRow->id_empresa); ?></td>
	<td><?php echo $modeloRow->nombre_empresa; ?></td>
	<td><?php echo $modeloRow->nombres_persona." ".$modeloRow->apellidos_persona; ?></td>
	<td><?php echo $modeloRow->pay_id; ?></td>
	<td><?php echo $modeloRow->nombre_tipo_empresa; ?></td>
	<td><?php echo $modeloRow->direccion_empresa; ?></td>
	<td><?php echo $modeloRow->telefono_empresa; ?></td>
	
	<td>
		<!--<a href="<?php echo base_url().$modulo->base_url.intval($modeloRow->id_empresa); ?>" data-row-type="empresa" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_empresa; ?>" class="btnActionRow"><span class="label label-primary">Editar</span>-->

		</a>&nbsp;&nbsp;
		<a href="#" data-row-type="empresa" data-row-action="delete" data-row-id="<?php echo $modeloRow->id_empresa; ?>" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>
	</td>
	</tr>
	
<?php }}
 ?>