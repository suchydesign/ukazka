<!-- begin of articles menu -->
<h2>Novinky/Aktuality - <?php echo(isset($categories['title']) ? $categories['title'] : $title); ?></h2>

<ul id="submenu">
	<?php foreach($articlesMenu as $m): ?>
	<li><?php echo anchor('admin/article/index/' . $m['id'], $m['title']); ?></li>
	<?php endforeach; ?>
	<li><?php echo anchor('admin/article/add', $this->_actions['add']); ?></li>
</ul>
<!-- end of articles menu -->