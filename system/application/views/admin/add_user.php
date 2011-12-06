<!-- begin of add user -->
<div id="right">
	<div id="error_message">	
	<?php if($this->_editStatus) echo '<p class="success">' . $this->_editStatus . '</p>'; else echo $this->validation->error_string; ?>
	</div>
	
	<h3>Pridaj</h3>
	
	<?php echo form_open(current_url()); ?>
	<table>
		<tr>
			<td><?php echo form_label('Meno', 'name'); ?></td>
			<td><?php echo form_input('name', (($this->input->post('name')) ? $this->input->post('name') : '')); ?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Heslo', 'pass'); ?></td>
			<td><?php echo form_password('pass'); ?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Heslo2', 'pass2'); ?></td>
			<td><?php echo form_password('pass2'); ?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Typ', 'type'); ?></td>
			<td>
				<select name="type" id="type">
					<option value="u">Používateľ</option>
					<option value="a">Administrátor</option>
				</select>
			</td>
		</tr>	
		<tr>
			<td colspan="2" style="text-align:right;"><?php echo form_submit('save', $this->_actions['save']); ?></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
</div>
<!-- end of add user -->