<div>
    <h2>！CAUTION</h2>
    <p>
	当サイトは女性向け二次創作を主に扱う、文・絵サイトです。<br />
	同性同士の恋愛描写、性描写を含む創作物がございます。ご注意ください。また、R18表記のある作品は未成年の方の閲覧はご遠慮ください。<br />
	版権元とは一切関係ございません。<br />
	注意書きを無視した上でのトラブルには一切対処致しかねます。<br />
	また、サイト内のいかなる創作物においても二次配布をご遠慮ください。（文・絵・サイトテンプレート等）<br />
	Please do not use any artworks & contents of this site for other site without my permission.<br />
    </p>
</div>

<div class="floatBox mt10">
    <div class="floatL w580 mr20">
	
	<?php if(!empty($lastupdatearr)){ ?>
	<h3><span>LastUpdate::<?php echo $lastupdate; ?></h3>
	<div>
	    <ul>
		<?php for($i=0;$i<count($lastupdatearr);$i++){ ?>
		<li><?php echo $lastupdatearr[$i]; ?></li>
		<?php } ?>
	    </ul>
	</div>
	<?php }else{?>
	<h3><span>LastUpdate</h3>
	<div>更新履歴はありません</div>
	<?php } ?>
	
	<?php if(!empty($headline)){ ?>
	<h3 class="mt10"><span>HeadLine::<?php echo $headline['date']; ?></h3>
	<div class="dropcap">
	    <p>
		<?php echo $headline['body']; ?><a href="/blog/<?php echo $headline['id'];?>" class="moreread">more read</a>
	    </p>
	</div>
	<?php } ?>
	<h3 class="mt10"><span>About</h3>
	<div>
	    <p>
		睦月ななこ[個人blog]&如月はじめ[tumbler(movie)]<br />
		傾向：DB(バダタレ等)/ガンダム(種/83)/その時々のよろず<br />
		ガトコウ、ムウラウ中心ラウ受けで絵とか文字とか。現在はオフライン中心オン更新少な目です<br />
	    </p>
	</div>
	
	<h3 class="mt10"><span>BookMark</h3>
	<div>
	    <p>
			<?php if(!empty($link_list)){ 
				foreach($link_list as $link_value){
					echo "{$link_value['genre_name']}:";
					foreach($link_value['link_detail'] as $link_detail){
						echo "<a href='{$link_detail['url']}' target='_blank'>{$link_detail['name']}</a>/";
					}
					echo "<br />";
				}
			}?>
	    </p>
	</div>
	
    </div>

    <div class="floatL w200">
	<div>
	    <h3>Link</h3>
	    <dl>
		<dt><img src="/bana.gif"></dt>
		<dd><?php echo url('/').'/' ?></dd>
	    </dl>
	    <p>
			女性向け同人サイトに限り基本的にリンクフリー(検索避け済み)<br />
			バナー直リンク推奨
		</p>
	</div>
	<div class="mt10">
	    <h3>ContName</h3>
	    <nav>
		<ul>
			<li><a href="/k2t/" target="_blank"><img src="/img/k2t.gif"></a></li>
		    <li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
		    <li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
		    <li><a href="#"><img src="http://cambelt.co/200x40"></a></li>
		</ul>
	    </nav>
	</div>
    </div>
</div>