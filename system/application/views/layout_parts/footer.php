    <ul id="nav">
	<li class="logo"><?php echo anchor('/','Domovská stránka<span></span>');?></li>
	<li><?php echo anchor($menu[0]['seo_url'], $menu[0]['title'])?>
		<ul>
			<li><?php echo anchor($menu[1]['seo_url'], $menu[1]['title'])?></li>
			<li><?php echo anchor($menu[2]['seo_url'], $menu[2]['title'])?></li>
			<li><?php echo anchor($menu[3]['seo_url'], $menu[3]['title'])?></li>
		</ul>
	</li>
	<li><?php echo anchor($menu[4]['seo_url'], 'Členstvo')?>
		<ul>
			<li><?php echo anchor($menu[4]['seo_url'], $menu[4]['title'])?></li>
			<li><?php echo anchor($menu[5]['seo_url'], $menu[5]['title'])?></li>
			<li><?php echo anchor($menu[6]['seo_url'], $menu[6]['title'])?></li>
		</ul>
	</li>
	<li><?php echo anchor('/otazky', 'Otázky a odpovede')?></li>
	<li class="last"><?php echo anchor($menu[7]['seo_url'], $menu[7]['title'])?></li>
</ul>
  </div>
  <div id="footer">
    <p>
      <strong>&copy; FIRMA s.r.o.</strong>
      Všetky práva vyhradené, stránky vytvoril a spravuje <a href="http://www.webtop.sk" onclick="window.open(this.href); return false;">webtop.sk</a>
    </p>
  </div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20866537-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
