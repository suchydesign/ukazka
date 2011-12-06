<!-- begin of users -->
<div id="right">	
	<?php if(!empty($users)): ?>
		<table border="1">
			<tr>
				<th>Meno</th>
				<th>Typ</th>
				<th colspan="2">Akcia</th>
			</tr>
			<?php foreach($users as $a): ?>
			<tr>
				<td><?php echo $a['name']; ?></td>
				<td><?php echo $a['type']; ?></td>
				<td><?php echo anchor('admin/user/edit/' . $a['id'], $this->_actions['edit']); ?></td>
				<td>
					<form action="<?php echo current_url(); ?>" method="post" onsubmit="return window.confirm('Naozaj chcete odstrániť používateľa?')">
					<?php echo form_hidden('id', $a['id']); ?>
					<?php echo form_submit('delete', $this->_actions['delete']); ?>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
<!-- end of users -->