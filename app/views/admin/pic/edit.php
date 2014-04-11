	<div>
		<h2>テキスト編集(<?php echo $h2; ?>)</h2>
		
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
		
		<h4 class="mt20"><?php echo Form::label('note','本文'); ?></h4>
		<div class="mt10">
			<?php echo Form::textarea('note',$note,array('class'=>'large')); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('genre_id','ジャンル'); ?></h4>
		<div class="mt10">
			<?php echo Form::label('genre_id','ジャンルを選択：'); ?>
			<?php echo Form::select('genre_id',$genre_list,$genre_id); ?><br />
			<?php echo Form::label('cp','カップリング：'); ?>
			<?php echo Form::text('cp',$cp); ?><br />
		</div>
		
		<h4 class="mt20">年齢指定</h4>
		<div class="mt10">
			<?php echo Form::label('r_flg','R18：'); ?>
			<?php echo Form::checkbox('r_flg', Novel::R18_YES,($r_flg === Novel::R18_YES ? TRUE:FALSE)); ?>
		</div>
		
		<h4 class="mt20">表示/非表示</h4>
		<div class="mt10">
			<?php echo Form::label('active_flg','表示：'); ?>
			<?php echo Form::radio('active_flg', Novel::ACTIVE_FLG_YES,($active_flg === Novel::ACTIVE_FLG_YES ? TRUE:FALSE)); ?>
			<?php echo Form::label('active_flg','非表示：'); ?>
			<?php echo Form::radio('active_flg', Novel::ACTIVE_FLG_NO,($active_flg === Novel::ACTIVE_FLG_NO ? TRUE:FALSE)); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('description','説明文(一覧に表示されるコメントです)'); ?></h4>
		<div class="mt10">
			<?php echo Form::textarea('description',$description); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('postscript','コメント(後書き部分)'); ?></h4>
		<div class="mt10">
			<?php echo Form::textarea('postscript',$postscript); ?>
		</div>
		
		<h4 class="mt20">投稿日</h4>
		<p>
			未記入のものは即時投稿<br />
			未来の日付けにした場合、予約投稿になります
		</p>
		<div class="mt10">
			<?php echo Form::text('release_year',$release_year,array('class'=>'form_s')); ?>年
			<?php echo Form::text('release_month',$release_month,array('class'=>'form_ss')); ?>月
			<?php echo Form::text('release_day',$release_day,array('class'=>'form_ss')); ?>日
			<?php echo Form::text('release_hour',$release_hour,array('class'=>'form_ss')); ?>時
			<?php echo Form::text('release_min',$release_min,array('class'=>'form_ss')); ?>分
		</div>
		
		<h4 class="mt20"><?php echo Form::label('new_group_text','シリーズ'); ?></h4>
		<div class="mt10">
			<?php echo Form::label('group_id','シリーズを選択：'); ?>
			<?php echo Form::select('group_id',$group_list,$group_id); ?>
			<br />
			<?php echo Form::label('new_group','新しいシリーズを追加：'); ?>
			<?php echo Form::checkbox('new_group',1,FALSE); ?>
			<br />
			<?php echo Form::label('new_group_text','シリーズ名：'); ?>
			<?php echo Form::text('new_group_text',''); ?>
			<br />
			<?php echo Form::label('new_group_memo','シリーズ説明：'); ?>
			<?php echo Form::textarea('new_group_memo',''); ?>
		</div>
		
		<p class="mt20">
			<?php echo Form::submit('登録');?>
		</p>
		
		<?php echo Form::close();?>
		
	</div>