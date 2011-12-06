<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk" lang="sk">
 <head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<meta name='description' content='<?php echo $description; ?>' />
<meta name="keywords" content="" />
<meta name="robots" content="all,follow" />
  <meta name="author" content="Webtop, www.webtop.sk" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/reset.css" type="text/css" media="screen,projection" /> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/screen.css" type="text/css" media="screen,projection" /> 
  <link rel="shortcut icon" href="<?php echo base_url(); ?>media/images/favicon.ico"/> 
  <script type="text/javascript" src="<?php echo base_url(); ?>media/js/news.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>media/js/menu.js"></script>
</head>
<body <?php if(isset($page)) if($page == 'o-asociacii'): ?> class="home"<?php endif; ?>>
<div id="all">
    <div id="header">
    <?php if(isset($page)) if($page == 'o-asociacii'): ?>
      <h1><?php echo $title; ?></h1>
      <?php if(!empty($header_text['content'])) echo $header_text['content']; ?>
      <?php echo anchor($menu[6]['seo_url'], '<strong>Stať sa členom</strong>','class="btn"')?>
    <?php endif; ?>      
    </div>
    <div id="content">
      <div id="content-box">
