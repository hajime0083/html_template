<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>templete</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<!--[if lt IE 9]>
	<script src="../js/html5shiv.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/base.js"></script>
	<link type="text/css" rel="stylesheet" href="../css/html5-doctor-reset-stylesheet.css" />
	<link type="text/css" rel="stylesheet" href="../css/base.css" />

</head>
<body>

<div id="wrap">


<header>
	<nav class="floatBox">
		<h1 class="floatL"><a href="/">site-name</a></h1>
		<?php include(dirname(__FILE__). '/template/menu.php'); ?>
	</nav>
</header>


<div id="main">

	<div>
		<h2>header title(w10)</h2>
		<p>
			テキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtext
		</p>
	</div>

</div>

<footer>
	<p>copyright&reg;site-name 2009-<?php echo date('Y')?><p>
</footer>
</div>
</body>
</html>
