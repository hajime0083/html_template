$(document).ready(
	function(){
	$("a").hover(function(){
	$(this).fadeTo(500, 0.6); // マウスオーバー時にmormal速度で、透明度を60%にする
	},function(){
	$(this).fadeTo(500, 1.0); // マウスアウト時にmormal速度で、透明度を100%に戻す
	});
});

