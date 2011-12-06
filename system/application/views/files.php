<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='description' content='<?php echo $description; ?>' />
<title><?php echo $title; ?></title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

</style>
</head>
<body>

<h1><?php echo $title; ?></h1>

<h2>menu</h2>
<ul>
	<?php foreach($menu as $m): ?>
	<li><?php echo anchor($m['seo_url'], $m['title']); ?></li>
	<?php endforeach; ?>
</ul>

<h2>kategorie</h2>
<ul>
	<?php foreach($categories as $m): ?>
	<li><?php echo anchor($m['seo_url'], $m['title']); ?></li>
	<?php endforeach; ?>
</ul>

<?php foreach($files as $a): ?>
<h3><?php echo anchor('download/' . $a['seo_url'], $a['name']); ?></h3>
<p><?php echo $a['description']; ?></p>
<p><?php echo $a['last_update']; ?></p>
<?php endforeach; ?>

<p><br />Last update</p>

</body>
</html>