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
	
</header>

<?php if(Auth::check()){ ?>
<div id="main" class="floatBox">
	<div class="floatL">
		<h1><a href="/admin/">SUISOU ADMIN</a></h1>
		<h4 class="mt10">Admin Menu</h4>
		<nav class="admin_menu">
			<ul>
				<li><a href="/admin/blog/">BLOG</a></li>
				<li><a href="/admin/pictxt/">PIC & TXT</a></li>
				<li><a href="/admin/offline/">OFFLINE</a></li>
				<li><a href="/admin/link/">LINK</a></li>
				<li><a href="/admin/genre/">GENRE</a></li>
				<li><a href="/admin/user/">USER</a></li>
			</ul>
			<ul class="mt20">
				<li><a href="/logout">LOGOUT</a></li>
			</ul>
		</nav>
	</div>

	<div class="floatL admin_cont">
		<?php echo @$content;?>
	</div>
</div>
<?php }else{ ?>
	<div id="main">
		<h1><a href="/admin/">SUISOU ADMIN</a></h1>
		<div class="mt10">
			<?php echo @$content;?>
		</div>
	</div>
<?php } ?>
<p id="page-top"><a href="#wrap">PAGE TOP</a></p>

<footer>
	<p>copyright&reg;SUISOU 2009-<?php echo date('Y')?><p>
</footer>

</div>
</body>
</html>
