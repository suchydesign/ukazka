<!-- begin of files menu -->
<h2>Súbory - <?php echo $title; ?></h2>

<ul id="submenu">
	<li><?php echo anchor('admin/file/index/1', 'Verejné'); ?></li>
	<li><?php echo anchor('admin/file/index/0', 'Privátne'); ?></li>
	<li><?php echo anchor('admin/file/', 'Všetky'); ?></li>
	<li><?php echo anchor('admin/file/add', $this->_actions['add']); ?></li>
</ul>
<!-- end of files menu -->