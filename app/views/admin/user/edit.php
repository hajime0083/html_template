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
			パスワードは両方未入力の場合更新されません<br />
		</p>
		<div class="mt10">
			<?php 
			echo Form::open();
			echo "<dl>";
			echo '<dt>'.Form::label('login', 'ID：').'</dt>';
			echo '<dd>'.Form::text('login', $login).'</dd>';
			echo '<dt class="mt10">'.Form::label('name', '表示名：').'</dt>';
			echo '<dd>'.Form::text('name', $name).'</dd>';
			echo '<dt class="mt10">'.Form::label('mail', 'mail：').'</dt>';
			echo '<dd>'.Form::text('mail', $mail).'</dd>';
			echo '<dt class="mt10">'.Form::label('pass', 'pass：').'</dt>';
			echo '<dd>'.Form::password('pass').'</dd>';
			echo '<dt class="mt10">'.Form::label('pass_confirmation', 'pass(確認)：').'</dt>';
			echo '<dd>'.Form::password('pass_confirmation').'</dd>';
			echo "</dl>";
			echo Form::submit('更新');
			echo Form::close();
			?>
		</div>
	</div>