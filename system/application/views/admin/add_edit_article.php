<!-- begin of add/edit article -->
<div id="right">
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
			<td><?php echo form_label('Adresa', 'seo_url'); ?></td>
			<td><?php echo form_input('seo_url', (($this->input->post('seo_url')) ? $this->input->post('seo_url') : $seo_url)); ?></td>
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
			<td><?php echo form_label('Kategória', 'categories_id'); ?></td>
			<td>
				<select name="categories_id" id="categories_id">
				<?php foreach($categories as $c): ?>
					<option value="<?php echo $c['id']; ?>" <?php if($categories_id == $c['id']) echo "selected"; ?>><?php echo $c['title']; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>	
		<tr>
			<td colspan="2" style="text-align:right;"><?php echo form_submit('save', $this->_actions['save']); ?></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
</div>
<!-- end of add/edit article -->