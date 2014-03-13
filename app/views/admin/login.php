	<div>
		<h2>LOGIN</h2>
		<p>
			ログインしてください
		</p>
		<div class="mt10">
			<?php 
			echo Form::open();
			echo "<dl>";
			echo '<dt>'.Form::label('login', 'ID：').'</dt>';
			echo '<dd>'.Form::text('login', Input::old('login', '')).'</dd>';
			echo '<dt class="mt10">'.Form::label('password', 'pass：').'</dt>';
			echo '<dd>'.Form::password('password').'</dd>';
			echo "</dl>";
			echo Form::submit('ログイン');
			echo Form::close();
			?>
		</div>
	</div>