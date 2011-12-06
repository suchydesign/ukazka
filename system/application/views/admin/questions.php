<!-- begin of questions -->
<h2>Otazky</h2>

<?php if(!empty($questions)): ?>
	<table border="1">
		<tr>
			<th>Meno</th>
			<th>Nadpis</th>
			<th>Otázka</th>
			<th>Verejné</th>
			<th>IP adresa</th>
			<th>Pridané</th>
			<th colspan="2">Akcia</th>
		</tr>
		<?php foreach($questions as $q): ?>
		<tr>
			<td><?php echo $q['name']; ?></td>
			<td><?php echo $q['title']; ?></td>
			<td><?php echo $q['question']; ?></td>
			<td><?php echo ($q['public'] ? 'Ano' : 'Nie'); ?></td>
			<td><?php echo $q['ip']; ?></td>
			<td><?php echo $q['posting_time']; ?></td>
			<td><?php echo anchor('admin/question/edit/' . $q['id'], $this->_actions['edit']); ?></td>
			<td>
				<form action="<?php echo current_url(); ?>" method="post" onsubmit="return window.confirm('Naozaj chcete vymazat otazku?')">
				<?php echo form_hidden('id', $q['id']); ?>
				<?php echo form_submit('delete', $this->_actions['delete']); ?>
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php endif; ?>
<!-- end of questions -->