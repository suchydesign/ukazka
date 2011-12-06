<!-- begin of pages -->
<h2>Staticke stranky</h2>

<table border="1">
	<tr>
		<th>Nazov</th>
		<th>Adresa</th>
		<th>Popis</th>
		<th>Akcia</th>
	</tr>
	<?php foreach($pagesList as $a): ?>
	<tr>
			<td><?php echo anchor($a['seo_url'], $a['title']); ?></td>
			<td><?php echo $a['seo_url']; ?></td>
			<td><?php echo $a['description']; ?></td>
			<td><?php echo anchor('admin/page/edit/' . $a['seo_url'], $this->_actions['edit']); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
<!-- end of pages -->