<!-- begin of files -->
<div id="right">	
	<?php if(!empty($files)): ?>
			<table border="1">
		<tr>
			<th>Súbor</th>
			<th>Popis</th>
			<th>Verejný</th>
			<th>Pridané</th>
			<th colspan="2">Akcia</th>
		</tr>
	<?php foreach($files as $f): ?>
		<tr>
			<td><?php echo anchor('download/' . $f['seo_url'], $f['name']); ?></td>
			<td><?php echo $f['description']; ?></td>
			<td><?php echo ($f['public'] ? 'Áno' : 'Nie'); ?></td>
			<td><?php echo $f['last_update']; ?></td>
			<td><?php echo anchor('admin/file/edit/' . $f['id'], $this->_actions['edit']); ?></td>
			<td>
				<form action="<?php echo current_url(); ?>" method="post" onsubmit="return window.confirm('Naozaj chcete odstrániť používateľa?')">
				<?php echo form_hidden('id', $f['id']); ?>
				<?php echo form_submit('delete', $this->_actions['delete']); ?>
				<?php echo form_close(); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
<!-- end of files -->