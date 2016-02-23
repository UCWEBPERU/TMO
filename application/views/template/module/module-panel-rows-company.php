<?php if (is_array($modulo->registros)) {
	foreach ($modulo->registros as $modeloRow) { ?>
	
	<tr>
	<td><?php echo intval($modeloRow->id_empresa); ?></td>
	<td><?php echo $modeloRow->organization; ?></td>
	<td><?php echo $modeloRow->nombres_representante." ".$modeloRow->apellidos_representante; ?></td>
	<td><?php echo $modeloRow->email_representante; ?></td>
	<td><?php echo $modeloRow->nombre_tipo_empresa; ?></td>
	<td><?php echo $modeloRow->direccion; ?></td>
	<td><?php echo $modeloRow->celular_personal; ?></td>
	<td><?php echo $modeloRow->fecha_registro; ?></td>

	<td>
		<!--<a href="<?php echo base_url().$modulo->base_url.intval($modeloRow->id_empresa); ?>" data-row-type="empresa" data-row-action="edit" data-row-id="<?php echo $modeloRow->id_empresa; ?>" class="btnActionRow"><span class="label label-primary">Editar</span>-->

		</a>&nbsp;&nbsp;
		<a href="#" data-row-type="empresa" data-row-action="delete" data-row-id="<?php echo $modeloRow->id_empresa; ?>" class="btnActionRow"><span class="label label-danger">Eliminar</span></a>
	</td>
	</tr>
	
<?php }}
 ?>