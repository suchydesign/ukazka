<!-- begin of add/edit file -->
<div id="right">
	<div id="error_message">
	<?php if($this->_editStatus) echo '<p class="success">' . $this->_editStatus . '</p>'; else echo $this->validation->error_string; ?>
	<?php echo $this->_uploadError; ?>
	</div>
	
	<?php echo form_open_multipart(current_url()); ?>
	<?php echo form_hidden('id', $id); ?>
	<table>
		<tr>
			<td><?php echo form_label('Meno', 'name'); ?></td>
			<td><?php echo form_input('name', (($this->input->post('name')) ? $this->input->post('name') : $name)); ?></td>
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
			<td><?php echo form_label('Súbor', 'path'); ?></td>
			<td><?php echo form_upload('path', (($this->input->post('path')) ? $this->input->post('path') : $seo_url)); ?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Verejný', 'public'); ?></td>
			<td>
				<select name="public" id="public">
					<option value="0">Nie</option>
					<option value="1" <?php if(isset($public)) echo ($public == 1) ? "selected" : ""; ?>>Áno</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo form_label('Priradiť k stránke', 'static_pages_id'); ?></td>
			<td>
				<select name="static_pages_id" id="static_pages_id">
					<option value="">Žiadna</option>
				<?php foreach($pages as $p): ?>
					<option value="<?php echo $p['id']; ?>" <?php if(isset($static_pages_id)) echo ($static_pages_id == $p['id']) ? "selected" : ""; ?>><?php echo $p['title']; ?></option>
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
<!-- end of add/edit file -->