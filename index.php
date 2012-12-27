<!DOCTYPE html>
<html lang="ja">
<head>
	<title>templete</title>

	<meta charset="utf-8">
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
	<h1><a href="/">site-name</a></h1>
	<p><img src="http://cambelt.co/800x200" /></p>
	<nav class="floatBox">
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

	<div class="floatBox mt10">
		<div class="floatL w580 mr20">
			<h3>header title(w4)</h3>
			<p>
				テキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtextテキストtext
			</p>
		</div>

		<div class="floatL w200">
			<div>
				<h3>about</h3>
				<dl>
				<dt><img src="http://cambelt.co/200x40"></dt>
				<dd>http://XXXXXXX.XXXX</dd>
				</dl>
			</div>
			<div class="mt10">
				<h3>header title(w6)</h3>
				<nav>
					<ul>
						<li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
						<li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
						<li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
						<li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

</div>

<footer>
	<p>copyright&reg;site-name 2009-<?php echo date('Y')?><p>
</footer>
</div>
</body>
</html>
