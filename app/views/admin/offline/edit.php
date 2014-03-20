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
		
		<?php echo Form::open();?>
		
		<h4 class="mt20"><?php echo Form::label('title','タイトル'); ?></h4>
		<div class="mt10">
			<?php echo Form::text('title',$title,array('class'=>'form_l')); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('discription','説明文'); ?></h4>
		<div class="mt10">
			<?php echo Form::textarea('discription',$discription); ?>
		</div>

		<h4 class="mt20"><?php echo Form::label('genre_id','ジャンル'); ?></h4>
		<div class="mt10">
			<?php echo Form::label('genre_id','ジャンルを選択：'); ?>
			<?php echo Form::select('genre_id',$genre_list,$genre); ?>
		</div>
		
		<h4 class="mt20">表示/非表示</h4>
		<div class="mt10">
			<?php echo Form::label('active_flg','表示：'); ?>
			<?php echo Form::radio('active_flg', Book::ACTIVE_FLG_YES,($active_flg == Book::ACTIVE_FLG_YES ? TRUE:FALSE)); ?>
			<?php echo Form::label('active_flg','非表示：'); ?>
			<?php echo Form::radio('active_flg', Book::ACTIVE_FLG_YES,($active_flg == Book::ACTIVE_FLG_NO ? TRUE:FALSE)); ?>
		</div>
		
		<h4 class="mt20">発行予定日</h4>
		<div class="mt10">
			<?php echo Form::text('release_year',$release_year,array('class'=>'form_s')); ?>年
			<?php echo Form::text('release_month',$release_month,array('class'=>'form_ss')); ?>月
			<?php echo Form::text('release_day',$release_day,array('class'=>'form_ss')); ?>日
		</div>
		
		<h4 class="mt20">新刊</h4>
		<div class="mt10">
			<?php echo Form::label('new_flg','新刊：'); ?>
			<?php echo Form::checkbox('new_flg', 1,TRUE); ?>
		</div>
		
		<h4 class="mt20">年齢指定</h4>
		<div class="mt10">
			<?php echo Form::label('r_flg','年齢制限：'); ?>
			<?php echo Form::checkbox('r_flg', 1,FALSE); ?>
		</div>
		
		<p class="mt20">
			<?php echo Form::submit('登録');?>
		</p>
		
		<?php echo Form::close();?>
		
	</div>