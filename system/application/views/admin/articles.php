<!-- begin of articles -->
<div id="right">	
	<?php if(!empty($articles)): ?>
		<table border="1">
			<tr>
				<th>Nazov</th>
				<th>Adresa</th>
				<th>Popis</th>
				<th colspan="2">Akcia</th>
			</tr>
			<?php foreach($articles as $a): ?>
			<tr>
				<td><?php echo anchor('article/' . $a['seo_url'], $a['title']); ?></td>
				<td><?php echo $a['seo_url']; ?></td>
				<td><?php echo $a['description']; ?></td>
				<td><?php echo anchor('admin/article/edit/' . $a['id'], $this->_actions['edit']); ?></td>
				<td>
					<form action="<?php echo current_url(); ?>" method="post" onsubmit="return window.confirm('Naozaj chcete vymazať článok?')">
					<?php echo form_hidden('id', $a['id']); ?>
					<?php echo form_submit('delete', $this->_actions['delete']); ?>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
<!-- end of articles -->