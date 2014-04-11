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
			<?php echo Form::textarea('note',$note); ?>
		</div>
		
		<h4 class="mt20"><?php echo Form::label('genre_id','ジャンル'); ?></h4>
		<div class="mt10">
			<?php echo Form::label('genre_id','ジャンルを選択：'); ?>
			<?php echo Form::select('genre_id',$genre_list,$genre_id); ?><br />
		</div>
		
		<h4 class="mt20">年齢指定</h4>
		<div class="mt10">
			<?php echo Form::label('r_flg','R18：'); ?>
			<?php echo Form::checkbox('r_flg', Book::R18_YES,($r_flg === Book::R18_YES ? TRUE:FALSE)); ?>
		</div>

		<h4 class="mt20"><?php echo Form::label('description','コメント'); ?></h4>
		<div class="mt10">
			<?php echo Form::textarea('description',$description); ?>
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