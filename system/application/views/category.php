<?php $this->load->view('layout_parts/header.php'); ?>
        <h1><?php echo $title; ?></h1>
        <div class="news">
		<?php foreach($artcls as $a): ?>
			<h2><?php echo anchor('clanky/' . $a['seo_url'], $a['title']); ?></h2>
			<p><?php echo anchor('clanky/' . $a['seo_url'], $a['description']); ?></p>
		<?php endforeach; ?>
			<?php echo '<p class="strankovanie">'.$pagination.'</p><span class="cleaner"></span>'; ?>
		  </div>
      </div>
<?php $this->load->view('layout_parts/news.php'); ?>
      <span class="cleaner"></span>
    </div>
<?php $this->load->view('layout_parts/footer.php'); ?>


