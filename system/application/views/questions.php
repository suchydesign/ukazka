<?php $this->load->view('layout_parts/header.php'); ?>
        <h1>Otázky a odpovede</h1>
        <a href="javascript:void(0);" id="btn" class="btn" onclick="document.getElementById('otazka').style.display = 'block';document.getElementById('btn').style.display = 'none'">Poslať otázku</a>
        
        <!-- formular pridaj otazku -->

		<div id="error_message">
		<?php if($this->_editStatus) echo '<p class="success">' . $this->_editStatus . '</p>'; else echo $this->validation->error_string; ?>
		</div>
		
		
		<?php echo form_open(current_url()); ?>
		<div id="otazka">
		<table>
			<tr>
				<td><?php echo form_label('Meno', 'name'); ?></td>
				<td><?php echo form_input('name', (($this->input->post('name')) ? $this->input->post('name') : '')); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nadpis', 'title'); ?></td>
				<td><?php echo form_input('title', (($this->input->post('title')) ? $this->input->post('title') : '')); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Otázka', 'question'); ?></td>
				<td><?php echo form_textarea('question', (($this->input->post('question')) ? $this->input->post('question') : '')); ?></td>
			</tr>
			<tr>
				<td colspan="2" class="right"><?php echo form_submit('save', $this->_actions['save'],'class="btn"'); ?></td>
			</tr>
		</table>
		</div>
		<?php echo form_close(); ?>
		
		<?php foreach($questions as $q): ?>
		  <dl>
		    <dt><?php echo nl2br($q['question']); ?></dt>
		    <dd><?php echo $q['answer']; ?></dd>
		  </dl>
		  <p class="name">Autor: <strong><?php echo $q['name']; ?></strong></p>
		  
		<?php endforeach; ?>
      </div>
<?php $this->load->view('layout_parts/news.php'); ?>
      <span class="cleaner"></span>
    </div>
<?php $this->load->view('layout_parts/footer.php'); ?>