	<div>
		<h2>ユーザー情報管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<p>
			ユーザー情報を変更します。<br />
			表示名は、BLOGやOFFLINEの表示部分にも反映されます。<br />
			パスワードを変更したい場合は変更前、後を両方入力の上登録してください。<br />
			両方未入力だった場合は変更されません。<br />
		</p>
		<div class="mt10">
			<?php 
			echo Form::open();
			echo "<dl>";
			echo '<dt>'.Form::label('login', 'ID：').'</dt>';
			echo '<dd>'.Form::text('login', Input::old('login', $login)).'</dd>';
			echo '<dt class="mt10">'.Form::label('name', '表示名：').'</dt>';
			echo '<dd>'.Form::text('name', Input::old('name', $name)).'</dd>';
			echo '<dt class="mt10">'.Form::label('mail', 'mail：').'</dt>';
			echo '<dd>'.Form::text('mail', Input::old('mail', $mail)).'</dd>';
			echo '<dt class="mt10">'.Form::label('pass', 'pass：').'</dt>';
			echo '<dd>'.Form::password('pass').'</dd>';
			echo '<dt class="mt10">'.Form::label('pass_confimation', 'pass(確認)：').'</dt>';
			echo '<dd>'.Form::password('pass_confimation').'</dd>';
			echo "</dl>";
			echo Form::submit('更新');
			echo Form::close();
			?>
		</div>
	</div>