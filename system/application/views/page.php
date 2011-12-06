<?php $this->load->view('layout_parts/header.php'); ?>        
        <?php if(isset($page)) if($page == 'o-asociacii'): ?>
          <h2 class="nadpis"><?php echo $title; ?></h2>
        <?php else: ?> 
          <h1><?php echo $title; ?></h1>
        <?php endif; ?>  
        <?php echo $content; ?>
        <?php if($page == 'kontakt') $this->load->view('map'); ?>
        <?php if(!empty($files)): ?>
			<ul class="subory">
			<?php foreach($files as $f): ?>
				<li><?php echo anchor('download/' . $f['seo_url'], '<strong>'.$f['name'].'</strong><br /> '.$f['description']); ?></li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
      </div>
<?php $this->load->view('layout_parts/news.php'); ?>
      <span class="cleaner"></span>
    </div>
<?php $this->load->view('layout_parts/footer.php'); ?>