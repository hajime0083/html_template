	<div>
		<h2>オフライン編集(<?php echo $h2; ?>)</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<?php echo Form::open(array('enctype'=>'multipart/form-data'));?>
		
		<h4 class="mt20"><?php echo Form::label('title','タイトル'); ?></h4>
		<div class="mt10">
			<?php echo Form::text('title',$title,array('class'=>'form_l')); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('discription','説明文'); ?></h4>
		<div class="mt10">
			<?php echo Form::textarea('discription',$discription); ?>
		</div>

		<h4 class="mt20"><?php echo Form::label('cover_image','表紙画像'); ?></h4>
		<p>サイズ:340*240</p>
		<?php if(!is_null($cover_image)){
			 echo "<div class='imgLiquid' style='width:150px; height:100px;'><img src='/img/book/{$cover_image}'></div>";
			 echo Form::checkbox('del_cover_image',1);
			 echo Form::label('del_cover_image','削除：');
		}?>
		<div class="mt10">
			<?php echo Form::file('cover_image'); ?><br />
			<?php echo Form::hidden('old_cover_image',$cover_image); ?>
		</div>
		
		<h4 class="mt20">サンプル画像</h4>
		<div class="mt10">
			<?php echo Form::label('sample_1','サンプル1'); ?>:<br />
				<?php echo Form::file('sample_1'); ?><br />
				<?php echo Form::hidden('old_sample_1',$sample_1); ?>
				<?php echo Form::label('del_csample_1','削除：'); ?>
				<?php echo Form::checkbox('del_sample_1',1); ?><br />
			<?php echo Form::label('sample_2','サンプル2'); ?>:<br />
				<?php echo Form::file('sample_2'); ?><br />
				<?php echo Form::hidden('old_sample_2',$sample_2); ?>
				<?php echo Form::label('del_csample_2','削除：'); ?>
				<?php echo Form::checkbox('del_sample_2',1); ?><br />
			<?php echo Form::label('sample_3','サンプル3'); ?>:<br />
				<?php echo Form::file('sample_3'); ?><br />
				<?php echo Form::hidden('old_sample_3',$sample_3); ?>
				<?php echo Form::label('del_csample_3','削除：'); ?>
				<?php echo Form::checkbox('del_sample_3',1); ?><br />
		</div>
		
		<h4 class="mt20"><?php echo Form::label('genre_id','ジャンル'); ?></h4>
		<div class="mt10">
			<?php echo Form::label('genre_id','ジャンルを選択：'); ?>
			<?php echo Form::select('genre_id',$genre_list,$genre_id); ?><br />
			<?php echo Form::label('cp','カップリング傾向：'); ?>
			<?php echo Form::text('cp',$cp); ?><br />
			<?php echo Form::label('type','漫画OR小説：'); ?>
			<?php echo Form::select('type',$type_list,$type); ?><br />
		</div>
		
		<h4 class="mt20">価格(未定の場合空のまま)</h4>
		<div class="mt10">
			<?php echo Form::text('price', $price, array('class'=>'form_s')); ?>円
		</div>
		
		<h4 class="mt20">サイズ/ページ数(未定の場合空のまま)</h4>
		<div class="mt10">
			サイズ：<?php echo Form::select('size', Config::get('my_config.page_size'),$size); ?><br />
			ページ：<?php echo Form::text('page',$page,array('class'=>'form_s')); ?>P
		</div>
		
		<h4 class="mt20">発行予定日(未定の場合空のまま)</h4>
		<p>月、日付は頭にゼロを付けて入力して下さい(例2010/1/1→2010/01/01)</p>
		<div class="mt10">
			<?php echo Form::text('issued_year',$issued_year,array('class'=>'form_s')); ?>年
			<?php echo Form::text('issued_month',$issued_month,array('class'=>'form_ss')); ?>月
			<?php echo Form::text('issued_day',$issued_day,array('class'=>'form_ss')); ?>日
		</div>
		
		<h4 class="mt20">新刊</h4>
		<div class="mt10">
			<?php echo Form::label('new_flg','新刊：'); ?>
			<?php echo Form::checkbox('new_flg', Book::NEW_FLG_YES,($new_flg === Book::NEW_FLG_YES ? TRUE:FALSE)); ?>
		</div>
		
		<h4 class="mt20">年齢指定</h4>
		<div class="mt10">
			<?php echo Form::label('r_flg','R18：'); ?>
			<?php echo Form::checkbox('r_flg', Book::R18_YES,($r_flg === Book::R18_YES ? TRUE:FALSE)); ?>
		</div>
		
		<h4 class="mt20">在庫</h4>
		<div class="mt10">
			<?php echo Form::select('sold_flg', Config::get('my_config.sold_flg'),$sold_flg); ?>
		</div>
		
		<h4 class="mt20">表示/非表示</h4>
		<div class="mt10">
			<?php echo Form::label('active_flg','表示：'); ?>
			<?php echo Form::radio('active_flg', Book::ACTIVE_FLG_YES,($active_flg === Book::ACTIVE_FLG_YES ? TRUE:FALSE)); ?>
			<?php echo Form::label('active_flg','非表示：'); ?>
			<?php echo Form::radio('active_flg', Book::ACTIVE_FLG_NO,($active_flg === Book::ACTIVE_FLG_NO ? TRUE:FALSE)); ?>
		</div>
		
		<p class="mt20">
			<?php echo Form::submit('登録');?>
		</p>
		
		<?php echo Form::close();?>
		
	</div>