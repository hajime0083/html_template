<!DOCTYPE html>
<html lang="ja">
<head>
	<title><?php echo @$pagename; ?> || <?php echo @$sitename; ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<!--[if lt IE 9]>
	<script src="../js/html5shiv.js"></script>
	<![endif]-->
	<?php echo HTML::script('/js/jquery.js');?>
	<?php echo HTML::script('/js/base.js');?>
	<?php echo @$js; ?>
	<?php echo HTML::style('/css/html5-doctor-reset-stylesheet.css');?>
	<?php echo HTML::style('/css/base.css');?>
	<?php echo @$css; ?>
</head>
<body>

<div id="wrap">


<header>
	<?php if(!empty($main_img)){ ?>
	<h1><a href="/"><?php echo @$sitename; ?></a></h1>
	<p><img src="<?php echo $main_img; ?>" /></p>
	<nav class="floatBox">
		<ul class="floatBox floatR">
			<li class="floatL"><a href="/">TOP</a>/</li>
			<li class="floatL"><a href="/pictxt/">PIC&AMP;TEXT</a>/</li>
			<li class="floatL"><a href="/blog/">BLOG</a>/</li>
			<li class="floatL"><a href="/off/">OFFLINE</a>/</li>
		</ul>
	</nav>
	<?php }else{ ?>
	<nav class="floatBox">
		<h1 class="floatL"><a href="/"><?php echo @$sitename; ?></a></h1>
		<ul class="floatBox floatR">
			<li class="floatL"><a href="/">TOP</a>/</li>
			<li class="floatL"><a href="/pictxt/">PIC&AMP;TEXT</a>/</li>
			<li class="floatL"><a href="/blog/">BLOG</a>/</li>
			<li class="floatL"><a href="/off/">OFFLINE</a>/</li>
		</ul>
	</nav>
	<?php } ?>
</header>

<div id="main">

<?php echo @$content;?>

</div>

<p id="page-top"><a href="#wrap">PAGE TOP</a></p>

<footer>
	<p>copyright&reg;<?php echo @$sitename; ?> 2009-<?php echo date('Y')?><p>
</footer>

</div>
</body>
</html>
