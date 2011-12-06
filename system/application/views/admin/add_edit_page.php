<!-- begin of add/edit page -->
<h2>Stranka - <?php echo $title; ?></h2>

<div id="error_message">
<?php if($this->_editStatus) echo '<p class="success">' . $this->_editStatus . '</p>'; else echo $this->validation->error_string; ?>
</div>

<?php echo form_open(current_url()); ?>
<?php echo form_hidden('id', $id); ?>
<table>
	<tr>
		<td><?php echo form_label('Nadpis', 'title'); ?></td>
		<td><?php echo form_input('title', (($this->input->post('title')) ? $this->input->post('title') : $title)); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Popis', 'description'); ?></td>
		<td><?php echo form_textarea('description', (($this->input->post('description')) ? $this->input->post('description') : $description)); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Obsah', 'content'); ?></td>
		<td><?php echo form_textarea('content', (($this->input->post('content')) ? $this->input->post('content') : $content), ' class="mceEditor"'); ?></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:right;"><?php echo form_submit('save', $this->_actions['save']); ?></td>
	</tr>
</table>
<?php echo form_close(); ?>

<?php if(!empty($files)): ?>
	<h2>Subory na stranke</h2>
	<table border="1">
		<tr>
			<th>Súbor</th>
			<th>Popis</th>
			<th>Posledná zmena</th>
			<th colspan="2">Akcia</th>
		</tr>
	<?php foreach($files as $f): ?>
		<tr>
			<td><?php echo anchor('download/' . $f['seo_url'], $f['name']); ?></td>
			<td><?php echo $f['description']; ?></td>
			<td><?php echo $f['last_update']; ?></td>
			<td><?php echo anchor('admin/file/edit/' . $f['id'], $this->_actions['edit']); ?></td>
			<td>
				<form action="<?php echo site_url('admin/file'); ?>" method="post" onsubmit="return window.confirm('Naozaj chcete odstrániť používateľa?')">
				<?php echo form_hidden('id', $f['id']); ?>
				<?php echo form_submit('delete', $this->_actions['delete']); ?>
				<?php echo form_close(); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<!-- end of add/edit page -->