<!-- begin of edit question -->
<h2>Otazka - <?php echo $title; ?></h2>

<div id="error_message">
<?php if($this->_editStatus) echo '<p class="success">' . $this->_editStatus . '</p>'; else echo $this->validation->error_string; ?>
</div>

<?php echo form_open(current_url()); ?>
<?php echo form_hidden('id', $id); ?>
<table>
	<tr>
		<td><?php echo form_label('Meno', 'name'); ?></td>
		<td><?php echo form_input('name', (($this->input->post('name')) ? $this->input->post('name') : $name)); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Nadpis', 'title'); ?></td>
		<td><?php echo form_input('title', (($this->input->post('title')) ? $this->input->post('title') : $title)); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Otázka', 'question'); ?></td>
		<td><?php echo form_textarea('question', (($this->input->post('question')) ? $this->input->post('question') : $question)); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Odpoveď', 'answer'); ?></td>
		<td><?php echo form_textarea('answer', (($this->input->post('answer')) ? $this->input->post('answer') : $answer), ' class="mceEditor"'); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Zverejniť?', 'public'); ?></td>
		<td>
			<select name="public" id="public">
				<option value="0">Nie</option>
				<option value="1" <?php if($public == 1) echo "selected"; ?>>Ano</option>
			</select>
		</td>
	</tr>	
	<tr>
		<td colspan="2" style="text-align:right;"><?php echo form_submit('save', $this->_actions['save']); ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- end of edit question -->