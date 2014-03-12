<!DOCTYPE html>
<html lang="ja">
<head>
	<title>Admin || SUISOU</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<!--[if lt IE 9]>
	<script src="../js/html5shiv.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/base.js"></script>
	<link type="text/css" rel="stylesheet" href="/css/html5-doctor-reset-stylesheet.css" />
	<link type="text/css" rel="stylesheet" href="/css/admin.css" />

</head>
<body>

<div id="wrap">


<header>
	<h1><a href="/admin/">SUISOU ADMIN</a></h1>
</header>

<div id="main" class="floatBox">
	<nav class="floatL admin_menu">
		<ul>
			<li><a href="/admin/blog/">BLOG</a></li>
			<li><a href="/admin/pictxt/">PIC & TXT</a></li>
			<li><a href="/admin/user/">USER</a></li>
		</ul>
	</nav>
	<div class="floatL admin_cont">
		<?php echo @$content;?>
	</div>
</div>

<p id="page-top"><a href="#wrap">PAGE TOP</a></p>

<footer>
	<p>copyright&reg;SUISOU 2009-<?php echo date('Y')?><p>
</footer>

</div>
</body>
</html>
