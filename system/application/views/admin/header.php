<!-- begin of header -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin.css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript"> 
		tinyMCE.init({
			relative_urls : false,
	    	remove_script_host : false,
	    	document_base_url : "<?php echo base_url(); ?>",
			
			// General options
			mode : "textareas",
			editor_selector : "mceEditor",
			theme : "advanced",
        	plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",

			//content_css : "<?php echo base_url(); ?>css/admin.css",
			
			// Theme options
	        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
	        theme_advanced_buttons2 : "link,unlink,anchor,image,|,cite,blockquote,abbr,acronym,sub,sup,|,bullist,numlist,|,outdent,indent,|,tablecontrols,|,charmap,fullscreen,|,code",
	        theme_advanced_buttons3 : "",

	        theme_advanced_toolbar_location : "top",
	        theme_advanced_toolbar_align : "left",
	        theme_advanced_statusbar_location : "bottom",
	        theme_advanced_resizing : true
		});
</script> 
	</head>
	<body>
		<div id="all">
			<div id="header">
				<h1>Admin APSZ SR</h1>
				<ul id="menu">
					<?php foreach($menu as $k => $m): ?>
						<li><?php echo anchor($k, $m); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div id="content">
<!-- end of header -->
