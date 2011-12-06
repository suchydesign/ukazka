<!-- begin of users menu -->
<h2>Používatelia - <?php echo $name; ?></h2>

<ul id="submenu">
	<li><?php echo anchor('admin/user/index/a', 'Administrátori'); ?></li>
	<li><?php echo anchor('admin/user/index/u', 'Používatelia'); ?></li>
	<li><?php echo anchor('admin/user/', 'Všetci'); ?></li>
	<li><?php echo anchor('admin/user/add', $this->_actions['add']); ?></li>
</ul>
<!-- end of users menu -->