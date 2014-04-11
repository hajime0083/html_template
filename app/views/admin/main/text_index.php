	<div>
		<h2>小説管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<h4 class="mt20">小説新規登録</h4>
		<div class="mt10">
			<a href="/admin/text/edit/">新規登録</a>
		</div>
		
		<h4 class="mt20">既存小説管理</h4>
	</div>