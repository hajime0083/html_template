	<div>
		<h2>OFFLINE</h2>
		<p>
			SUISOUというサークル名で関東や関西のイベントにぽつぽつ参加しています。<br />
			参加は二人だったり一人だったりです。<br />
			睦月：漫画、如月：小説で活動しております。
		</p>
		<p class="mt10">
			自家通販をしています(たまに休止します)宜しければご利用ください。
		</p>
		<h3 class="mt20">予定</h3>
		<?php if($event){?>
		<ul>
			<?php foreach($event as $event_value){ ?>
			<li><?php echo $event_value; ?></li>
			<?php } ?>
		</ul>
		<?php }else{ ?>
		<p>未定</p>
		<?php } ?>
		<h3 class="mt20">新刊</h3>
		<?php if(!empty($newbook_list)){ ?>
		<div class="floatBox">
			<?php foreach($newbook_list as $newbook_data){ ?>
			<div class="floatL mr20 mt10">
				<div>
					<?php if(!empty($newbook_data['cover_image'])){
						echo "<img src='/img/book/{$newbook_data['cover_image']}' />";
					}else{
						echo "<img src='/img/book/cover_noimg.gif' />";
					}?>
				</div>
				<div class="mt10">
					<h4><?php echo $newbook_data['title']; ?></h4>
					<p class="ml10 discription">
						【<?php echo $newbook_data['genre']; ?>/<?php echo $newbook_data['cp']; ?>/<?php echo $newbook_data['type']; ?><?php if($newbook_data['r_flg']===Book::R18_YES){echo "/<span class='r18'>R18</span>";}?>】<br />
						<?php echo nl2br($newbook_data['discription']); ?>
					</p>
					<h5>仕様</h5>
					<p class="ml10">
						<?php echo $newbook_data['issued_at']; ?>/<?php echo $newbook_data['page']; ?>/<?php echo $newbook_data['size']; ?>/<?php echo $newbook_data['price']; ?><br/>
						<?php if($newbook_data['sold_flg']===Book::SOLD_FLG_NOTMENY){echo "在庫残少<br />";}?>
					</p>
				</div>
			</div>			
			<?php } ?>
		</div>	
		<?php }else{ ?>
			<p>新刊予定はありません</p>
		<?php } ?>
		
		<h3 class="mt20">既刊</h3>
		<?php if(!empty($book_list)){ ?><?php foreach($book_list as $book_data){ ?>
		<div class="floatBox mt10">
			<div class="floatL mr20">
				<?php if(!empty($book_data['cover_image'])){
					echo "<img src='/img/book/{$book_data['cover_image']}' />";
				}else{
					echo "<img src='/img/book/cover_noimg.gif' />";
				}?>
			</div>
			<div class="floatL">
				<h4><?php echo $book_data['title']; ?></h4>
				<p class="ml10 discription2">
					【<?php echo $book_data['genre']; ?>/<?php echo $book_data['cp']; ?>/<?php echo $book_data['type']; ?><?php if($book_data['r_flg']===Book::R18_YES){echo "/<span class='r18'>R18</span>";}?>】<br />
					<?php echo nl2br($book_data['discription']); ?>
				</p>
				<h5>仕様</h5>
				<p class="ml10">
					<?php echo $book_data['issued_at']; ?>/<?php echo $book_data['page']; ?>/<?php echo $book_data['size']; ?>/<?php echo $book_data['price']; ?><br/>
					<?php if($book_data['sold_flg']===Book::SOLD_FLG_NOTMENY){echo "在庫残少<br />";}?>
				</p>
			</div>
		</div>			
		<?php } ?>
		
		<?php }else{ ?>
			<p>既刊はありません</p>
		<?php } ?>
		
		
		
		<?php if(!empty($sold_list)){ ?>
		<h3 class="mt20">頒布終了</h3>
		<div>
			<ul>
				<?php foreach($sold_list as $sold_data){ ?>
				<li><?php echo $sold_data['title']; ?>(<?php echo $sold_data['genre']; ?>/<?php echo $sold_data['cp']; ?>/<?php echo $sold_data['type']; ?>/<?php echo $sold_data['price']; ?>) <?php echo $sold_data['issued_at']; ?></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		
	</div>