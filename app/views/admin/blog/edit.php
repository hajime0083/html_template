	<div>
		<h2>BLOG記事(<?php echo $h2; ?>)</h2>
		
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
		
		<h4 class="mt20"><?php echo Form::label('body','本文'); ?></h4>
		<h4 class="mt20"><?php echo Form::label('img_1','画像１'); ?></h4>
		<div class="mt10">
			<?php echo Form::file('img1'); ?><br />
			<?php echo Form::hidden('old_img1',$img1); ?>
			<?php if(!empty($img1)){
				echo "<div class='imgLiquid' style='width:150px; height:100px;'><img src='/img/blog/{$img1}'></div>";
				echo Form::label('del_img1','削除：');
				echo Form::checkbox('del_img1',1);
			}?>
		</div>
		<div class="mt10">
			<?php echo Form::textarea('body',$body,array('class'=>'medium')); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('body_detail','本文2'); ?>(続きを読む以下に表示されます)</h4>
		<h4 class="mt20"><?php echo Form::label('img_2','画像２'); ?></h4>
		<div class="mt10">
			<?php echo Form::file('img2'); ?><br />
			<?php echo Form::hidden('old_img2',$img2); ?>
			<?php if(!empty($img1)){
				echo "<div class='imgLiquid' style='width:150px; height:100px;'><img src='/img/blog/{$img2}'></div>";
				echo Form::label('del_img2','削除：');
				echo Form::checkbox('del_img2',1);
			}?>
		</div>
		<div class="mt10">
			<?php echo Form::textarea('body_detail',$body_detail,array('class'=>'medium')); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('new_genre_text','カテゴリ'); ?></h4>
		<div class="mt10">
			<?php echo Form::label('new_genre','新しいカテゴリを追加：'); ?>
			<?php echo Form::checkbox('new_genre',1,FALSE); ?>
			<?php echo Form::text('new_genre_text',''); ?>
			<br />
			<?php echo Form::label('blog_genre','カテゴリを選択：'); ?>
			<?php echo Form::select('blog_genre',$genre_list,$blog_genre); ?>
		</div>
		
		<h4 class="mt20">表示/非表示</h4>
		<div class="mt10">
			<?php echo Form::label('active_flg','表示：'); ?>
			<?php echo Form::radio('active_flg', BlogGenre::ACTIVE_FLG_YES,($active_flg == BlogGenre::ACTIVE_FLG_YES ? TRUE:FALSE)); ?>
			<?php echo Form::label('active_flg','非表示：'); ?>
			<?php echo Form::radio('active_flg', BlogGenre::ACTIVE_FLG_YES,($active_flg == BlogGenre::ACTIVE_FLG_NO ? TRUE:FALSE)); ?>
		</div>
		
		<h4 class="mt20">投稿日(未来の日付けにした場合、予約投稿になります)</h4>
		<div class="mt10">
			<?php echo Form::label('reserve_flg','即時投稿：'); ?>
			<?php echo Form::checkbox('reserve_flg', 1,$reserve_flg); ?>
		</div>
		<div class="mt10">
			<?php echo Form::text('release_year',$release_year,array('class'=>'form_s')); ?>年
			<?php echo Form::text('release_month',$release_month,array('class'=>'form_ss')); ?>月
			<?php echo Form::text('release_day',$release_day,array('class'=>'form_ss')); ?>日
			<?php echo Form::text('release_hour',$release_hour,array('class'=>'form_ss')); ?>時
			<?php echo Form::text('release_min',$release_min,array('class'=>'form_ss')); ?>分
		</div>
		
		<h4 class="mt20">下書き</h4>
		<div class="mt10">
			<?php echo Form::label('draft_flg','下書き保存：'); ?>
			<?php echo Form::checkbox('draft_flg', 1,FALSE); ?>
		</div>
		
		<p class="mt20">
			<?php echo Form::submit('登録');?>
		</p>
		
		<?php echo Form::close();?>
		
	</div>