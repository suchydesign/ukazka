	  <div id="news">
        <h3 class="left"><a href="javascript:void(0);" id="prvy" class="active" onclick="zobraz('prvy');document.getElementById('aktuality').style.display = 'block';document.getElementById('aktivity').style.display = 'none'">Aktuality</a></h3>
        <div id="aktuality">
        <?php if(!empty($articles['news'])): ?>
        <?php foreach($articles['news'] as $a): ?>
          <h4><?php echo anchor('clanky/' . $a['seo_url'], $a['title']); ?></h4>
          <p>
          <?php echo anchor('clanky/' . $a['seo_url'], $a['description']); ?>
          </p>
        <?php endforeach; ?>
          <?php echo anchor('aktuality','Zobraziť všetky','class="all"'); ?>
        <?php endif; ?>        
        </div>
        <h3 class="right"><a href="javascript:void(0);" id="druhy" onclick="zobraz('druhy');document.getElementById('aktuality').style.display = 'none';document.getElementById('aktivity').style.display = 'block'">Aktivity</a></h3>
        <div id="aktivity">
          <?php if(!empty($articles['activities'])): ?>
        	<?php foreach($articles['activities'] as $a): ?>
	          <h4><?php echo anchor('clanky/' . $a['seo_url'], $a['title']); ?></h4>
	          <p>
	          <?php echo anchor('clanky/' . $a['seo_url'], $a['description']); ?>
	          </p>
	        <?php endforeach; ?>
	        <?php echo anchor('aktivity','Zobraziť všetky','class="all"'); ?>
          <?php endif; ?>          
        </div>
      </div>