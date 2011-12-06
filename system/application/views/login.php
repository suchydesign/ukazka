<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='description' content='login' />
<title>Login</title>
</head>
<body>
	<div style="position:absolute; margin:-100px -150px; width:300px; height:180px; top:50%; left:50%; text-align:center; border:10px solid #e3e3e3; background:#efefef; font-family:Arial, Verdana, Tahoma, sans serif;" id="login_form">
		<div style="text-align:left; margin:20px 45px;">
			<h3>Login</h3>
			<?php echo form_open(current_url()); ?>
			<?php echo form_hidden('where', current_url()); ?>
			<table>
				<tr>
					<td><?php echo form_label('Meno', 'name'); ?></td>
					<td><?php echo form_input('name'); ?></td>
				</tr>
				<tr>
					<td><?php echo form_label('Heslo', 'pass'); ?></td>
					<td><?php echo form_password('pass'); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;"><?php echo form_submit('login', 'Login'); ?></td>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>
</body>
</html>