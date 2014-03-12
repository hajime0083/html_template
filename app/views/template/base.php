<!DOCTYPE html>
<html lang="ja">
<head>
	<title>templete || SUISOU</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<!--[if lt IE 9]>
	<script src="../js/html5shiv.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/base.js"></script>
	<link type="text/css" rel="stylesheet" href="/css/html5-doctor-reset-stylesheet.css" />
	<link type="text/css" rel="stylesheet" href="/css/base.css" />

</head>
<body>

<div id="wrap">


<header>
	<?php if(!empty($main_img)){ ?>
	<h1><a href="/">SUISOU</a></h1>
	<p><img src="<?php echo $main_img; ?>" /></p>
	<nav class="floatBox">
		<ul class="floatBox floatR">
			<li class="floatL"><a href="/">menu1</a>/</li>
			<li class="floatL"><a href="/pictxt/">menu2</a>/</li>
			<li class="floatL"><a href="/page_2.html">menu3</a>/</li>
		</ul>
	</nav>
	<?php }else{ ?>
	<nav class="floatBox">
		<h1 class="floatL"><a href="/">SUISOU</a></h1>
		<ul class="floatBox floatR">
			<li class="floatL"><a href="/">menu1</a>/</li>
			<li class="floatL"><a href="/page_1.html">menu2</a>/</li>
			<li class="floatL"><a href="/page_2.html">menu3</a>/</li>
		</ul>
	</nav>
	<?php } ?>
</header>

<div id="main">

<?php echo @$content;?>

</div>

<p id="page-top"><a href="#wrap">PAGE TOP</a></p>

<footer>
	<p>copyright&reg;SUISOU 2009-<?php echo date('Y')?><p>
</footer>

</div>
</body>
</html>
