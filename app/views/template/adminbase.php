<!DOCTYPE html>
<html lang="ja">
<head>
	<title>Admin || <?php echo @$sitename; ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<!--[if lt IE 9]>
	<script src="../js/html5shiv.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/base.js"></script>
	<?php echo @$js; ?>
	<link type="text/css" rel="stylesheet" href="/css/html5-doctor-reset-stylesheet.css" />
	<link type="text/css" rel="stylesheet" href="/css/admin.css" />
	<?php echo @$css; ?>
</head>
<body>

<div id="wrap">


<header>
	
</header>

<?php if(Auth::check()){ ?>
<div id="main" class="floatBox">
	<div class="floatL">
		<h1><a href="/admin/"><?php echo @$sitename; ?> ADMIN</a></h1>
		<h4 class="mt10">Admin Menu</h4>
		<nav class="admin_menu">
			<ul>
				<li><a href="/admin/top/">サイトトップ管理</a></li>
				<li><a href="/admin/blog/">BLOG</a></li>
				<li><a href="/admin/pic/">イラスト管理</a></li>
				<li><a href="/admin/txt/">小説管理</a></li>
				<li><a href="/admin/offline/">オフライン</a></li>
				<li><a href="/admin/genre/">ジャンル管理</a></li>
				<li><a href="/admin/group/">シリーズ管理</a></li>
				<li><a href="/admin/user/">ユーザー情報</a></li>
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
		<h1><a href="/admin/"><?php echo @$sitename; ?> ADMIN</a></h1>
		<div class="mt10">
			<?php echo @$content;?>
		</div>
	</div>
<?php } ?>
<p id="page-top"><a href="#wrap">PAGE TOP</a></p>

<footer>
	<p>copyright&reg;<?php echo @$sitename; ?> 2009-<?php echo date('Y')?><p>
</footer>

</div>
</body>
</html>
